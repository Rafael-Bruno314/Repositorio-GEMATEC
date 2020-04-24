<?php
  if(!isset($_SESSION))
    session_start();
    //Login de Usários

    if(isset($_POST['login'])){
      include('class/conexao.php');
      $erro = array();

      // Captação de dados
      $senha = $_POST['password'];
      $_SESSION['email'] = $mysqli->escape_string($_POST['email']);

      // Validação de dados
      if(!filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL))
        $erro[] = "Preencha seu <strong>e-mail</strong> corretamente.";

      if(strlen($senha) < 6 || strlen($senha) > 16)
        $erro[] = "Preencha sua <strong>senha</strong> corretamente.";

        if(count($erro) == 0){
          $sql = "SELECT senha as senha, id_user as valor 
            FROM usuario 
            WHERE email = '$_SESSION[email]'";
          $que = $mysqli->query($sql) or die($mysqli->error);
          $dado = $que->fetch_assoc();
            
          if($que->num_rows == 0)
            $erro[] = "Nenhum usuário possui o <strong>e-mail</strong> informado.";

          elseif(strcmp($dado['senha'], ($senha)) == 0){
            $_SESSION['login'] = $dado['valor'];
          }
          else
                $erro[] = "<strong>Senha</strong> incorreta.";

            if(count($erro) == 0){
                echo "<script>location.href='cadastrar_banners.php';</script>";
                exit();
                unset($_SESSION['email']);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Login</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/sb-admin-2.css" rel="stylesheet">
        <link rel="icon" href="favicon.ico">
    </head>
    
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Login</h3>
                        </div>
                        <div class="panel-body">
                            <?php 
                            if(isset($erro)) 
                                if(count($erro) > 0){ ?>
                                    <div class="alert alert-danger">
                                        <?php foreach($erro as $msg) echo "$msg <br>"; ?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <form method="post" action="" role="form">
                                <fieldset>
                                    <div class="form-group">
                                        <input value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email']; ?>" class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" required placeholder="Senha" name="password" type="password" value="">
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me">Lembrar-me
                                        </label>
                                    </div>
                                    
                                    <button type="submit" name="login" value="true" class="btn btn-success btn-block">Login</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>