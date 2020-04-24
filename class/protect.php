<?php
  if(!function_exists("protect")){
    function protect(){
      session_start();
      if(!isset($_SESSION['login'])){
        echo "<script>location.href='login.php';</script>";
        exit('Login inválido: Redirecionando...');
      }
    }
  }
  protect();
?>