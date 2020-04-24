<?php
	include('../class/conectar_banco.php');
	$gmtDate = gmdate("D, d M Y H:i:s"); 
	header("Expires: {$gmtDate} GMT"); 
	header("Last-Modified: {$gmtDate} GMT"); 
	header("Cache-Control: no-cache, must-revalidate"); 
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=utf-8",true);

	$mudar = $_GET["manda"];
	$sql = mysql_query("SELECT * FROM arquivos WHERE id = ".$mudar);
	$numRegistros = mysql_num_rows($sql);

	if ($numRegistros != 0) {

		while ($informacoes = mysql_fetch_object($sql)) {
				echo $informacoes->titulo."@";
				echo $informacoes->autor."@";
				echo $informacoes->palavras_chave."@";
				echo $informacoes->tipo."@";
				echo $informacoes->ano."@";
		}
	}
?>