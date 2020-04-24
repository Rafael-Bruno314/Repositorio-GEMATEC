<?php 
  #include("class/protect.php"); 
?>

<?php
  include('class/conectar_banco.php');
  include('ano_config.php');
  $query = mysql_query("SELECT * FROM genero");
?>

<?php
  error_reporting(0);
  ini_set(“display_errors”, 0);
?>

<?php
  // Se o usuário clicou no botão cadastrar efetua as ações
  if (isset($_POST['cad_dps_da_ganbiarra'])) {
    // Recupera os dados dos campos
    $autor = ($_POST['autor']);
    $titulo = ($_POST['titulo']);
    $editora = ($_POST['editora']);
    $genero = ($_POST['genero']);
    $ano = $_POST['ano'];
    $capa = $_FILES["capa"];
	
    if ($ano == "Ano de Publicação") {
      $ano = "0000";
    }
        
		if($titulo == "" || $titulo == " "){
			$titulo = "Inexistente";
		}
		
		if($autor == "" || $autor == " "){
			$autor = "Inexistente";
		}
		
		if($editora == "" || $editora == " "){
			$editora = "Inexistente";
		}
		
		if($genero == "selecione"){
			$genero = "Indefinido";
    }
    else{
			$sql_cat = mysql_query("SELECT * FROM genero");
      $sql_insert_cat = "INSERT INTO genero(genero) VALUES ('$genero')";
      
			while ($informacoes = mysql_fetch_object($sql_cat)) {
				if($informacoes->genero == $genero){
					$sql_insert_cat = "SELECT * FROM genero";
				}
			}
			mysql_query($sql_insert_cat);
		}
		
		if(!empty($_FILES['capa']['name'])){
      //capa
      // Pega extensão da imagem
      preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $capa["name"], $ext);
        
      if ($ext[1] != "jpg" && $ext[1] != "png") {
        echo "<script>alert('Formato de imagem inválida!\\n Por favor utilize os formatos jpg ou png')</script>";
        $nome_imagem   = "sem_imagem.jpg";
			  $nome_imagem_t = "sem_imagem.jpg";
      } 
      else {
        // Gera um nome único para a imagem
        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
            
        // Caminho de onde ficará a imagem
        $caminho_imagem = "Capas/" . $nome_imagem;
            
        // Faz o upload da imagem para seu respectivo caminho
        move_uploaded_file($capa["tmp_name"], $caminho_imagem);
        //fim banner			
            
        if ($ext[1] == "jpg") {
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
          $capa = imagejpeg($nova_imagem, $nome_imagem_t, 100);
                
          // Caminho de onde ficará a imagem
          $caminho_imagem_t = "Capas/" . $nome_imagem_t;
                
          rename($nome_imagem_t, $caminho_imagem_t);
                
          // Remove as imagens temporárias
          imagedestroy($imagem);
          imagedestroy($nova_imagem);
          unlink($caminho_imagem);
          //fim thumb 
        }
            
        if ($ext[1] == "png") {
          //thumb
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
          imagecopyresampled($nova_imagem, // Nova imagem 
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
          $capa = imagepng($nova_imagem, $nome_imagem_t, 8);
                
          // Caminho de onde ficará a imagem
          $caminho_imagem_t = "Capas/" . $nome_imagem_t;
                
          rename($nome_imagem_t, $caminho_imagem_t);
          // Remove as imagens temporárias
          imagedestroy($imagem);
          imagedestroy($nova_imagem);
          unlink($caminho_imagem);
          //fim thumb 
        }
      }
    }
    else{
			$nome_imagem   = "sem_imagem.jpg";
			$nome_imagem_t = "sem_imagem.jpg";
		}
                    
    $sql = "INSERT INTO livros(autor,titulo,genero,editora,ano,livro,capa) VALUES ('$autor','$titulo','$genero','$editora','$ano','$nome_livro','$nome_imagem_t')"; //Linha problema!!!
    mysql_query($sql, $conn) or die("<font style=Arial color=red><h1>Houve um erro na gravação dos dados</h1></font>");
			
		if (!$sql) {
			echo "<script>alert('Não deu...')</script>";
    } 
    else {
			echo "<script>alert('Cadastrado com sucesso')</script>";
    }
  }
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    
    <title>Cadastrar livros GEMATEC</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="favicon.ico">
	  <link href="css/estilo.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">

    <script src="js/ie-emulation-modes-warning.js"></script>
	  <!-- Para colocar a navbar restrita -->
	  <script src="js/w3.js"></script>
	  <script type="text/javascript" src="js/alterar_livro.js"></script>
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
	    <h1>Cadastro de Livros</h1>
      <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="cadastro" >
	      <div class="panel panel-primary">
	      <div class="panel-body">
		
		      <table width = "100%" border = "0" frame="none">
		        <div class="">
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
			      </div>
		        <br>
		  
		        <div class="">
		          <tr>
                <td align=left>
			            <label><h4>Autor(es)</h4></label>
			            <a tabindex="0" class="btn btn-primary btn-xs" role="button" data-toggle="popover" data-trigger="focus" title="Ajuda" data-content="Por definião, adicione cada autor separado por ponto e vírgula.">?</a> <!-- Criar o popup de ajuda -->			
                </td>
			          <div class="col-sm-10">
                  <td>
			              <input type="text" class="form-control" id="autor" name="autor" placeholder="Autor">
                  </td>
			          </div>
              </tr>
		        </div>
		  
		        <tr>
              <td align=left>
			          <label><h4>Gênero</h4></label>
              </td>
			        <div class="col-sm-10">
                <td>
				          <select class="form-control" id="genero" name="genero"  onChange="Add_genero()">
					          <option value="selecione">Selecione</option>
					            <?php while ($prod = mysql_fetch_array($query)) { ?>
					          <option value="<?php echo ($prod['genero']); ?>"><?php echo ($prod['genero']); ?></option>
					            <?php } ?>
					          <option value="outro">Outro</option>
				          </select>
                </td>
			        </div>
            </tr>
				    <input type="text" id="trapaca_genero" name="trapaca_genero" style="display: none">
		  
		        <div class="">
		          <tr>
                <td align=left>
			            <label><h4>Editora</h4></label>
                </td>
			          <div class="col-sm-10">
                  <td>
			              <input type="text" class="form-control" id="editora" name="editora" placeholder="Editora">
                  </td>
			          </div>
              </tr>
      		  </div>

		        <div class="">
		          <tr>
                <td align=left>
			            <label><h4>Ano de Publicação</h4></label>
                </td>
			          <div class="col-sm-10">
                  <td>
                    <select class="form-control" id="ano" name="ano">
                      <option>Ano de Publicação</option>
                        <?php for($data_ano = date("Y");$data_ano>=1980;$data_ano--) { ?>
                      <option value="<?php echo $ano_array2[$data_ano]; ?>"><?php echo $ano_array2[$data_ano]; ?></option>
                        <?php } ?>
                    </select>
                  </td>
			          </div>
              </tr>	
		        </div>
		  
		        <div class="">
              <tr>
                <td align=left>
                  <label><h4>Capa do Livro</h4></label>
                   <a tabindex="0" class="btn btn-primary btn-xs" role="button" data-toggle="popover" data-trigger="focus" title="Ajuda" data-content="Adicione o arquivo correspondente a uma imagem visual da capa (.jpg, .png)">?</a> <!-- Criar o popup de ajuda -->
                </td>
                <div class="col-sm-10">
                  <td>
                    <input type="file" name="capa" class="form-control" id="capa">
                  </td>
                </div>
              </tr>
            </div>
	        </table>
		      <hr>
		  
		      <table width = "95%" border = "0" frame="none">
		        <tr>
              <td align=center>
                <br>
                <button type="submit" name="cadastrar" id="cadastrar" onClick="Confirma_cadastro()" class="btn btn-primary btn-lg">Cadastrar</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <input type="reset"  class="btn btn-warning btn-lg" name="apagar" id="apagar" value="Apagar Campos">
              </td>
            </tr>
		      </table>
	      </div>
	      </div>
      </form>	
      <hr/>
		
      <h1>Livros Cadastrados no Banco de Dados</h1>
      <?php
        // Seleciona todos os usuários
        $sql = mysql_query("SELECT * FROM livros ORDER BY id desc");
        $numRegistros = mysql_num_rows($sql);

        if ($numRegistros == 0) {
          echo "";
        }
        echo "<hr>";

        // Exibe as informações de cada usuário
        while ($usuario = mysql_fetch_object($sql)) { 
          // Exibimos a foto
          print '<table border="0">';
          #echo "<tr><td><a href='Capas/" . $usuario->capa . " 'target='_blank'' ><img src='Capas/" . $usuario->capa . "' alt='Foto de exibição' /></a></td><td>&nbsp&nbsp&nbsp&nbsp</td>";
          echo "<tr><td><img src='Capas/" . $usuario->capa . "' alt='Foto de exibição' /></td><td>&nbsp&nbsp&nbsp&nbsp</td>";
          echo "&nbsp&nbsp<td align='left'><b>Título:</b> " . ($usuario->titulo) . "</br>" . " <b>Autor:</b> " . ($usuario->autor) . "</br>" . " <b>Gênero:</b> " . ($usuario->genero) . "</br>" . " <b>Editora:</b> " . ($usuario->editora) . "</br>" . " <b>Ano de publicação:</b> " . $usuario->ano . "</td></tr><br />";
          echo "<hr>";  
          print '</table>';
        }
        echo "<hr>";
      ?>

      <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
      <script src="js/bootstrap.min.js"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="js/ie10-viewport-bug-workaround.js"></script>
    </div>
  </body>
</html>