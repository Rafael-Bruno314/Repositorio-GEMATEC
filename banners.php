<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    
    <title>Banners/Pôsteres GEMATEC</title>

    <link rel="icon" href="favicon.ico">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	  <link href="css/estilo.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">

    <script src="js/ie-emulation-modes-warning.js"></script>
    <script src="js/w3.js"></script>
    <!-- Para colocar a navbar restrita -->	
	  <script type="text/javascript" src="js/code_jquery.js"></script>			
	
    <noscript>Desculpe, mas seu navegador não suporta <b>JavaScript</b>, ou ele pode estar desabilitado! Sua experiência com esse sistema ficará seriamente afetada!</noscript>
  </head>

  <body>	
    <div w3-include-html="css/navbar_publica.html"></div> 
    <script>w3.includeHTML();</script>
    <div class="container">
      <h1>Banners/Pôsteres GEMATEC</h1>
      <hr>

      <?php
        include('ano_config.php');
      ?>

	    <form class="form-inline" name="frmBuscarBanners" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?a=buscar" >
        <div class="form-group">
          <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título">
        </div>
        
        <div class="form-group">
          <input type="text" class="form-control" id="autor" name="autor" placeholder="Autor(es)">
        </div>
        
        <div class="form-group">
          <input type="text" class="form-control" id="palavras_chave" name="palavras_chave" placeholder="Palavras-chave">
        </div>
        
        <div class="form-group">
          <select class="form-control" id="ano" name="ano">
            <option value = "ano">Ano de Publicação</option>
              <?php for($data_ano = date("Y");$data_ano>=1980;$data_ano--) { ?>
            <option value="<?php echo $ano_array2[$data_ano]; ?>"><?php echo $ano_array2[$data_ano]; ?></option>
              <?php } ?>
          </select>
        </div>

        <button type="submit" class="btn btn-primary" value="Buscar">Buscar</button>
	    </form>
	    <br>
	    <hr>
    <div>
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

<?php
  error_reporting(0);
  ini_set(“display_errors”, 0);
?>

<?php
  include('class/conectar_banco.php');

  // Recuperamos a ação enviada pelo formulário
  $a = $_GET['a'];

  // Verificamos se a ação é de busca
  if ($a == "buscar") {
    
    $titulo = (trim($_POST['titulo']));
    $ano = trim($_POST['ano']);
    $autor = (trim($_POST['autor']));
    $palavras_chave = (trim($_POST['palavras_chave']));

    if ($ano == "ano") {
      $sql = mysql_query("SELECT * FROM usuarios WHERE titulo LIKE '%" . $titulo . "%' AND autor LIKE '%" . $autor . "%' AND palavras_chave LIKE '%" . $palavras_chave . "%' ORDER BY titulo"); //Busca Multipla, yeah!!!
    }
    else {
      $sql = mysql_query("SELECT * FROM usuarios WHERE titulo LIKE '%" . $titulo . "%' AND ano LIKE '%" . $ano . "%' AND autor LIKE '%" . $autor . "%' AND palavras_chave LIKE '%" . $palavras_chave . "%' ORDER BY titulo"); //Busca Multipla, yeah!!!!
    }
      
    // Descobrimos o total de registros encontrados
    $numRegistros = mysql_num_rows($sql);
        
    // Se houver pelo menos um registro, exibe-o
    if ($numRegistros != 0) {

      while ($usuario = mysql_fetch_object($sql)) {
        
        if($usuario->ano == 0){
          $marca= "______";
        }
				else{
          $marca = $usuario->ano;
        }
				
        echo "<div class='row'>";
        echo "<div class='thumbnail'>";
        echo "<table>";
        echo "<tr><td>";
        echo "<a href='Banners/" . $usuario->banner . " 'target='_blank'' ><img src='Thumbs/" . $usuario->thumb . "' alt='Foto de exibição' /></a>";
        echo "</td><td width='10%' color: 'green'>";
        echo "</td><td>";
        echo "<p><b class='titulo'>Título: </b><span>" . $usuario->titulo . "</span></br></p><p>" . "<b class='titulo'>Autor: </b><span>" . $usuario->autor . "</span></br></p><p>" . "<b class='titulo'>Palavras-chave: </b><span>" . $usuario->palavras_chave . "</span></br></p><p>" . "<b class='titulo'>Ano de publicação: </b><span>" . $marca . "</span><br><br></p>";
        echo "<a href='Banners/" . $usuario->banner . "' target='_blank'' class='btn btn-primary' role='button'><div class='space'>Abrir</div></a>    <a href='Banners/" . $usuario->banner . "' download=" . $usuario->titulo . " class='btn btn-default' role='button'>Download</a>";
        echo "</td></tr>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
      }
    }
    else {
      echo "<h1>Nenhum banner foi encontrado</h1> <br><br><br><br> <hr>";
    }
  }
?>

<html>
  <body>
	  <!-- Para colocar a navbar restrita -->
	  <div w3-include-html="css/rodape.html"></div> 
	  <!-- Para colocar a navbar restrita -->
	  <script>w3.includeHTML();</script>
  </body>
</html>