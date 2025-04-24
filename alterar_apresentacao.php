<?php
// Configurações iniciais
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclusões necessárias
require_once 'class/protect.php';
require_once 'class/conectar_banco.php';
require_once 'ano_config.php';

// Conexão com banco de dados usando PDO (mais seguro que mysql_*)
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

// Consultas iniciais
$query_mudar = $pdo->query("SELECT * FROM apresentacoes ORDER BY id DESC");

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['alt_dps_da_ganbiarra'])) {
    $codigo = filter_input(INPUT_POST, 'titulo_mudar', FILTER_VALIDATE_INT);
    
    if (!$codigo) {
        echo "<script>alert('Por favor selecione um item válido para alterar');</script>";
    } else {
        // Sanitização dos inputs
        $autor = filter_input(INPUT_POST, 'autor', FILTER_SANITIZE_STRING);
        $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
        $palavras_chave = filter_input(INPUT_POST, 'palavras_chave', FILTER_SANITIZE_STRING);
        $ano = filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_STRING);
        
        // Tratamento do arquivo
        $nome_apresentacao = null;
        if (!empty($_FILES['apresentacao']['name'])) {
            $apresentacao = $_FILES['apresentacao'];
            
            // Validação do arquivo
            $extensoesPermitidas = ['pptx', 'ppt', 'pdf'];
            $extensao = strtolower(pathinfo($apresentacao['name'], PATHINFO_EXTENSION));
            
            if (!in_array($extensao, $extensoesPermitidas)) {
                die("Tipo de arquivo não permitido");
            }
            
            // Remove arquivo antigo
            $stmt = $pdo->prepare("SELECT apresentacao FROM apresentacoes WHERE id = ?");
            $stmt->execute([$codigo]);
            $endereco = $stmt->fetchColumn();
            
            if ($endereco) {
                $diretorio = "Apresentacoes/";
                $apagar = $diretorio . $endereco;
                if (file_exists($apagar)) {
                    unlink($apagar);
                }
            }
            
            // Gera nome único e move o arquivo
            $nome_apresentacao = uniqid('', true) . '.' . $extensao;
            $caminho_apresentacao = "Apresentacoes/" . $nome_apresentacao;
            
            if (!move_uploaded_file($apresentacao['tmp_name'], $caminho_apresentacao)) {
                die("Falha ao fazer upload do arquivo");
            }
        }
        
        // Prepara os dados para atualização
        $dadosAtuais = $pdo->prepare("SELECT * FROM apresentacoes WHERE id = ?");
        $dadosAtuais->execute([$codigo]);
        $dados = $dadosAtuais->fetch(PDO::FETCH_ASSOC);
        
        $autor = $autor ?: $dados['autor'];
        $titulo = $titulo ?: $dados['titulo'];
        $palavras_chave = $palavras_chave ?: $dados['palavras_chave'];
        $ano = ($ano && $ano !== "Ano de Publicação") ? $ano : $dados['ano'];
        $nome_apresentacao = $nome_apresentacao ?: $dados['apresentacao'];
        
        // Atualização no banco
        try {
            $stmt = $pdo->prepare("UPDATE apresentacoes SET autor = ?, titulo = ?, palavras_chave = ?, ano = ?, apresentacao = ? WHERE id = ?");
            $stmt->execute([$autor, $titulo, $palavras_chave, $ano, $nome_apresentacao, $codigo]);
            
            echo "<script>alert('Alterado com sucesso')</script>";
            
            // Exibe os dados atualizados
            $busca = $pdo->prepare("SELECT * FROM apresentacoes WHERE id = ?");
            $busca->execute([$codigo]);
            $apresentacao = $busca->fetch(PDO::FETCH_OBJ);
            
            include 'templates/apresentacao_atualizada.php';
        } catch (PDOException $e) {
            die("<font style='Arial' color='red'><h1>Houve um erro na alteração dos dados: " . $e->getMessage() . "</h1></font>");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistema de gerenciamento de apresentações GEMATEC">
    
    <title>Alterar apresentações GEMATEC</title>
    <link rel="icon" href="favicon.ico">

    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/w3.js"></script>
    <script src="js/alterar_apresentacao.js"></script>
    
    <style>
        .destaque {
            font-size: 25px;
            color: #421E65;
        }
        .help-popover {
            cursor: help;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div w3-include-html="css/navbar_restrita.html"></div>
    
    <main class="container my-4">
        <h1 class="mb-4">Alterar Apresentações</h1>
        
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="titulo_mudar" class="control-label">Selecione a apresentação:</label>
                        <select id="titulo_mudar" name="titulo_mudar" class="form-control" required>
                            <option value="">Escolha o título da obra que deseja alterar</option>
                            <?php while ($titulo_muda = $query_mudar->fetch()): ?>
                                <option value="<?= htmlspecialchars($titulo_muda['id']) ?>">
                                    <?= htmlspecialchars($titulo_muda['titulo']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    
                    <hr>
                    
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título">
                    </div>
                    
                    <div class="form-group">
                        <label for="autor">
                            Autor(es)
                            <span class="help-popover btn btn-sm btn-info" data-toggle="popover" data-trigger="focus" 
                                  title="Formato" data-content="Sobrenome em caixa alta, abreviações dos nomes, separados por ponto e vírgula. Ex.: SOBRENOME1,N.; SOBRENOME2,A.;">
                                ?
                            </span>
                        </label>
                        <input type="text" class="form-control" id="autor" name="autor" placeholder="Autor(es)">
                    </div>
                    
                    <div class="form-group">
                        <label for="palavras_chave">
                            Palavras-chave
                            <span class="help-popover btn btn-sm btn-info" data-toggle="popover" data-trigger="focus" 
                                  title="Formato" data-content="Separadas por ponto final.">
                                ?
                            </span>
                        </label>
                        <input type="text" class="form-control" id="palavras_chave" name="palavras_chave" placeholder="Palavras-chave">
                    </div>
                    
                    <div class="form-group">
                        <label for="ano">Ano de Publicação</label>
                        <select class="form-control" id="ano" name="ano">
                            <option value="">Ano de Publicação</option>
                            <?php for ($data_ano = date("Y"); $data_ano >= 1980; $data_ano--): ?>
                                <option value="<?= $ano_array2[$data_ano] ?>"><?= $ano_array2[$data_ano] ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="apresentacao">
                            Apresentação
                            <span class="help-popover btn btn-sm btn-info" data-toggle="popover" data-trigger="focus" 
                                  title="Informação" data-content="Formatos aceitos: .pptx, .ppt, .pdf">
                                ?
                            </span>
                        </label>
                        <input type="file" name="apresentacao" class="form-control-file" id="apresentacao">
                    </div>
                    
                    <hr>
                    
                    <div class="text-center">
                        <button type="submit" name="alt_dps_da_ganbiarra" class="btn btn-primary btn-lg mr-3">Alterar</button>
                        <button type="reset" class="btn btn-warning btn-lg">Limpar Campos</button>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <!-- Scripts de inicialização -->
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover();
            w3.includeHTML();
        });
    </script>
</body>
</html>