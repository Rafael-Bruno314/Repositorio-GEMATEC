<?php
// Conexão com o banco de dados
	$conn = @mysql_connect("localhost", "id3193443_gematec", "gematec") or die("Não foi possível a conexão com o Banco");
	// Selecionando banco
	$db = @mysql_select_db("id3193443_gematec", $conn) or die("Não foi possível selecionar o Banco");
?>