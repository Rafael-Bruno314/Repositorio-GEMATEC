<!DOCTYPE html>
<html lang="pt-br">
  <head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Convites & Resumos de Encontros Semanais do GEMATEC</title>
		
		<meta name="description" content="Encontre os resumos das palestras realizadas durante os encontros semanais pela data em que foram ministradas sobre estudos em analogias, metáforas e modelos produzidos pelo Grupo de Estudos em Metáforas e Analogias na Tecnologia, na Educação e na Ciência (GEMATEC) do Centro Federal de Educação Tecnológica de Minas Gerais (CEFET-MG).">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/estilo.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
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
		b.destaque_ano {
			font-size: 25px;
			color: #421E65;
		}

		b.destaque_mes {
			font-size: 25px;
			color: #E6447D;
			padding-left:3%;
		}
		
		b.destaque_dia {
			font-size: 25px;
			color: #D40B40;
			padding-left:6%;
		}

		footer.rodape {
			width: 100%;
			bottom: 0;
			left: 0;
			position: absolute;
			border-radius: 5px;
			background-color: #f5f5f5;
		}	
	</style>
  
	<?php 
		header( 'Content-Type: text/html; charset=utf-8' );
		include('class/conectar_banco.php');
		$query = mysql_query("SELECT * FROM convites");
		error_reporting(0);
  	ini_set(“display_errors”, 0);
	?>
  
	<body>
  	<div w3-include-html="css/navbar_publica.html"></div> 	
		<script>w3.includeHTML();</script>
	
		<div class="container">
			<h1>Convites & Resumos de Encontros Semanais do GEMATEC</h1>
			<hr>

			<?php $ano = mysql_query("SELECT DISTINCT ano FROM convites ORDER BY ano DESC;"); ?>
	
			<div class="panel panel-primary">
			<div class="panel-body">
	
				<details>

					<?php while($ano_array = mysql_fetch_array($ano)){ ?>
						<summary><?php echo "<b class='destaque_ano'>". $ano_array['ano']."</b>";?></summary>
						<?php
							$ordena_mes = "SELECT DISTINCT mes FROM convites WHERE `ano` =".$ano_array[0]." ORDER BY mes ASC";
							$mes_select = mysql_query($ordena_mes);
						?> 
						<?php while($mes_array = mysql_fetch_array($mes_select)){ ?>
							<?php if($mes_array['mes'] == 1){$mes = "Janeiro";}if($mes_array['mes'] == 2){$mes = "Fevereiro";}if($mes_array['mes'] == 3){$mes = "Março";}if($mes_array['mes'] == 4){$mes = "Abril";}if($mes_array['mes'] == 5){$mes = "Maio";}if($mes_array['mes'] == 6){$mes = "Junho";}if($mes_array['mes'] == 7){$mes = "Julho";}if($mes_array['mes'] == 8){$mes = "Agosto";}if($mes_array['mes'] == 9){$mes = "Setembro";}if($mes_array['mes'] == 10){$mes = "Outubro";}if($mes_array['mes'] == 11){$mes = "Novembro";}if($mes_array['mes'] == 12){$mes = "Dezembro";}?>

							<details>
								<summary><?php echo "<b class='destaque_mes'>". $mes."</b>";?></summary>
								<?php $dia_select = mysql_query("SELECT DISTINCT dia FROM convites WHERE `ano` =".$ano_array[0]."&& `mes` =".$mes_array[0]); ?>
								<?php $conv = mysql_query("SELECT convite FROM convites WHERE `ano` =".$ano_array[0]."&& `mes` =".$mes_array[0]); ?>
								<?php $tit = mysql_query("SELECT titulo FROM convites WHERE `ano` =".$ano_array[0]."&& `mes` =".$mes_array[0]); ?>

									<?php while($dia_array = mysql_fetch_array($dia_select)){ ?>
										<?php $convite = mysql_fetch_object($conv); ?>
										<?php $titulo = mysql_fetch_object($tit) ?>
										
									<?php if($convite->convite == ""){
										echo	"<b class='destaque_dia'>". $dia_array['dia']." de ".$mes." - ".$titulo->titulo.  "<br></b>";
									}else{
										echo	"<a href='Convites/".$convite->convite." 'target='_blank'' ><b class='destaque_dia'>". $dia_array['dia']." de ".$mes." - ".$titulo->titulo.  "<br></a></b>";
									}									?>
										

									<?php } ?>
							</details>
						<?php } ?>
				</details>
				<br><br>

				<details>
					<?php } ?>
					<summary></summary>
				</details>
			</div>
			</div>
			<br><br>

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