<?php
	include('../class/conectar_banco.php');
	$gmtDate = gmdate("D, d M Y H:i:s"); 
	header("Expires: {$gmtDate} GMT"); 
	header("Last-Modified: {$gmtDate} GMT"); 
	header("Cache-Control: no-cache, must-revalidate"); 
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=utf-8",true);

	$tabela = $_GET["tabela"];
	$id = $_GET["id"];
	$deletar = "DELETE FROM `".$tabela."` WHERE id = '$id'";

	mysql_query($deletar) or die("<font style=Arial color=red><h1>Houve um erro na gravação dos dados</h1></font>");
	echo '<meta HTTP-EQUIV="Refresh" CONTENT="0">';
?>