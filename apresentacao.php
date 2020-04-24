<!DOCTYPE html>
<html lang="pt-br">
  <head>
	  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- As 3 meta tags acima *devem* vir em primeiro lugar dentro do `head`; qualquer outro conteúdo deve vir *após* essas tags -->
    <title>Apresentações GEMATEC</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	  <link href="css/estilo.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
	  <link rel="icon" href="favicon.ico">

    <script src="js/ie-emulation-modes-warning.js"></script>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	  <script src="js/w3.js"></script>
	  <script type="text/javascript" src="js/code_jquery.js"></script>

	  <noscript>Desculpe, mas seu navegador não suporta <b>JavaScript</b>, ou ele pode estar desabilitado! Sua experiência com esse sistema ficará seriamente afetada!</noscript>
  </head>
  
  <?php 	
	  include('class/conectar_banco.php');
	  include('ano_config.php');
  ?>
  
  <body>
    <script>w3.includeHTML();</script>	
    <div w3-include-html="css/navbar_publica.html"></div> 
    <div class="container">
	    <h1>Apresentações GEMATEC</h1>
      <hr>
	    <form class="form-inline" name="frmBusca" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?a=buscar">
        
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
            <option value="ano">Ano de Publicação</option>
              <?php for($data_ano = date("Y");$data_ano>=1980;$data_ano--) { ?>
            <option value="<?php echo $ano_array2[$data_ano]; ?>"><?php echo $ano_array2[$data_ano]; ?></option>
              <?php } ?>
          </select>
        </div>
  
        <button type="submit" class="btn btn-primary" data-loading-text="Loading..." value="Buscar">Buscar</button> 
      </form>
      <hr>
    </div>
    
    <?php
      error_reporting(0);
      ini_set(“display_errors”, 0);
    ?>

    <?php
      // Recuperamos a ação enviada pelo formulário
      $a = $_GET['a'];
      
      // Verificamos se a ação é de busca
      if ($a == "buscar") {
        $titulo = (trim($_POST['titulo']));
        $autor = (trim($_POST['autor']));
        $palavras_chave = (trim($_POST['palavras_chave']));
        $ano = trim($_POST['ano']);
          
        if ($ano == "ano") {
          $sql = mysql_query("SELECT * FROM apresentacoes WHERE titulo LIKE '%" . $titulo . "%' AND autor LIKE '%" .$autor . "%' AND palavras_chave LIKE '%" . $palavras_chave . "%' ORDER BY titulo");
        }
        else {
          $sql = mysql_query("SELECT * FROM apresentacoes WHERE titulo LIKE '%" . $titulo . "%' AND ano LIKE '%" . $ano . "%' AND autor LIKE '%" . $autor . "%' AND palavras_chave LIKE '%" . $palavras_chave . "%' ORDER BY titulo");
        }
              
        // Descobrimos o total de registros encontrados
        $numRegistros = mysql_num_rows($sql);
              
        // Se houver pelo menos um registro, exibe-o
        if ($numRegistros != 0) {
          while ($apresentacao = mysql_fetch_object($sql)) {
            echo "<div class='col-sm-6 col-md-12'>";
            echo "<div class='thumbnail'>";
            echo "<div class='caption'>";
            echo "<strong><p class='destaque'>" . ($apresentacao->titulo) . "</p></strong><hr class='space' width='50%'>" . "<b class='titulo'>Autor: </b><span>" . ($apresentacao->autor) . "</span></br>" . "<b class='titulo'>Palavras-chave: </b><span>" . ($apresentacao->palavras_chave) . "</span></br>" . "<b class='titulo'>Ano de publicação: </b><span>" . $apresentacao->ano . "</span><br>";
            echo "<br>";
            echo "<p><a href='Apresentacoes/" . $apresentacao->apresentacao . "' download=" . ($apresentacao->titulo) . " class='btn btn-primary' id='down_button' data-loading-text='Loading...' role='button'>Download</a></p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
          }      
          // Se não houver registros
        } else {
          echo "<h1>Nenhuma apresentação foi encontrada</h1>";
        }
      }
    ?>

    <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
    <script src="js/bootstrap.min.js"></script>
	  <!-- Para colocar a navbar restrita -->
    <div w3-include-html="css/rodape.html"></div> 
    <!-- Para colocar a navbar restrita -->
    <script>w3.includeHTML();</script>

  </body>
</html>