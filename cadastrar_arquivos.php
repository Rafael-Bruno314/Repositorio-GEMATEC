<?php 
	#include("class/protect.php");
	header( 'Content-Type: text/html; charset=utf-8' );
?>

<?php
	error_reporting(0);
	ini_set(“display_errors”, 0);
?>

<?php
	include('class/conectar_banco.php');
	include('ano_config.php');
	$query = mysql_query("SELECT * FROM tipo");
?>

<?php
	// Se o usuário clicou no botão cadastrar efetua as ações
	if (isset($_POST['cad_dps_da_ganbiarra'])) {
    $autor = ($_POST['autor']);
    $titulo = ($_POST['titulo']);
    $palavras_chave = ($_POST['palavras_chave']);
    $ano = $_POST['ano'];
    $arquivo = $_FILES["arquivo"];
    $tipo = ($_POST['tipo']);

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
		
		if($tipo == "selecione"){
			$tipo = "Indefinido";
		}
		else{
			$sql_cat = mysql_query("SELECT * FROM tipo");
			$sql_insert_cat = "INSERT INTO tipo(tipo) VALUES ('$tipo')";

			while ($informacoes = mysql_fetch_object($sql_cat)) {
				if($informacoes->tipo == $tipo){
					$sql_insert_cat = "SELECT * FROM tipo";
				}
			}
			mysql_query($sql_insert_cat);
		}
				
    if(!empty($_FILES['arquivo']['name'])){
			//arquivo
			// Pega extensão da imagem
			preg_match("/\.(pdf|docx|doc){1}$/i", $arquivo["name"], $ext);
			if ($ext[1] != "pdf" && $ext[1] != "docx" && $ext[1] != "doc") {
				echo "<script>alert('Formato de arquivo inválido!\\nPor favor utilize os formatos pdf, docx ou doc')</script>";
			}
			else {
				// Gera um nome único para a imagem
				$nome_arquivo = md5(uniqid(time())) . "." . $ext[1];
				
				// Caminho de onde ficará a imagem
				$caminho_arquivo = "Arquivos/" . $nome_arquivo;
				
				// Faz o upload da imagem para seu respectivo caminho
				move_uploaded_file($arquivo["tmp_name"], $caminho_arquivo);
				//fim arquivo			

			}
		}
		
		// Insere os dados no banco							
		$sql = "INSERT INTO arquivos(autor,tipo,titulo,palavras_chave,ano,arquivo) VALUES ('$autor','$tipo','$titulo','$palavras_chave','$ano','$nome_arquivo')"; //Linha problema!!!
		mysql_query($sql, $conn) or die("<font style=Arial color=red><h1>Houve um erro na gravação dos dados</h1></font>");
			
		if (!$sql) {
			echo "<script>alert('Não foi possível cadastrar o arquivo')</script>";
		} 
		else {
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
    
    <title>Cadastrar arquivos GEMATEC</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="favicon.ico">
		<link href="css/estilo.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">

    <script src="js/ie-emulation-modes-warning.js"></script>
		<!-- Para colocar a navbar restrita -->
		<script src="js/w3.js"></script> 
		<script type="text/javascript" src="js/alterar_arquivo.js"></script>
		<script type="text/javascript" src="js/code_jquery.js"></script>
		<script>
			$(function () {
				$('[data-toggle="popover"]').popover()
			})
		</script>

		<noscript>Desculpe, mas seu navegador não suporta <b>JavaScript</b>, ou ele pode estar desabilitado! Sua experiência com esse sistema ficará seriamente afetada!</noscript>
  </head>

  <body>
		<div w3-include-html="css/navbar_restrita.html"></div> 
		<script>w3.includeHTML();</script>
		
		<div class="container">
			<h1>Cadastrar Arquivos</h1>
	
			<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="cadastro" >
				<div class="panel panel-primary">
				<div class="panel-body">
					<table width = "100%" border = "0" frame="none">
						<tr>
							<td align=left>
								<label><h4>Título</h4></label>
							</td>
							<div class="col-sm-10">
								<td>
					  			<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título">
								</td>
							</div>
						</tr>
				  
						<tr>
							<td align=left>
								<label><h4>Palavras-chave</h4></label>
								<a tabindex="0" class="btn btn-primary btn-xs" role="button" data-toggle="popover" data-trigger="focus" title="Ajuda" data-content="Por definição, adicione cada palavra-chave separada por um ponto final.">?</a> <!-- Criar o popup de ajuda -->
							</td>
							<div class="col-sm-10">
								<td>
					  			<input type="text" class="form-control" id="palavras_chave" name="palavras_chave" placeholder="Palavras-chave">
								</td>
							</div>
						</tr>

						<tr>
							<td align=left>
								<label><h4>Autor(es)</h4></label>
								<a tabindex="0" class="btn btn-primary btn-xs" role="button" data-toggle="popover" data-trigger="focus" title="Ajuda" data-content="Por definião, adicione cada autor com o sobrenome em caixa alta separado por vírgula, e as abreviações dos nomes. Por fim, separe cada autor com um ponto e vírgula. Ex.: SOBRENOME1,N.; SOBRENOME2,A.;">?</a> <!-- Criar o popup de ajuda -->
							</td>
							<div class="col-sm-10">
								<td>
					  			<input type="text" class="form-control" id="autor" name="autor" placeholder="Autor">
								</td>
							</div>
						</tr>

						<tr>
							<td align=left>
								<label><h4>Tipo de Arquivo</h4></label>
							</td>
							<div class="col-sm-10">
								<td>
									<select class="form-control" id="tipo" name="tipo" onChange="Add_tipo()">
										<option value="selecione">Selecione</option>
											<?php while ($prod = mysql_fetch_array($query)) { ?>
										<option value="<?php echo  ($prod['tipo']); ?>"><?php echo  ($prod['tipo']); ?></option>
											<?php } ?>
										<option value="outro">Outro</option>
									</select>
								</td>
							</div>
						</tr>
						<input type="text" id="trapaca_tipo" name="trapaca_tipo" style="display: none">

						<tr>
							<td align=left>
								<label><h4>Ano de Publicação</h4></label>
							</td>
							<div class="col-sm-10">
								<td>
									<select class="form-control" id="ano" name="ano">
										<option>Ano de Publicação</option>
											<?php for($data_ano = date("Y");$data_ano>=1980;$data_ano--) { ?>
										<option value="<?php echo $ano_array2[$data_ano]; ?>"><?php echo $ano_array2[$data_ano]; ?></option>
											<?php } ?>
									</select>
								</td>
							</div>
						</tr>	

						<tr>
							<td align=left>
								<label><h4>Documento do Arquivo</h4></label> <a tabindex="0" class="btn btn-primary btn-xs" role="button" data-toggle="popover" data-trigger="focus" title="Ajuda" data-content="Adicione o arquivo correspondente ao documento do arquivo (.pdf, .docx, .doc). Evite arquivos com nomes muito grandes">?</a> 
							</td>
							<div class="col-sm-10">
								<td>
									<input type="file" name="arquivo" class="form-control" id="arquivo">
								</td>
							</div>
						</tr>
					</table>
					<hr>

		  		<table width = "95%" border = "0" frame="none">
						<tr>
							<p class="help-block"></p>
						</tr>
						<tr>
							<td align=center>
								<br>
								<button type="submit" name="cadastrar" id="cadastrar" onClick="Confirma_cadastro()" class="btn btn-primary btn-lg">Cadastrar</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								<input type="reset"  class="btn btn-warning btn-lg" name="apagar" id="apagar" value="Apagar Campos">
							</td>
						</tr>
					</table>
				</div>
				</div>
			</form>	
			<hr/>

			<h1>Arquivos Cadastrados no Banco de Dados</h1>
			
			<?php
				// Seleciona todos os usuários
				$sql = mysql_query("SELECT * FROM arquivos ORDER BY id desc");
				$numRegistros = mysql_num_rows($sql);

				if ($numRegistros == 0) {
						echo "";
				}
				echo "<hr>";

				// Exibe as informações de cada usuário
				while ($arquivos = mysql_fetch_object($sql)) {
					echo "<div class='col-sm-6 col-md-6'>";
					echo "<div class='thumbnail'>";
					echo "<div class='caption'>";
					echo "<strong><p class='destaque'> <a href='Arquivos/" . $arquivos->arquivo . " 'target='_blank'' class='titulo'>" .  ($arquivos->titulo) . "</p></strong></a><hr class='space' width='50%'>" . "<b class='titulo'>Tipo de texto: </b><span>" .  ($arquivos->tipo) . "</span></br>" . "<b class='titulo'>Autor: </b><span>" .  ($arquivos->autor) . "</span></br>" . "<b class='titulo'>Palavras-chave: </b><span>" .  ($arquivos->palavras_chave) . "</span></br>" . "<b class='titulo'>Ano de publicação: </b><span>" . $arquivos->ano . "</span><br><br>";
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