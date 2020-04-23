<?php



	include('../class/conectar_banco.php');

	$gmtDate = gmdate("D, d M Y H:i:s"); 

	header("Expires: {$gmtDate} GMT"); 

	header("Last-Modified: {$gmtDate} GMT"); 

	header("Cache-Control: no-cache, must-revalidate"); 

	header("Pragma: no-cache");

	header("Content-Type: text/html; charset=utf-8",true);

	

	

	$mudar = $_GET["manda"];

	

	$sql = mysql_query("SELECT * FROM livros WHERE id = ".$mudar);

	$numRegistros = mysql_num_rows($sql);

	

		if ($numRegistros != 0) {

			while ($informacoes = mysql_fetch_object($sql)) {

				echo $informacoes->titulo."@";

				echo $informacoes->genero."@";

				echo $informacoes->autor."@";

				echo $informacoes->editora."@";

				echo $informacoes->ano."@";

			}

		}

?>