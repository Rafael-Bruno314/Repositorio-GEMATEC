<?php

$host = "localhost";
$usuario = "id3193443_gematec";
$senha = "gematec";
$bd = "id3193443_gematec";

$mysqli = new mysqli($host, $usuario, $senha, $bd);

if($mysqli->connect_errno)
  echo "Falha na conexão: (".$mysqli->connect_errno.") ".$mysqli->connect_error;

?>