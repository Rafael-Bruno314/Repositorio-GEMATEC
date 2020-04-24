<?php
	$banco = "id3193443_gematec";
	$usuario = "root";
	$senha = "";
	$host = "localhost";

	// Conexão com o banco de dados
	$conn = @mysql_connect($host, $usuario, $senha) or die("Não foi possível a conexão com o Banco");

	// Selecionando banco
	$db = @mysql_select_db($banco, $conn) or die("Não foi possível selecionar o Banco");
?>