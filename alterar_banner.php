<?php
  include('class/conectar_banco.php');
  include('ano_config.php');
?>

<?php
  #error_reporting(0);
  #ini_set(“display_errors”, 0);
?>

<?php
  $query  = mysql_query("SELECT * FROM usuarios");
  $query2 = mysql_query("SELECT * FROM usuarios");
  $query_mudar = mysql_query("SELECT * FROM usuarios ORDER BY titulo");
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <title>Alterar banners GEMATEC</title>
    
    <link rel="icon" href="favicon.ico">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
    
    <script type="text/javascript" src="js/bibliotecaAjax.js"></script>
    <script src="js/ie-emulation-modes-warning.js"></script>
    <!-- Para colocar a navbar restrita -->
    <script src="js/w3.js"></script>

    <script type="text/javascript" src="js/alterar_banner.js"></script>
    <script type="text/javascript" src="js/code_jquery.js"></script>
    <script>
      $(function () {
        $('[data-toggle="popover"]').popover()
      })
    </script>
    
    <noscript>Desculpe, mas seu navegador não suporta <b>JavaScript</b>, ou ele pode estar desabilitado! Sua experiência com esse sistema ficará seriamente afetada!</noscript>
  </head>

  <body>
    <!-- Para colocar a navbar restrita -->
    <div w3-include-html="css/navbar_restrita.html"></div> 
    <!-- Para colocar a navbar restrita -->
    <script>w3.includeHTML();</script>
	
	  <div class="container">
		  <h1>Alterar Banners</h1>
		  <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="delete_and_update" >
			  <div class="panel panel-primary">
			    <div class="panel-body">

			      <div class="col-xs-12 selectContainer">
			        <select id="titulo_mudar" name="titulo_mudar" class="form-control" id="id" name="id" onChange="loadDoc(myFunction)">
				        <option value="">Escolha o título da obra que deseja alterar</option>
				          <?php while ($titulo_muda = mysql_fetch_array($query_mudar)) { ?>
				        <option value="<?php echo  ($titulo_muda['id']) ?>"><?php echo  ($titulo_muda['id']); echo " - ";echo  ($titulo_muda['titulo'])?></option>
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
					          <input type="text" class="form-control" id="titulo" name="titulo" style="display: block" placeholder="Título">
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
					        <label><h4>Autor(es)</h4></label>
					        <a tabindex="0" class="btn btn-primary btn-xs" role="button" data-toggle="popover" data-trigger="focus" title="Ajuda" data-content="Por definião, adicione cada autor com o sobrenome em caixa alta separado por vírgula, e as abreviações dos nomes. Por fim, separe cada autor com um ponto e vírgula. Ex.: SOBRENOME1,N.; SOBRENOME2,A.;">?</a> <!-- Criar o popup de ajuda -->
					      </td>
					      <div class="col-sm-10">
                  <td>
					          <input type="text" class="form-control" id="autor" name="autor" placeholder="Autor">
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
						            <?php for ($data_ano = date("Y"); $data_ano >= 1980; $data_ano--) {?>
						          <option value="<?php echo $ano_array2[$data_ano]; ?>"><?php echo $ano_array2[$data_ano]; ?></option>
					            	<?php } ?>
					          </select>
                  </td>
					      </div>
              </tr>	

				      <tr>
                <td align=left>
					        <label><h4>Arquivo do Banner</h4></label>
					        <a tabindex="0" class="btn btn-primary btn-xs" role="button" data-toggle="popover" data-trigger="focus" title="Ajuda" data-content="Adicione o arquivo correspondente a uma imagem visual do banner (.jpg, .png)">?</a> <!-- Criar o popup de ajuda -->
					      </td>
					      <div class="col-sm-10">
                  <td>
                    <input type="file" name="banner" class="form-control" id="banner">
                  </td>
                </div>
              </tr>
			      </table>
            <br><br><hr>

			      <table width = "95%" border = "0" frame="none">
				      <tr>
                <td align=center>
					        <button type="submit" name="alterar" id="alterar" onClick="Confirma()" class="btn btn-primary btn-lg">Alterar</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					        <input type="reset"  class="btn btn-warning btn-lg" name="apagar" id="apagar" value="Apagar Campos">
                </td>
              </tr>
			      </table>
			    </div>
			  </div>
		  </form>
		  <hr>
		</div>

    <?php
      if (isset($_POST['alt_dps_da_ganbiarra'])) {
        $codigo = $_POST['titulo_mudar'];
        $autor = $_POST['autor'];
        $titulo = $_POST['titulo'];
        $palavras_chave = $_POST['palavras_chave'];
        $ano = $_POST['ano'];
        $banner = $_FILES["banner"];
      
        if ($codigo == "") {
          echo "<script>alert('Por favor digite um código válido para alterar');</script>";
        } 
        else {
          if (!empty($_FILES['banner']['name'])) {
              // Pega extensão da imagem
              preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $banner["name"], $ext);
          
              if ($ext[1] != "jpg" && $ext[1] != "png") {
                echo "<script>alert('Aviso: A imagem não foi adicionada ou possui um formato inválido!\\n Por favor utilize os formatos jpg ou png')</script>";
          
                $query = mysql_query("SELECT * FROM usuarios WHERE id= $codigo");
                $usuario = mysql_fetch_array($query);
                $nome_imagem   = $usuario['banner'];
                $nome_imagem_t = $usuario['thumb'];
              } 
              else {
                //Para apagar imagem antiga ao alterar!
                $excluindo = mysql_query("SELECT * FROM usuarios WHERE id= $codigo");
                while ($row = mysql_fetch_object($excluindo)) {
                $endereco = $row->banner;
              }
                
              if($endereco != "sem_imagem.jpg")
              {
                $diretorio = "Banners/";
                $apagar  = $diretorio . $endereco;
                unlink($apagar);
              }
                      
              // Gera um nome único para a imagem
              $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
              // Caminho de onde ficará a imagem
              $caminho_imagem = "Banners/" . $nome_imagem;
              // Faz o upload da imagem para seu respectivo caminho
              move_uploaded_file($banner["tmp_name"], $caminho_imagem);
              //fim banner			
                      
              if ($ext[1] == "jpg") {
                //Para apagar imagem antiga ao alterar!
                $excluindo = mysql_query("SELECT * FROM usuarios WHERE id= $codigo");
                while ($row = mysql_fetch_object($excluindo)) {
                $endereco = $row->thumb;
              }
                  
              if($endereco != "sem_imagem.jpg"){
                $diretorio = "Thumbs/";
                $apagar  = $diretorio . $endereco;
                unlink($apagar);
              }
                  
              //thumb
              // Gera um nome único para a imagem
              $nome_imagem_t = md5(uniqid(time())) . ".jpg";
              // Retorna o identificador da imagem
              $imagem = imagecreatefromjpeg($caminho_imagem);
              // Cria duas variáveis com a largura e altura da imagem
              list($largura, $altura) = getimagesize($caminho_imagem);
              // Nova largura e altura
              $nova_largura = 175;
              $nova_altura  = 235;
              // Cria uma nova imagem em branco
              $nova_imagem = imagecreatetruecolor($nova_largura, $nova_altura);
              // Copia a imagem para a nova imagem com o novo tamanho
              imagecopyresampled(
                $nova_imagem, // Nova imagem 
                $imagem, // Imagem original
                0, // Coordenada X da nova imagem
                0, // Coordenada Y da nova imagem 
                0, // Coordenada X da imagem 
                0, // Coordenada Y da imagem  
                $nova_largura, // Nova largura
                $nova_altura, // Nova altura
                $largura, // Largura original
                $altura // Altura original
              );
              // Cria a imagem
              $thumb = imagejpeg($nova_imagem, $nome_imagem_t, 100);
              // Caminho de onde ficará a imagem
              $caminho_imagem_t = "Thumbs/" . $nome_imagem_t;
              rename($nome_imagem_t, $caminho_imagem_t);
              // Remove as imagens temporárias
              imagedestroy($imagem);
              imagedestroy($nova_imagem);
              //fim thumb
            }
            
            if ($ext[1] == "png") {
              //thumb
              //Para apagar imagem antiga ao alterar!
              $excluindo = mysql_query("SELECT * FROM usuarios WHERE id= $codigo");
              while ($row = mysql_fetch_object($excluindo)) {
                $endereco = $row->thumb;
              }
                  
              if($endereco != "sem_imagem.jpg"){
                $diretorio = "Thumbs/";
                $apagar  = $diretorio . $endereco;
                unlink($apagar);
              }
                          
              // Gera um nome único para a imagem
              $nome_imagem_t = md5(uniqid(time())) . ".png";
              // Retorna o identificador da imagem
              $imagem = imagecreatefrompng($caminho_imagem);
              // Cria duas variáveis com a largura e altura da imagem
              list($largura, $altura) = getimagesize($caminho_imagem);
              // Nova largura e altura
              $nova_largura = 175;
              $nova_altura  = 235;
              // Cria uma nova imagem em branco
              $nova_imagem = imagecreatetruecolor($nova_largura, $nova_altura);
              // Copia a imagem para a nova imagem com o novo tamanho
              imagecopyresampled(
                $nova_imagem, // Nova imagem 
                $imagem, // Imagem original
                0, // Coordenada X da nova imagem
                0, // Coordenada Y da nova imagem 
                0, // Coordenada X da imagem 
                0, // Coordenada Y da imagem  
                $nova_largura, // Nova largura
                $nova_altura, // Nova altura
                $largura, // Largura original
                $altura // Altura original
              );
              
              // Cria a imagem
              $thumb = imagejpeg($nova_imagem, $nome_imagem_t, 9);
              // Caminho de onde ficará a imagem
              $caminho_imagem_t = "Thumbs/" . $nome_imagem_t;
              rename($nome_imagem_t, $caminho_imagem_t);
              // Remove as imagens temporárias
              imagedestroy($imagem);
              imagedestroy($nova_imagem);
              //fim thumb
            }
          }
        } 
        else {
          $query = mysql_query("SELECT * FROM usuarios WHERE id= $codigo");
          $usuario = mysql_fetch_array($query);
          $nome_imagem   = $usuario['banner'];
          $nome_imagem_t = $usuario['thumb'];
        }
      
          if ($titulo == "" && $ano == "" && $autor == "" && $palavras_chave == "" && $codigo == "Selecione") {
            echo "<h2>Os campos não foram preenchidos</h2>";
          }
          else {
            if ($autor == "") {
              $query = mysql_query("SELECT * FROM usuarios WHERE id= $codigo");
              $usuario = mysql_fetch_array($query);
              $autor = $usuario['autor'];
            }
          
            if ($titulo == "") {
              $query = mysql_query("SELECT * FROM usuarios WHERE id= $codigo");
              $usuario = mysql_fetch_array($query);
              $titulo = $usuario['titulo'];
            }
          
            if ($palavras_chave == "") {
              $query = mysql_query("SELECT * FROM usuarios WHERE id= $codigo");
              $usuario = mysql_fetch_array($query);
              $palavras_chave = $usuario['palavras_chave'];
            }
        
            if ($ano == 0) {
              $query = mysql_query("SELECT * FROM usuarios WHERE id= $codigo");
              $usuario = mysql_fetch_array($query);
              $ano = $usuario['ano'];
            }
      
            $alterar = "UPDATE `usuarios` SET `autor`= '$autor',`titulo`= '$titulo',`palavras_chave`='$palavras_chave',`ano`='$ano',`banner`='$nome_imagem',`thumb`='$nome_imagem_t' WHERE id = '$codigo'"; //Vai alterar o banner e a thumb!
      
            if (!$alterar) {
              echo "<script>alert('Não deu...')</script>";
            }
            else {
              echo "<script>alert('Alterado com sucesso')</script>";
            }
      
            mysql_query($alterar, $conn) or die("<font style=Arial color=red><h1>Houve um erro na alteração dos dados</h1></font>");
      
            $busca = mysql_query("SELECT * FROM usuarios WHERE id= $codigo");
      
            while ($usuario = mysql_fetch_object($busca)) {
              echo "<div class='row'>";
              echo "<div class='thumbnail'>";
              echo "<table>";
              echo "<tr><td>";
              echo "<a href='Banners/" . $usuario->banner . " 'target='_blank'' ><img src='Thumbs/" . $usuario->thumb . "' alt='Foto de exibição' /></a>";
              echo "</td><td width='10%' color: 'green'>";
              echo "</td><td>";
              echo "<p><b class='titulo'>Código: </b><span>" . $usuario->id . "</span></br></p><p><b class='titulo'>Título: </b><span>" .  ($usuario->titulo) . "</span></br></p><p>" . "<b class='titulo'>Autor: </b><span>" .  ($usuario->autor) . "</span></br></p><p>" . "<b class='titulo'>Palavras-chave: </b><span>" .  ($usuario->palavras_chave) . "</span></br></p><p>" . "<b class='titulo'>Ano de publicação: </b><span>" . $usuario->ano . "</span><br><br></p>";
              echo "</td></tr>";
              echo "</table>";
              echo "</div>";
              echo "</div>";
            }
          }
        }
      }
    ?>

      <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
      <script src="js/bootstrap.min.js"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <!--<script src="js/ie10-viewport-bug-workaround.js"></script> -->
  </body>
</html>