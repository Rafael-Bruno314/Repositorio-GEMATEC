<?php
	include('../class/conectar_banco.php');
	$gmtDate = gmdate("D, d M Y H:i:s"); 
	header("Expires: {$gmtDate} GMT"); 
	header("Last-Modified: {$gmtDate} GMT"); 
	header("Cache-Control: no-cache, must-revalidate"); 
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=utf-8",true);

  error_reporting(0);
  ini_set(“display_errors”, 0);

	$mudar = $_GET["manda"];
	$sql = mysql_query("SELECT * FROM apresentacoes WHERE id = ".$mudar);
	$numRegistros = mysql_num_rows($sql);

	if ($numRegistros != 0) {
		while ($informacoes = mysql_fetch_object($sql)) {
			echo  ($informacoes->titulo)."@";
			echo  ($informacoes->autor)."@";
			echo  ($informacoes->ano)."@";
			echo  ($informacoes->palavras_chave)."@";
		}
	}
?>