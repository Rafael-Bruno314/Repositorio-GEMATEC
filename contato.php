<?php
error_reporting(0);
ini_set(“display_errors”, 0);
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

    <title>Contato GEMATEC</title>
	
	<script type="text/javascript" src="js/bibliotecaAjax.js"></script>
	
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
	
	<noscript>Desculpe, mas seu navegador não suporta <b>JavaScript</b>, ou ele pode estar desabilitado! Sua experiência com esse sistema ficará seriamente afetada!</noscript>
	
	<script type="text/javascript" src="js/code_jquery.js"></script>
	
	<script type="text/javascript" src="js/contato.js"></script>
		<!-- Para colocar a navbar restrita -->	<script src="js/w3.js"></script>
	
</head>
<body>
	<!-- Para colocar a navbar restrita -->	<div w3-include-html="css/navbar_publica.html"></div> 	<!-- Para colocar a navbar restrita -->	<script>w3.includeHTML();</script>

<div class="container">

    <h1>Contato:</h1>

  <form id="theForm" class="form-horizontal" action="javascript:void%200" method="post" enctype="multipart/form-data" name="cadastro" >
    <div class="panel panel-primary">
	<div class="panel-body">
	
    <table width = "100%" border = "0" frame="none">
		
          <div class="form-group">
          <tr><td align=left>
            <label><h4>Nome Completo:</h4></label></td>
            <div class="col-sm-10"><td>
              <input type="text" class="form-control" value="" id="nome" onblur="alerta(this.value)" name="nome" placeholder="Nome completo"></td></tr>
            </div>
          </div>
          
          <div class="form-group">
          <tr><td align=left>
            <label><h4>E-mail:</h4></label></td>
            <div class="col-sm-10"><td>
              <input type="email" class="form-control" value="" id="email" name="email" onblur="alerta(this.value)" placeholder="E-mail"></td></tr>
            </div>
           </div>
          
          <div class="form-group">
          <tr><td align=left>
            <label><h4>Mensagem:</h4></label></td>
            <div class="col-sm-10"><td>    <br>
                <textarea rows="6" cols="50" value="" name="mensagem" id="mensagem" onblur="alerta(this.value)" class="form-control"></textarea></td></tr>
            </div>
          </div>
		  
		  <tr><div id="mostrar" class="alert alert-warning alert-dismissible" style="display: none">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Aviso!</strong> Por favor, Preencha todas as informações!
		  </div></tr>
			
    </table>
          <hr>
          <table width = "95%" border="0">
            <div class="form-group">
			<tr><td align=center >
              <button type="submit" id="enviar" name="enviar" class="btn btn-primary btn-lg" onClick="Confirma()">Enviar</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			  <input type="reset"  class="btn btn-warning btn-lg" name="apagar" id="apagar" value="Apagar Campos">

			</div></td></tr>
          </table>
	</div>
	</div>
 </form>
		
        <br>
        <hr>
	
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

