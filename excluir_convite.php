<?php 
	#include("class/protect.php"); 
?>

<?php
	include('class/conectar_banco.php');
?>

<?php
	error_reporting(0);
	ini_set(“display_errors”, 0);
?>

<?php
	$query = mysql_query("SELECT * FROM convites");
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    
    <title>Excluir convites GEMATEC</title>

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
		<script type="text/javascript" src="js/alterar_apresentacao.js"></script>
		<script type="text/javascript" src="js/code_jquery.js"></script>
	
		<noscript>Desculpe, mas seu navegador não suporta <b>JavaScript</b>, ou ele pode estar desabilitado! Sua experiência com esse sistema ficará seriamente afetada!</noscript>
	</head>

	<style>		
		b.destaque_ano {
			font-size: 25px;
			color: #652E79;
		}

		b.destaque_mes {
			font-size: 25px;
			color: #E6447D;
			padding-left:3%;
		}
		
		b.destaque_dia {
			font-size: 25px;
			color: #586DF4;
			padding-left:6%;
		}
	</style>
	
	<body>
		<!-- Para colocar a navbar restrita -->
		<div w3-include-html="css/navbar_restrita.html"></div> 
		<!-- Para colocar a navbar restrita -->
		<script>w3.includeHTML();</script>
	
		<div class="container">
			<h1>Excluir Convites</h1>
			<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="delete_and_update" >
				<div class="panel panel-primary">
				<div class="panel-body">

					<table width = "50%" border = "0" frame="none">
		  			<div class="form-group">
		 					<tr>
								<td align=left>
									<label><h4>Código do convite que será excluido:</h4></label>
								</td>
								<td>
									<select class="form-control" id="id" name="id">
										<option>Selecione</option>
				 						<?php while($prod = mysql_fetch_array($query)) { ?>
											<option value="<?php echo $prod['id'] ?>"><?php echo $prod['id'] ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
						</div>
					</table>
					<hr>

		  		<table width = "95%" border = "0" frame="">
		  			<tr>
							<td align=center>
		   					<br>
								<button type="submit" name="excluir" id="excluir" onclick="Confirma_excluir_convite()" class="btn btn-primary btn-lg">Excluir</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								<input type="reset"  class="btn btn-warning btn-lg" name="apagar" id="apagar" value="Apagar Campos">
							</td>
						</tr>
					</table>
				</div>	
				</div>	
			</form>
			<hr>
	
			<?php $ano = mysql_query("SELECT DISTINCT ano FROM convites ORDER BY ano DESC;"); ?>
			<div class="panel panel-primary">
			<div class="panel-body">
	
				<details> <!--Como eu consegui fazer isso?!!!-->

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
									<?php $conv = mysql_query("SELECT * FROM convites WHERE `ano` =".$ano_array[0]."&& `mes` =".$mes_array[0]); ?>

									<?php while($dia_array = mysql_fetch_array($dia_select)){ ?>
										<?php $convite = mysql_fetch_object($conv); ?>
										<?php echo	"<a href='Convites/".$convite->convite." 'target='_blank'' ><b class='destaque_dia'> Código ".$convite->id.": ". $dia_array['dia']." de ".$mes."<br></a></b>";?>
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
		</div>
		<br><br>
	
		<?php
			if (isset($_POST['exc_dps_da_ganbiarra'])) {
    		// Comando pra excluir!
    		$codigo = $_POST['id'];
    
				if ($codigo == "Selecione") {
					echo "<script>alert('Escolha um código válido')</script>";
				} 
				else {
        	$mostrar = mysql_query("SELECT * FROM `convites` WHERE id = '$codigo'");
        	#echo mysql_num_fields($mostrar);
        
        	while ($row = mysql_fetch_object($mostrar)) {
            $id =	 $row->id;
            $dia = $row->dia;
            $mes = $row->mes;
            $ano = $row->ano;
            $convite = $row->convite;
					}
					
        	$excluir = "DELETE FROM `convites` WHERE id = '$codigo'"; //Linha problema!!!
        
					if($convite != "nao_encontrado.pdf") {
						$diretorio = "Convites/";
						$convite_apagado = $diretorio . $convite;
						unlink($convite_apagado);
					}
        
					if (!$excluir) {
							echo "<script>alert('Não deu')</script>";
					} else {
							echo "<script>alert('Excluido com sucesso')</script>";
					}
        
        	mysql_query($excluir, $conn) or die("<font style=Arial color=red><h1>Houve um erro na exclusão dos dados</h1></font>");
        
        	echo '<meta HTTP-EQUIV="Refresh" CONTENT="0">';
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
			<script src="js/ie10-viewport-bug-workaround.js"></script>
	</body>
</html>