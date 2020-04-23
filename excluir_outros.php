<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
	<link rel="icon" href="favicon.ico">
    <title>Excluir Outros</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<link href="css/sticky-footer-navbar.css" rel="stylesheet">
	<script src="js/ie-emulation-modes-warning.js"></script>
	<script type="text/javascript" src="js/bibliotecaAjax.js"></script>
	<script type="text/javascript" src="js/excluir_outros.js"></script>
    <script src="js/w3.js"></script>
	<script type="text/javascript" src="js/code_jquery.js"></script>
	
	<noscript>Desculpe, mas seu navegador não suporta <b>JavaScript</b>, ou ele pode estar desabilitado! Sua experiência com esse sistema ficará seriamente afetada!</noscript>
	
  </head>
  <body>
  
  <!-- Para colocar a navbar restrita -->
    <div w3-include-html="css/navbar_restrita.html"></div> 
    <!-- Para colocar a navbar restrita -->
    <script>w3.includeHTML();</script>
  
<?php	
	include('class/conectar_banco.php');

	$query_genero = mysql_query("SELECT * FROM genero");
	$query_tipo = mysql_query("SELECT * FROM tipo");
?>

	<div class="container">
	<h1>Excluir Outros</h1>
		<div class="panel panel-primary">
		<div class="panel-body">
			
			<div class="col-xs-6 selectContainer">
			<label for="usr">Tipos:</label>
			<select id="tipo" name="tipo" class="form-control" onChange="Excluir_tipo(this.value,this.id)">
				<option value="">Tipos</option>
				<?php while($tip = mysql_fetch_array($query_tipo)) { ?> 
				<option value="<?php echo ($tip['id']) ?>"><?php echo ($tip['tipo'])?></option>
				<?php } ?>
			</select>
			</div>

			<div class="col-xs-6 selectContainer">
			<label for="usr">Gêneros:</label>
			<select id="genero" name="genero" class="form-control" onChange="Excluir_genero(this.value,this.id)">
				<option value="">Gêneros</option>
				<?php while($gener = mysql_fetch_array($query_genero)) { ?>
				<option value="<?php echo ($gener['id']) ?>"><?php echo ($gener['genero'])?></option>
				<?php } ?>
			</select>
			</div>
			
		</div>
		</div>
		<input type="text" id="recebe" name="recebe" style="display: none">
		<p id="saida"></p>
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