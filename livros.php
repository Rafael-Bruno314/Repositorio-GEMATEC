<!DOCTYPE html>
<html lang="pt-br">
  <head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- As 3 meta tags acima *devem* vir em primeiro lugar dentro do `head`; qualquer outro conteúdo deve vir *após* essas tags -->
    <title>Sumários de Livros</title>

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
	
	<script src="js/w3.js"></script>
	
	<link rel="icon" href="favicon.ico">
	
	<script type="text/javascript" src="js/code_jquery.js"></script>
	<!-- Para colocar a navbar restrita -->	<script src="js/w3.js"></script>
	<noscript>Desculpe, mas seu navegador não suporta <b>JavaScript</b>, ou ele pode estar desabilitado! Sua experiência com esse sistema ficará seriamente afetada!</noscript>
	
</head>

<?php 	

	include('class/conectando.php');
	include('ano_config.php');
	
	$query = mysql_query("SELECT * FROM genero");
?>
  
<body>
	<!-- Para colocar a navbar restrita -->	<div w3-include-html="css/navbar_publica.html"></div> 	<!-- Para colocar a navbar restrita -->	<script>w3.includeHTML();</script>
	
<div class="container">

	<h1>Sumários de Livros</h1><hr>

	<form class="form-inline" name="frmBusca" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?a=buscar">
	
  <div class="form-group">
    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título">
  </div>
  
  <div class="form-group">
    <input type="text" class="form-control" id="autor" name="autor" placeholder="Autor(es)">
  </div>
  
  <div class="form-group">
    <input type="text" class="form-control" id="editora" name="editora" placeholder="Editora">
  </div>
  
  <div class="form-group">
	 <select class="form-control" id="ano" name="ano">
		<option value = "ano">Ano de Publicação</option>
		 <?php for($data_ano = date("Y");$data_ano>=1980;$data_ano--) { ?>
		<option value="<?php echo $ano_array2[$data_ano]; ?>"><?php echo $ano_array2[$data_ano]; ?></option>
		 <?php } ?>
	</select>
  </div>
  
	<div class="form-group">
	  <select class="form-control" id="genero" name="genero">
		<option value = "genero">Gênero</option>
		 <?php while($prod = mysql_fetch_array($query)) { ?>
		<option value="<?php echo ($prod['genero']) ?>"><?php echo ($prod['genero']) ?></option>
		<?php } ?>
	  </select>
	</div>
  
  <button type="submit" class="btn btn-primary" value="Buscar">Procurar</button>
  
</form>

<br><br>
<hr>
	
<?php

error_reporting(0);
ini_set(“display_errors”, 0);

?>
	
<?php

include('class/conectando.php');

// Recuperamos a ação enviada pelo formulário

$a = $_GET['a'];

// Verificamos se a ação é de busca



if ($a == "buscar") {
    
    // Pegamos o titulo
    $titulo  = (trim($_POST['titulo']));
    $autor   = (trim($_POST['autor']));
    $editora = (trim($_POST['editora']));
    $ano     = trim($_POST['ano']);
    $genero  = (trim($_POST['genero']));
    
        
        if ($genero == "genero" || $ano == "ano") {
            if ($genero == "genero") {
                $sql = mysql_query("SELECT * FROM livros WHERE titulo LIKE '%" . $titulo . "%' AND ano LIKE '%" . $ano . "%' AND autor LIKE '%" . $autor . "%' AND editora LIKE '%" . $editora . "%' ORDER BY titulo"); //Busca Multipla, yeah!!!!
            }
            if ($ano == "ano") {
                $sql = mysql_query("SELECT * FROM livros WHERE titulo LIKE '%" . $titulo . "%' AND autor LIKE '%" . $autor . "%' AND editora LIKE '%" . $editora . "%' AND genero LIKE '%" . $genero . "%' ORDER BY titulo"); //Busca Multipla, yeah!!!!
            }
            if ($genero == "genero" && $ano == "ano") {
                $sql = mysql_query("SELECT * FROM livros WHERE titulo LIKE '%" . $titulo . "%' AND autor LIKE '%" . $autor . "%' AND editora LIKE '%" . $editora . "%' ORDER BY titulo"); //Busca Multipla, yeah!!!!
            }
        } else {
            $sql = mysql_query("SELECT * FROM livros WHERE titulo LIKE '%" . $titulo . "%' AND ano LIKE '%" . $ano . "%' AND autor LIKE '%" . $autor . "%' AND editora LIKE '%" . $editora . "%' AND genero LIKE '%" . $genero . "%' ORDER BY titulo"); //Busca Multipla, yeah!!!!
        }
        
        // Descobrimos o total de registros encontrados
        $numRegistros = mysql_num_rows($sql);
        
        // Se houver pelo menos um registro, exibe-o
        if ($numRegistros != 0) {
            
			echo "<div class='row'>";
            while ($livros = mysql_fetch_object($sql)) {
                
					echo "<div class='col-sm-6 col-md-4'>";
						echo "<div class='thumbnail'>";
							echo "<a href='Capas/" . $livros->capa . " 'target='_blank'' ><img src='Capas/" . $livros->capa . "' alt='Foto de exibição' /></a>";
							echo "<div class='caption'>";
								echo "<strong><p class='destaque'>" . ($livros->titulo) . "</p></strong>" . "<b class='titulo'>Gênero: </b><span>" . ($livros->genero) . "</span></br>" . "<b class='titulo'>Autor: </b><span>" . ($livros->autor) . "</span></br>" . "<b class='titulo'>Editora: </b><span>" . ($livros->editora) . "</span></br>" . "<b class='titulo'>Ano de publicação: </b><span>" . $livros->ano . "</span><br><br>";
							echo "</div>";
						echo "</div>";
					echo "</div>";
            }
            echo "</div>";	
            
            // Se não houver registros
        }else {
            echo "<h1> Nenhum livro foi encontrado </h1>";
        }
        /*} */
}

?>

<!--</td></tr>
</table>-->
</div>
	<!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
<html>
<body>
	<!-- Para colocar a navbar restrita -->
	<div w3-include-html="css/rodape.html"></div> 
	<!-- Para colocar a navbar restrita -->
	<script>w3.includeHTML();</script>
</body>
</html>