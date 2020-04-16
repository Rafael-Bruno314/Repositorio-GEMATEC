<?php #include("class/protect.php"); 
?>

<?php
include('class/conectando.php');
include('ano_config.php');
?>

<?php
error_reporting(0);
ini_set(“display_errors”, 0);
?>

<?php
/* esse bloco de código em php verifica se existe a sessão, pois o usuário pode simplesmente não fazer o login e digitar na barra de endereço do seu navegador o caminho para a página principal do site (sistema), burlando assim a obrigação de fazer um login, com isso se ele não estiver feito o login não será criado a session, então ao verificar que a session não existe a página redireciona o mesmo para a index.php.
session_start();
if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
{
unset($_SESSION['login']);
unset($_SESSION['senha']);
header('location:index.php');
}

$logado = $_SESSION['login']; */
?>

<?php
$query  = mysql_query("SELECT * FROM livros");
$comb   = mysql_query("SELECT * FROM genero");
$query_mudar = mysql_query("SELECT * FROM livros");
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    
    <link rel="icon" href="favicon.ico">

    <title>Alterar livros GEMATEC</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<link href="css/estilo.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
	
	<!-- Para colocar a navbar restrita -->
	<script src="js/w3.js"></script>
	
	<script type="text/javascript" src="js/alterar_livro.js"></script>
	
	<script type="text/javascript" src="js/code_jquery.js"></script>
	<script>
	$(function () {
		$('[data-toggle="popover"]').popover()
	})
	</script>
	
	<noscript>Desculpe, mas seu navegador não suporta <b>JavaScript</b>, ou ele pode estar desabilitado! Sua experiência com esse sistema ficará seriamente afetada!</noscript>
	
  </head>
  <body>
	
	<!-- Para colocar a navbar restrita -->
	<div w3-include-html="css/navbar_restrita.html"></div> 
	<!-- Para colocar a navbar restrita -->
	<script>w3.includeHTML();</script>
	
	<div class="container">
		<h1>Alterar Livros</h1>
		<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="delete_and_update" >
		
			<div class="panel panel-primary">
			<div class="panel-body">
			
			<div class="col-xs-12 selectContainer">
				<select id="titulo_mudar" name="titulo_mudar" class="form-control" id="id" name="id" onChange="loadDoc(myFunction)">
					<option value="">Escolha o título da obra que deseja alterar</option>
					<?php while ($titulo_muda = mysql_fetch_array($query_mudar)) { ?>
					<option value="<?php echo ($titulo_muda['id']) ?>"><?php echo ($titulo_muda['id']); echo " - ";echo ($titulo_muda['titulo'])?></option>
					<?php } ?>
				</select>
			</div><br><br><br>
			
			
			<table width = "100%" border = "0" frame="none">
			
				<tr><td align=left>
				<label><h4>Título</h4></label></td>
				<div class="col-sm-10"><td>
					<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título"></td></tr>
				</div>
				  
				<tr><td align=left>
				<label><h4>Autor(es)</h4></label>
				<a tabindex="0" class="btn btn-primary btn-xs" role="button" data-toggle="popover" data-trigger="focus" title="Ajuda" data-content="Por definião, adicione cada autor separado por ponto e vírgula.">?</a> <!-- Criar o popup de ajuda -->				</td>
				<div class="col-sm-10"><td>
					<input type="text" class="form-control" id="autor" name="autor" placeholder="Autor"></td></tr>
				</div>

				<tr><td align=left>
				<label><h4>Gênero</h4></label></td>
				<div class="col-sm-10"><td>
					<select class="form-control" id="genero" name="genero"  onChange="Add_genero()">
						<option value="selecione">Selecione</option>
						<?php while ($prod = mysql_fetch_array($comb)) { ?>
						<option value="<?php echo ($prod['genero']); ?>"><?php echo ($prod['genero']); ?></option>
						<?php } ?>
						<option value="outro">Outro</option>
					</select></td></tr>
					<input type="text" id="trapaca_genero" name="trapaca_genero" style="display: none">
				</div>
									  
				<tr><td align=left>
				<label><h4>Editora<h4></label></td>
				<div class="col-sm-10"><td>
					<input type="text" class="form-control" id="editora" name="editora" placeholder="Editora"></td></tr>
				</div>

				<tr><td align=left>
				<label><h4>Ano de Publicação</h4></label></td>
				<div class="col-sm-10"><td>
					<select class="form-control" id="ano" name="ano">
						<option>Ano de Publicação</option>
						<?php for ($data_ano = date("Y"); $data_ano >= 1980; $data_ano--) { ?>
						<option value="<?php echo $ano_array2[$data_ano]; ?>"><?php echo $ano_array2[$data_ano]; ?></option>
						<?php } ?>
					</select></td></tr>	
				</div>
				  
				<tr><td align=left>
				<label><h4>Capa</h4></label>
				<a tabindex="0" class="btn btn-primary btn-xs" role="button" data-toggle="popover" data-trigger="focus" title="Ajuda" data-content="Adicione o arquivo correspondente a uma imagem visual da capa (.jpg, .png)">?</a> <!-- Criar o popup de ajuda -->
				</td>
				<div class="col-sm-10"><td>
					<input type="file" name="capa" class="form-control" id="capa"></td></tr>
				</div>
				  
			</table> 
			<hr>
			<table width = "95%" border = "0" frame="none">
				<tr><td align=center><br>
					<button type="submit" onclick="Confirma()" name="alterar" id="alterar" class="btn btn-primary btn-lg">Alterar</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<input type="reset"  class="btn btn-warning btn-lg" name="apagar" id="apagar" value="Apagar Campos"></td></tr>
				</td></tr>
			</table>
			</div> 
			</div>
		</form>
		<hr>

<?php
if (isset($_POST['alt_dps_da_ganbiarra'])) {
    
    $codigo  = $_POST['titulo_mudar'];
    $autor   = ($_POST['autor']);
    $titulo  = ($_POST['titulo']);
    $genero  = ($_POST['genero']);
    $editora = ($_POST['editora']);
    $ano     = $_POST['ano'];
    $capa    = $_FILES["capa"];
    
	
	if ($codigo == "") {
        echo "<script>alert('Por favor digite um código válido para alterar');</script>";
    } else {
	
        if (!empty($_FILES['capa']['name'])) {
            //capa
            //Para apagar imagem antiga ao alterar!
            $excluindo = mysql_query("SELECT * FROM livros WHERE id= $codigo");
            while ($row = mysql_fetch_object($excluindo)) {
                $endereco = $row->capa;
            }
			
			if($endereco != "sem_imagem.jpg")
			{
				$diretorio = "Capas/";
				$apagar    = $diretorio . $endereco;
				unlink($apagar);
			}
            
            // Pega extensão da imagem
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $capa["name"], $ext);
            
            // Gera um nome único para a imagem
            $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
            
            // Caminho de onde ficará a imagem
            $caminho_imagem = "Capas/" . $nome_imagem;
            
            // Faz o upload da imagem para seu respectivo caminho
            move_uploaded_file($capa["tmp_name"], $caminho_imagem);
            //fim banner			
            
            //thumb
            // Gera um nome único para a imagem
            $nome_imagem_t = md5(uniqid(time())) . ".jpg";
            
            // Retorna o identificador da imagem
            $imagem = imagecreatefromjpeg($caminho_imagem);
            
            // Cria duas variáveis com a largura e altura da imagem
            list($largura, $altura) = getimagesize($caminho_imagem);
            
            // Nova largura e altura
            $nova_largura = 175;
            $nova_altura  = 235;
            
            // Cria uma nova imagem em branco
            $nova_imagem = imagecreatetruecolor($nova_largura, $nova_altura);
            
            // Copia a imagem para a nova imagem com o novo tamanho
            imagecopyresampled($nova_imagem, // Nova imagem 
                $imagem, // Imagem original
                0, // Coordenada X da nova imagem
                0, // Coordenada Y da nova imagem 
                0, // Coordenada X da imagem 
                0, // Coordenada Y da imagem  
                $nova_largura, // Nova largura
                $nova_altura, // Nova altura
                $largura, // Largura original
                $altura // Altura original
                );
            
            // Cria a imagem
            $capa = imagejpeg($nova_imagem, $nome_imagem_t, 100);
            
            // Caminho de onde ficará a imagem
            $caminho_imagem_t = "Capas/" . $nome_imagem_t;
            
            rename($nome_imagem_t, $caminho_imagem_t);
            
            // Remove as imagens temporárias
            imagedestroy($imagem);
            imagedestroy($nova_imagem);
            
            unlink($caminho_imagem);
            //fim thumb
        } else {
            $query = mysql_query("SELECT * FROM livros WHERE id= $codigo");
            
            $usuario = mysql_fetch_array($query);
            
            $nome_imagem_t = $usuario['capa'];
        }
        
        if ($titulo == "" && $ano == "" && $autor == "" && $editora == "" && $genero == "" && $codigo == "") {
            echo "<h2>Os campos não foram preenchidos</h2>";
        } else {
            
            if ($autor == "") {
                $query = mysql_query("SELECT * FROM livros WHERE id= $codigo");
                
                $usuario = mysql_fetch_array($query);
                
                $autor = $usuario['autor'];
            }
            
            if ($titulo == "") {
                $query = mysql_query("SELECT * FROM livros WHERE id= $codigo");
                
                $usuario = mysql_fetch_array($query);
                
                $titulo = $usuario['titulo'];
            }
            
            if ($editora == "") {
                $query = mysql_query("SELECT * FROM livros WHERE id= $codigo");
                
                $usuario = mysql_fetch_array($query);
                
                $editora = $usuario['editora'];
            }
            
            if ($genero == "selecione") {
                $query = mysql_query("SELECT * FROM livros WHERE id= $codigo");
                
                $usuario = mysql_fetch_array($query);
                
                $genero = $usuario['genero'];
            }else{
				
				$sql_cat = mysql_query("SELECT * FROM genero");
				$sql_insert_cat = "INSERT INTO genero(genero) VALUES ('$genero')";
				while ($informacoes = mysql_fetch_object($sql_cat)) {
					if($informacoes->genero == $genero){
						$sql_insert_cat = "SELECT * FROM genero";
					}
				}
				mysql_query($sql_insert_cat);
			}
            
            if ($ano == "Ano de Publicação") {
                $query = mysql_query("SELECT * FROM livros WHERE id= $codigo");
                
                $usuario = mysql_fetch_array($query);
                
                $ano = $usuario['ano'];
            }
                        
            $alterar = "UPDATE `livros` SET `autor`= '$autor',`titulo`= '$titulo',`editora`='$editora', `genero`='$genero',`ano`='$ano',`capa`='$nome_imagem_t' WHERE id = '$codigo'"; //`livro`='$nome_livro',	
            
			if (!$alterar) {
                echo "<script>alert('Não deu...')</script>";
            } else {
                echo "<script>alert('Alterado com sucesso')</script>";
            }
			
            mysql_query($alterar, $conn) or die("<font style=Arial color=red><h1>Houve um erro na alteração dos dados</h1></font>");
            
            $busca = mysql_query("SELECT * FROM livros WHERE id= $codigo");
            
            while ($livros = mysql_fetch_object($busca)) {
                echo "<div class='row'>";
                echo "<div class='thumbnail'>";
                echo "<table>";
                echo "<tr><td>";
                echo "<a href='Capas/" . $livros->capa . " 'target='_blank'' ><img src='Capas/" . $livros->capa . "' alt='Foto de exibição' /></a>";
                echo "</td><td width='10%' color: 'green'>";
                echo "</td><td>";
                echo "<strong><p class='destaque'>" . ($livros->titulo) . "</p></strong>" . "<b class='titulo'>Código:</b><span> " . $livros->id . "</span></br>" . "<b class='titulo'>Gênero: </b><span>" . ($livros->genero) . "</span></br>" . "<b class='titulo'>Autor: </b><span>" . ($livros->autor) . "</span></br>" . "<b class='titulo'>Editora: </b><span>" . ($livros->editora) . "</span></br>" . "<b class='titulo'>Ano de publicação: </b><span>" . $livros->ano . "</span><br><br>";
                #echo "<p><a href='Capas/".$livros->capa."' target='_blank'' class='btn btn-primary' role='button'>Abrir</a></p>"; //<a href='Livros/".$livros->livro."' download=".$livros->titulo." class='btn btn-default' role='button'>Download</a>
                echo "</td></tr>";
                echo "</table>";
                echo "</div>";
                echo "</div>";
            }
        }
	}
}
?>

	</div>
 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>