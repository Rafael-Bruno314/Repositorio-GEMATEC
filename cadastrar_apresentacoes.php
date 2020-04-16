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
// esse bloco de código em php verifica se existe a sessão, pois o usuário pode simplesmente não fazer o login e digitar na barra de endereço do seu navegador o caminho para a página principal do site (sistema), burlando assim a obrigação de fazer um login, com isso se ele não estiver feito o login não será criado a session, então ao verificar que a session não existe a página redireciona o mesmo para a index.php.
/*session_start();
if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
{
unset($_SESSION['login']);
unset($_SESSION['senha']);
header('location:index.php');
}

$logado = $_SESSION['login'];*/
?>

<?php
// Se o usuário clicou no botão cadastrar efetua as ações
if (isset($_POST['cad_dps_da_ganbiarra'])) {
    
    $autor          = ($_POST['autor']);
    $titulo         = ($_POST['titulo']);
    $palavras_chave = ($_POST['palavras_chave']);
    $ano            = $_POST['ano'];
    $apresentacao   = $_FILES["apresentacao"];
    
    
        if ($ano == "Ano de Publicação") {
            $ano = "0000";
        }
		
		if($titulo == "" || $titulo == " "){
			$titulo = "Inexistente";
		}
		
		if($autor == "" || $autor == " "){
			$autor = "Inexistente";
		}
		
		if($palavras_chave == "" || $palavras_chave == " "){
			$palavras_chave = "Inexistente";
		}
        
		if(!empty($_FILES['apresentacao']['name'])){
			//apresentacao
			// Pega extensão da imagem
			preg_match("/\.(pptx|ppt|pdf){1}$/i", $apresentacao["name"], $ext);
			
			if ($ext[1] != "pptx" && $ext[1] != "ppt" && $ext[1] != "pdf") {
				echo "<script>alert('Formato de arquivo inválido!\\nPor favor utilize os formatos pptx, ppt ou pdf')</script>";
				$nome_apresentacao = "nao_encontrado.pdf";
			} else {
				// Gera um nome único para a imagem
				$nome_apresentacao = md5(uniqid(time())) . "." . $ext[1];
				
				// Caminho de onde ficará a imagem
				$caminho_apresentacao = "Apresentacoes/" . $nome_apresentacao;
				// Faz o upload da imagem para seu respectivo caminho
				move_uploaded_file($apresentacao["tmp_name"], $caminho_apresentacao);
				#rename($apresentacao["tmp_name"], $caminho_apresentacao);
				//fim apresentacao	
			}			
        }else{
			$nome_apresentacao = "nao_encontrado.pdf";
		}
		
        // Insere os dados no banco
        
        
        $sql = "INSERT INTO apresentacoes(autor,titulo,palavras_chave,ano,apresentacao) VALUES ('$autor','$titulo','$palavras_chave','$ano','$nome_apresentacao')";
        mysql_query($sql, $conn) or die("<font style=Arial color=red><h1>Houve um erro na gravação dos dados</h1></font>");
		
		if (!$sql) {
			echo "<script>alert('Não deu...')</script>";
        } else {
			echo "<script>alert('Cadastrado com sucesso')</script>";
        }
}
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    
    <link rel="icon" href="favicon.ico">

    <title>Cadastrar apresentações GEMATEC</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<link href="css/estilo.css" rel="stylesheet">
	
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">

    <script src="js/ie-emulation-modes-warning.js"></script>
	
	<!-- Para colocar a navbar restrita -->
	<script src="js/w3.js"></script>
	
	<script type="text/javascript" src="js/alterar_apresentacao.js"></script>
	
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
		<h1>Cadastrar Apresentações</h1>
		
		<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="cadastro" >
			<div class="panel panel-primary">
			<div class="panel-body">
			<table width = "100%" border = "0" frame="none">
		  
				<tr><td align=left>
				<label><h4>Título</h4></label></td>
				<div class="col-sm-10"><td>
					<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título"></td></tr>
				</div>
				<br>

				<tr><td align=left>
				<label><h4>Autor(es)</h4></label>
				<a tabindex="0" class="btn btn-primary btn-xs" role="button" data-toggle="popover" data-trigger="focus" title="Ajuda" data-content="Por definião, adicione cada autor com o sobrenome em caixa alta separado por vírgula, e as abreviações dos nomes. Por fim, separe cada autor com um ponto e vírgula. Ex.: SOBRENOME1,N.; SOBRENOME2,A.;">?</a> <!-- Criar o popup de ajuda -->
				</td>
				<div class="col-sm-10"><td>
				  <input type="text" class="form-control" id="autor" name="autor" placeholder="Autor"></td></tr>
				</div>

				<tr><td align=left>
				<label><h4>Palavras-chave</h4></label>
				<a tabindex="0" class="btn btn-primary btn-xs" role="button" data-toggle="popover" data-trigger="focus" title="Ajuda" data-content="Por definição, adicione cada palavra-chave separada por um ponto final.">?</a> <!-- Criar o popup de ajuda -->
				</td>
				<div class="col-sm-10"><td>
				  <input type="text" class="form-control" id="palavras_chave" name="palavras_chave" placeholder="Palavras-chave"></td></tr>
				</div>
			  
				<tr><td align=left>
				<label><h4>Ano de Publicação</h4></label></td>
				<div class="col-sm-10"><td>
					<select class="form-control" id="ano" name="ano">
						<option>Ano de Publicação</option>
						<?php for($data_ano = date("Y");$data_ano>=1980;$data_ano--) { ?>
						<option value="<?php echo $ano_array2[$data_ano]; ?>"><?php echo $ano_array2[$data_ano]; ?></option>
						<?php } ?>
					</select></td></tr>	
				</div>
			  
				<tr><td align=left>
				<label><h4>Documento da Apresentação</h4></label>
				<a tabindex="0" class="btn btn-primary btn-xs" role="button" data-toggle="popover" data-trigger="focus" title="Ajuda" data-content="Adicione o arquivo correspondente ao documento da apresentação (.pptx, .ppt, .pdf)">?</a> <!-- Criar o popup de ajuda -->
				</td>
				<div class="col-sm-10"><td>
					<input type="file" name="apresentacao" class="form-control" id="apresentacao"></td></tr>
				</div>
			</table>
			<hr>
			<table width = "95%" border = "0" frame="none">
				<tr><td align=center><br>
				<button type="submit" name="cadastrar" id="cadastrar" onClick="Confirma_cadastro()" class="btn btn-primary btn-lg"> Cadastrar</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
				<input type="reset"  class="btn btn-warning btn-lg" name="apagar" id="apagar" value="Apagar Campos"></td></tr>
			</table>
			</div>
			</div>
		</form>	
		<hr/>

		<h1>Apresentações Cadastradas no Banco de Dados</h1>
<?php
// Seleciona todos os usuários

$sql = mysql_query("SELECT * FROM apresentacoes ORDER BY id desc");

$numRegistros = mysql_num_rows($sql);

if ($numRegistros == 0) {
    echo "";
}
echo "<hr>";
// Exibe as informações de cada usuário
while ($usuario = mysql_fetch_object($sql)) {
                echo "<div class='col-sm-6 col-md-12'>";
                echo "<div class='thumbnail'>";
                echo "<div class='caption'>";
                echo "<strong><p class='destaque'>" . ($usuario->titulo) . "</p></strong><hr class='space' width='50%'>" . "<b class='titulo'>Código:</b><span> " . $usuario->id . "</span></br>" . "<b class='titulo'>Autor: </b><span>" . ($usuario->autor) . "</span></br>" . "<b class='titulo'>Palavras-chave: </b><span>" . ($usuario->palavras_chave) . "</span></br>" . "<b class='titulo'>Ano de publicação: </b><span>" . $usuario->ano . "</span><br>";
                echo "<br>";
                echo "<p><a href='Apresentacoes/" . $usuario->apresentacao . "' download=" . ($usuario->titulo) . " class='btn btn-primary' role='button'>Download</a></p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
}
?>

 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
	
	</div>	
  </body>
</html>

