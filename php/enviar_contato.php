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

	// Recupera os dados dos campos
  $email = $_POST['email'];
  $nome = $_POST['nome'];
  $mensagem = $_POST['mensagem'];
		
	#$conteudo = "Email do remetente: ".$email."\n\nNome: ".$nome."\n\n\nMensagem: ".$mensagem;
	$conteudo = "Email do remetente: ".$email;
	$conteudo .= "\n\nNome: ".$nome;
	$conteudo .= "\n\n\nMensagem: ".$mensagem;
	$conteudo = nl2br($conteudo);

	$envio = mail("ferry.gematec@gmail.com", $nome, $conteudo); //email a ser enviado/assunto/mensagem

  if (!$envio) {
	  echo "Ocorreu um erro no envio. Tente mais tarde...";
	} 
	else {
		echo "Email enviado com sucesso";
	}
?>