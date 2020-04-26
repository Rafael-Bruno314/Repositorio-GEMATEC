<!DOCTYPE html>
<html lang="pt-br">
  <head>
	  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Artigos, Trabalhos & Resumos GEMATEC</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
	  <link href="css/estilo.css" rel="stylesheet">
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
	  <link rel="icon" href="favicon.ico">

    <script src="js/ie-emulation-modes-warning.js"></script>
	  <script src="js/w3.js"></script>
	  <script type="text/javascript" src="js/code_jquery.js"></script>

	  <noscript>Desculpe, mas seu navegador não suporta <b>JavaScript</b>, ou ele pode estar desabilitado! Sua experiência com esse sistema ficará seriamente afetada!</noscript>
  </head>

  <style>
    .alinhado_vertical {
      vertical-align: top;
      background: white;
    }
    a.titulo {
      text-decoration: none;
      color: orange;
    }
    a:hover.titulo {
      font-size: 33px;
      text-decoration: none;
      color: #d08600;
    }
  </style>
  
  <?php 	
    include('class/conectar_banco.php');
    $query = mysql_query("SELECT * FROM tipo");

    error_reporting(0);
    ini_set(“display_errors”, 0);

  ?>

  <?php
    include('ano_config.php');
  ?>
  
  <body>
    <div w3-include-html="css/navbar_publica.html"></div>
    <script>w3.includeHTML();</script>

    <div class="container">
	    <h1>Artigos, Trabalhos & Resumos GEMATEC</h1>
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
            <option>Ano de Publicação</option>
              <?php for($data_ano = date("Y");$data_ano>=1980;$data_ano--) { ?>
            <option value="<?php echo $ano_array2[$data_ano]; ?>"><?php echo $ano_array2[$data_ano]; ?></option>
              <?php } ?>
          </select>
        </div>
  
        <div class="form-group">
          <select class="form-control" id="tipo" name="tipo">
            <option>Todos os tipos</option>
              <?php while($prod = mysql_fetch_array($query)) { ?>
            <option value="<?php echo utf8_encode($prod['tipo']) ?>"><?php echo utf8_encode($prod['tipo']) ?></option>
              <?php } ?>
          </select>
        </div>
  
        <button type="submit" class="btn btn-primary" value="Buscar">Buscar</button> 
      </form>
	    <hr>

      <?php
        error_reporting(0);
        ini_set(“display_errors”, 0);
      ?>

      <?php
        // Recuperamos a ação enviada pelo formulário
        $a = $_GET['a'];

        // Verificamos se a ação é de busca
        if ($a == "buscar") {
          $titulo = utf8_decode(trim($_POST['titulo']));
          $autor = utf8_decode(trim($_POST['autor']));
          $palavras_chave = utf8_decode(trim($_POST['palavras_chave']));
          $ano = trim($_POST['ano']);
          $tipo = utf8_decode(trim($_POST['tipo']));
        
          if ($tipo == "Todos os tipos" || $ano == "Ano de Publicação") {

            if ($tipo == "Todos os tipos") {
              $sql = mysql_query("SELECT * FROM arquivos WHERE titulo LIKE '%" . $titulo . "%' AND ano LIKE '%" . $ano . "%' AND autor LIKE '%" . $autor . "%' AND palavras_chave LIKE '%" . $palavras_chave . "%' ORDER BY titulo");
            }

            if ($ano == "Ano de Publicação") {
              $sql = mysql_query("SELECT * FROM arquivos WHERE titulo LIKE '%" . $titulo . "%' AND autor LIKE '%" . $autor . "%' AND palavras_chave LIKE '%" . $palavras_chave . "%' AND tipo LIKE '%" . $tipo . "%' ORDER BY titulo");
            }

            if ($tipo == "Todos os tipos" && $ano == "Ano de Publicação") {
              $sql = mysql_query("SELECT * FROM arquivos WHERE titulo LIKE '%" . $titulo . "%' AND autor LIKE '%" . $autor . "%' AND palavras_chave LIKE '%" . $palavras_chave . "%' ORDER BY titulo");
            }
          }
          else {
            $sql = mysql_query("SELECT * FROM arquivos WHERE titulo LIKE '%" . $titulo . "%' AND autor LIKE '%" . $autor . "%' AND ano LIKE '%" . $ano . "%' AND palavras_chave LIKE '%" . $palavras_chave . "%' AND tipo LIKE '%" . $tipo . "%' ORDER BY titulo");
          }
          
          // Descobrimos o total de registros encontrados
          $numRegistros = mysql_num_rows($sql);
          // Se houver pelo menos um registro, exibe-o
          if ($numRegistros != 0) {
            while ($arquivos = mysql_fetch_object($sql)) {
              echo "<div class='col-sm-6 col-md-12'>";
              echo "<div class='thumbnail'>";
              echo "<div class='caption'>";
              echo "<strong><p class='destaque'> <a href='Arquivos/" . $arquivos->arquivo . " 'target='_blank'' class='titulo'>" . utf8_encode($arquivos->titulo) . "</p></strong></a><hr class='space' width='50%'>" . "<b class='titulo'>Tipo de texto: </b><span>" . utf8_encode($arquivos->tipo) . "</span></br>" . "<b class='titulo'>Autor: </b><span>" . utf8_encode($arquivos->autor) . "</span></br>" . "<b class='titulo'>Palavras-chave: </b><span>" . utf8_encode($arquivos->palavras_chave) . "</span></br>" . "<b class='titulo'>Ano de publicação: </b><span>" . $arquivos->ano . "</span><br><br>";
              echo "<p><a href='Arquivos/" . $arquivos->arquivo . "' target='_blank'' class='btn btn-primary' role='button'>Abrir</a> <a href='Arquivos/" . $arquivos->arquivo . "' download=" . utf8_encode($arquivos->titulo) . " class='btn btn-default' role='button'>Download</a></p>";
              echo "</div>";
              echo "</div>";
              echo "</div>";
            }
          }
          else {
            echo "<h1> Nenhum arquivo foi encontrado </h1>";
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
    </div>
  </body>
</html>