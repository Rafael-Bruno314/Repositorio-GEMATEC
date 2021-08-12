<?php 
	#include("class/protect.php");
	header( 'Content-Type: text/html; charset=utf-8' );
?>

<?php
	include('class/conectar_banco.php');
	include('ano_config.php');
?>

<?php
	error_reporting(0);
	ini_set(“display_errors”, 0);
?>

<?php
	$query  = mysql_query("SELECT * FROM arquivos");
	$query_mudar = mysql_query("SELECT * FROM arquivos ORDER BY id DESC");
	$comb   = mysql_query("SELECT * FROM tipo");
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    
    <title>Excluir arquivos GEMATEC</title>

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
	
		<noscript>Desculpe, mas seu navegador não suporta <b>JavaScript</b>, ou ele pode estar desabilitado! Sua experiência com esse sistema ficará seriamente afetada!</noscript>
	</head>

	<body>
		<div w3-include-html="css/navbar_restrita.html"></div> 
		<script>w3.includeHTML();</script>
	
		<div class="container">
			<h1>Excluir Arquivos</h1>
			<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="delete_and_update" >
				<div class="panel panel-primary">
				<div class="panel-body">
		
					<div class="col-xs-12 selectContainer">
						<select id="titulo_mudar" name="titulo_mudar" class="form-control" id="id" name="id" onChange="loadDoc(myFunction)">
							<option value="">Escolha o título da obra que deseja alterar</option>
								<?php while ($titulo_muda = mysql_fetch_array($query_mudar)) { ?>
									<option value="<?php echo ($titulo_muda['id']) ?>"><?php echo  ($titulo_muda['titulo'])?></option>
								<?php } ?>
						</select>
					</div>
					<br><br><br>
		
					<table width = "100%" border = "0" frame="none">
						<tr>
							<td align=left>
								<label><h4>Título</h4></label>
							</td>
							<div class="col-sm-10">
								<td>
									<input type="text" class="form-control" id="titulo" name="titulo" readonly placeholder="Título">
								</td>
							</div>
						</tr>
			  
						<tr>
							<td align=left>
								<label><h4>Autor(es)</h4></label>
							</td>
							<div class="col-sm-10">
								<td>
									<input type="text" class="form-control" id="autor" name="autor" readonly placeholder="Autor">
								</td>
							</div>
						</tr>
			  
						<tr>
							<td align=left>
								<label><h4>Palavras-chave</h4></label>
							</td>
							<div class="col-sm-10">
								<td>
									<input type="text" class="form-control" id="palavras_chave" name="palavras_chave" readonly placeholder="Palavras-chave">
								</td>
							</div>
						</tr>

						<tr>
							<td align=left>
								<label><h4>Tipo de Arquivo</h4></label>
							</td>
							<div class="col-sm-10">
								<td>
									<select class="form-control" id="tipo" name="tipo" onChange="Add_tipo()" readonly="readonly" tabindex="-1" aria-disabled="true">
										<option value="selecione">Selecione</option>
										<?php while ($prod = mysql_fetch_array($comb)) { ?>
											<option value="<?php echo ($prod['tipo']); ?>"><?php echo ($prod['tipo']); ?></option>
										<?php } ?>
										<option value="outro">Outro</option>
									</select>
									<input type="text" id="trapaca_tipo" name="trapaca_tipo" style="display: none">
								</td>
							</div>
						</tr>

						<tr>
							<td align=left>
								<label><h4>Ano de Publicação</h4></label>
							</td>
							<div class="col-sm-10">
								<td>
									<select class="form-control" id="ano" name="ano" readonly="readonly" tabindex="-1" aria-disabled="true">
										<option>Ano de Publicação</option>
										<?php for ($data_ano = date("Y"); $data_ano >= 1980; $data_ano--) { ?>
											<option value="<?php echo $ano_array2[$data_ano]; ?>"><?php echo $ano_array2[$data_ano]; ?></option>
										<?php } ?>
									</select>
								</td>
							</div>
						</tr>	
					</table>
					<hr>

					<table width = "95%" border = "0" frame="none">
						<tr>
							<td align=center>
								<br>
								<button type="submit" onclick="Confirma_excluir()" name="excluir" id="excluir" class="btn btn-primary btn-lg">Excluir</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								<input type="reset"  class="btn btn-warning btn-lg" name="apagar" id="apagar" value="Apagar Campos">
							</td>
						</tr>
					</table>
				</div> 
				</div>
			</form>
			<hr>

			<?php
				if (isset($_POST['exc_dps_da_ganbiarra'])) {
					$codigo = $_POST['titulo_mudar'];
					
					if ($codigo == "") {
						echo "<script>alert('Escolha um campo válido')</script>";
					}
					else {
						$mostrar = mysql_query("SELECT * FROM `arquivos` WHERE id = '$codigo'"); 
					      
						while ($row = mysql_fetch_object($mostrar)) {
							$id = $row->id;
							$titulo = $row->titulo;
							$autor = $row->autor;
							$palavras_chave = $row->palavras_chave;
							$ano = $row->ano;
							$tipo = $row->tipo;
							$arquivo = $row->arquivo;
						}
        
        		$excluir = "DELETE FROM `arquivos` WHERE id = '$codigo'"; //Linha problema!!!
        
						if($arquivo != "") {
							$diretorio = "Arquivos/";
							$arquivo_apagado = $diretorio . $arquivo;
							unlink($arquivo_apagado);
						}
        
						if (!$excluir) {
							echo "<script>alert('Não foi possível excluir o arquivo')</script>";
						} 
						else {
							echo "<script>alert('Excluído com sucesso')</script>";
						}
        
        		mysql_query($excluir, $conn) or die("<font style=Arial color=red><h1>Houve um erro na exclusão dos dados</h1></font>");
        
        		echo '<meta HTTP-EQUIV="Refresh" CONTENT="0">';
					}
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