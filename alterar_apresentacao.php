<?php 
  #include("class/protect.php");
	header( 'Content-Type: text/html; charset=utf-8' );
?>

<?php
  include('class/conectar_banco.php');
  include('ano_config.php');
?>

<?php
  error_reporting(0);
  ini_set(“display_errors”, 0);
?>

<?php
  $query  = mysql_query("SELECT * FROM apresentacoes");
  $query2 = mysql_query("SELECT * FROM apresentacoes");
  $query_mudar = mysql_query("SELECT * FROM apresentacoes ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    
    <link rel="icon" href="favicon.ico">

    <title>Alterar apresentações GEMATEC</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	  <link href="css/estilo.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
    <!-- Para colocar a navbar restrita -->
    <script src="js/w3.js"></script>
    <script type="text/javascript" src="js/alterar_apresentacao.js"></script>
    <script type="text/javascript" src="js/code_jquery.js"></script>
    
    <script>
      $(function () {
        $('[data-toggle="popover"]').popover()
      })
	  </script>
	
	  <noscript>Desculpe, mas seu navegador não suporta <b>JavaScript</b>, ou ele pode estar desabilitado! Sua experiência com esse sistema ficará seriamente afetada!</noscript>
	</head>
  
  <style>
    p.destaque
    {
      font-size: 25px;
      color: #421E65;
    }
  </style>
  <body>
	
	  <div w3-include-html="css/navbar_restrita.html"></div> 
	  <script>w3.includeHTML();</script>
	
	  <div class="container">
      <h1>Alterar Apresentações</h1>
      
      <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="delete_and_update" >	
        <div class="panel panel-primary">
          <div class="panel-body">

		        <div class="col-xs-12 selectContainer">
              <select id="titulo_mudar" name="titulo_mudar" class="form-control" id="id" name="id" onChange="loadDoc(myFunction)">
                <option value="">Escolha o título da obra que deseja alterar</option>
                  <?php while ($titulo_muda = mysql_fetch_array($query_mudar)) { ?>
                <option value="<?php echo ($titulo_muda['id']) ?>"><?php echo  ($titulo_muda['titulo'])?></option>
                  <?php } ?>
              </select>
            </div>
    
            <br><br><br>
		
			      <table width = "100%" border = "0" frame="none">
				      <tr>
                <td align=left>
                  <label><h4>Título</h4></label>
                </td>
					      <div class="col-sm-10">
                  <td>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título">
                  </td>
                </div>
              </tr>
				      <tr>
                <td align=left>
                  <label><h4>Autor(es)</h4></label>
                  <!-- Criar o popup de ajuda -->
					        <a tabindex="0" class="btn btn-primary btn-xs" role="button" data-toggle="popover" data-trigger="focus" title="Ajuda" data-content="Por definião, adicione cada autor com o sobrenome em caixa alta separado por vírgula, e as abreviações dos nomes. Por fim, separe cada autor com um ponto e vírgula. Ex.: SOBRENOME1,N.; SOBRENOME2,A.;">?</a>
				      	</td>
					      <div class="col-sm-10">
					        <td>
                    <input type="text" class="form-control" id="autor" name="autor" placeholder="Autor">
                  </td>
                </div>
              </tr>
				      <tr>
                <td align=left>
					        <label><h4>Palavras-chave</h4></label>
					          <a tabindex="0" class="btn btn-primary btn-xs" role="button" data-toggle="popover" data-trigger="focus" title="Ajuda" data-content="Por definição, adicione cada palavra-chave separada por um ponto final.">?</a> <!-- Criar o popup de ajuda -->
					      </td>
					        <div class="col-sm-10">
                    <td>
                      <input type="text" class="form-control" id="palavras_chave" name="palavras_chave" placeholder="Palavras-chave">
                    </td>
                  </div>
              </tr>
				      <tr>
                <td align=left>
                  <label><h4>Ano de Publicação</h4></label>
                </td>
					      <div class="col-sm-10">
                  <td>
					          <select class="form-control" id="ano" name="ano">
                      <option>Ano de Publicação</option>
                        <?php for ($data_ano = date("Y"); $data_ano >= 1980; $data_ano--) { ?>
                      <option value="<?php echo $ano_array2[$data_ano]; ?>"><?php echo $ano_array2[$data_ano]; ?></option>
                        <?php } ?>
                    </select>
                  </td>
                </div>
              </tr>	
				      <tr>
                <td align=left>
                  <label><h4>Apresentação</h4></label>
                  <a tabindex="0" class="btn btn-primary btn-xs" role="button" data-toggle="popover" data-trigger="focus" title="Ajuda" data-content="Adicione o arquivo correspondente ao documento da apresentação (.pptx, .ppt, .pdf). Permite-se adicionar (caso não tenha) e alterar um arquivo, mas se deseja apenas apagar um arquivo então é necessário excluir esse convite e criar outro.">?</a>
				        </td>
				        <div class="col-sm-10">
                  <td>
                    <input type="file" name="apresentacao" class="form-control" id="apresentacao">
                  </td>
				        </div>
              </tr>
            </table>
            
            <hr>
            
			      <table width = "95%" border = "0" frame="none">
				      <tr>
                <td align=center>
				          <br>
                  <button type="submit" name="alterar" id="alterar" onClick="Confirma()" class="btn btn-primary btn-lg">Alterar</button>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                  <input type="reset"  class="btn btn-warning btn-lg" name="apagar" id="apagar" value="Apagar Campos">
                </td>
              </tr>
			      </table>
		      </div> 
		    </div>
		  </form>
		  <hr>
		
      <?php
        if (isset($_POST['alt_dps_da_ganbiarra'])) {
          $codigo = $_POST['titulo_mudar'];
          $autor = ($_POST['autor']);
          $titulo = ($_POST['titulo']);
          $palavras_chave = ($_POST['palavras_chave']);
          $ano = $_POST['ano'];
          $apresentacao = $_FILES["apresentacao"];
          
          if ($codigo == "") {
            echo "<script>alert('Por favor digite um código válido para alterar');</script>";
          }
          else{
            if (!empty($_FILES['apresentacao']['name'])) {
              $excluindo = mysql_query("SELECT * FROM apresentacoes WHERE id= $codigo");
              while ($row = mysql_fetch_object($excluindo)) {
                $endereco = $row->apresentacao;
              }

              if($endereco != ""){
                $diretorio = "Apresentacoes/";
                $apagar = $diretorio . $endereco;
                unlink($apagar);
              }
            
              // Pega extensão da imagem
              preg_match("/\.(pptx|ppt|pdf){1}$/i", $apresentacao["name"], $ext);
                    
              // Gera um nome único para a imagem
              $nome_apresentacao = md5(uniqid(time())) . "." . $ext[1];
                    
              // Caminho de onde ficará a imagem
              $caminho_apresentacao = "Apresentacoes/" . $nome_apresentacao;
                    
              // Faz o upload da imagem para seu respectivo caminho
              move_uploaded_file($apresentacao["tmp_name"], $caminho_apresentacao);
            }
            else{
              $query = mysql_query("SELECT * FROM apresentacoes WHERE id= $codigo");
              $usuario = mysql_fetch_array($query);
              $nome_apresentacao = $usuario['apresentacao'];
            }
              
            if ($titulo == "" && $ano == "Ano de Publicação" && $autor == "" && $palavras_chave == "" && $codigo == "Selecione") {
              echo "<h2>Os campos não foram preenchidos</h2>";
            } 
            else {                
              if ($autor == "") {
                $query = mysql_query("SELECT * FROM apresentacoes WHERE id= $codigo");
                $usuario = mysql_fetch_array($query);
                $autor = $usuario['autor'];
              }

              if ($titulo == "") {
                $query = mysql_query("SELECT * FROM apresentacoes WHERE id= $codigo");
                $usuario = mysql_fetch_array($query);
                $titulo = $usuario['titulo'];
              }

              if ($palavras_chave == "") {
                $query = mysql_query("SELECT * FROM apresentacoes WHERE id= $codigo");
                $usuario = mysql_fetch_array($query);
                $palavras_chave = $usuario['palavras_chave'];
              }
                  
              if ($ano == "Ano de Publicação" || $ano == "") {
                $query = mysql_query("SELECT * FROM apresentacoes WHERE id= $codigo");
                $usuario = mysql_fetch_array($query);
                $ano = $usuario['ano'];
              }
              
              $alterar = "UPDATE `apresentacoes` SET `autor`= '$autor',`titulo`= '$titulo',`palavras_chave`='$palavras_chave',`ano`='$ano',`apresentacao`='$nome_apresentacao' WHERE id = '$codigo'";
                  
              if (!$alterar) {
                echo "<script>alert('Não foi possível alterar a apresentação :/')</script>";
              }else 
              {
                echo "<script>alert('Alterado com sucesso')</script>";
              }
                  
              mysql_query($alterar, $conn) or die("<font style=Arial color=red><h1>Houve um erro na alteração dos dados</h1></font>");
                  
              $busca = mysql_query("SELECT * FROM apresentacoes WHERE id= $codigo");
                  
              while ($apresentacao = mysql_fetch_object($busca)) {
                echo "<div class='col-sm-6 col-md-12'>";
                echo "<div class='thumbnail'>";
                echo "<div class='caption'>";
                echo "<strong><p class='destaque'>" .  ($apresentacao->titulo) . "</p></strong><hr class='space' width='50%'>" . "<b class='titulo'>Código:</b><span> " . $apresentacao->id . "</span></br>" . "<b class='titulo'>Autor: </b><span>" .  ($apresentacao->autor) . "</span></br>" . "<b class='titulo'>Palavras-chave: </b><span>" .  ($apresentacao->palavras_chave) . "</span></br>" . "<b class='titulo'>Ano de publicação: </b><span>" . $apresentacao->ano . "</span><br>";
                echo "<br>";
                echo "<p><a href='Apresentacoes/" . $apresentacao->apresentacao . "' download=" .  ($apresentacao->titulo) . " class='btn btn-primary' role='button'>Download</a></p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
              }
            }
          }
        }
      ?>
	  </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>