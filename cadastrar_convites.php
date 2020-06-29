<?php
	#include("class/protect.php"); 
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
	// Se o usuário clicou no botão cadastrar efetua as ações
	if (isset($_POST['cad_dps_da_ganbiarra'])) {
    // Recupera os dados dos campos
    $dia = $_POST['dia'];
    $nome_mes = ($_POST['nome_mes']);
    $ano = $_POST['ano'];
    $convite = $_FILES["convite"];
    
		if($dia == "" || $nome_mes == "" || $ano == ""){
			echo "<script> alert('É preciso informar o dia, mes e ano para efetuar o cadastro');</script>";
		}
		else{
      if(!empty($_FILES['convite']['name'])){
				//convite
				// Pega extensão da imagem
				preg_match("/\.(pdf|docx|doc){1}$/i", $convite["name"], $ext);
				
				// Gera um nome único para a imagem
				$nome_convite = md5(uniqid(time())) . "." . $ext[1];
				
				// Caminho de onde ficará a imagem
				$caminho_convite = "Convites/" . $nome_convite;
				
				// Faz o upload da imagem para seu respectivo caminho
				move_uploaded_file($convite["tmp_name"], $caminho_convite);
				//fim convite
					}else{
				$nome_convite = "nao_encontrado.pdf";
			}

			$sql = "INSERT INTO convites(dia,mes,ano,convite) VALUES ('$dia','$nome_mes','$ano','$nome_convite')"; //Linha problema!!!
			mysql_query($sql, $conn) or die("<font style=Arial color=red><h1>Houve um erro na gravação dos dados</h1></font>");
			
			if (!$sql) {
				echo "<script>alert('Não deu...')</script>";
			} 
			else {
				echo "<script>alert('Cadastrado com sucesso')</script>";
      }
		}
	}
?>

<?php
	for ($data_dia = 1; $data_dia <= 31; $data_dia++) {
		$dia_array2[$data_dia] = $data_dia;
	}

	for ($data_mes = 1; $data_mes <= 12; $data_mes++) {
		$mes_array2[$data_mes] = $data_mes;
	}

	for ($data_ano = date("Y"); $data_ano >= 1980; $data_ano--) {
		$ano_array2[$data_ano] = $data_ano;
	}
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    
    <title>Cadastrar convites GEMATEC</title>

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
		<script>
			$(function () {
				$('[data-toggle="popover"]').popover()
			})
		</script>
	
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
			<h1>Cadastrar Convites</h1>
			<form class="form-inline" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="cadastro" >
				<div class="panel panel-primary">
				<div class="panel-body">

		 			<div class="form-group">
						<label><h4>Dia</h4></label>
						<select class="form-control" id="dia" name="dia">
							<option value="">Dia</option>
								<?php for($data_dia = 1;$data_dia<=31;$data_dia++) { ?>
							<option value="<?php echo $dia_array2[$data_dia]; ?>"><?php echo $dia_array2[$data_dia]; ?></option>
								<?php } ?>
						</select>
		  		</div>
		  
		  		<div class="form-group">
						<label><h4>/Mês</h4></label>
						<select class="form-control" id="nome_mes" name="nome_mes">
							<option value="">Mês</option>
								<?php for($data_mes = 1;$data_mes<=12;$data_mes++) { ?>
								<?php if($data_mes == 1){$nome_mes = "Janeiro";}if($data_mes == 2){$nome_mes = "Fevereiro";}if($data_mes == 3){$nome_mes = "Março";}if($data_mes == 4){$nome_mes = "Abril";}if($data_mes == 5){$nome_mes = "Maio";}if($data_mes == 6){$nome_mes = "Junho";}if($data_mes == 7){$nome_mes = "Julho";}if($data_mes == 8){$nome_mes = "Agosto";}if($data_mes == 9){$nome_mes = "Setembro";}if($data_mes == 10){$nome_mes = "Outubro";}if($data_mes == 11){$nome_mes = "Novembro";}if($data_mes == 12){$nome_mes = "Dezembro";} ?>
							<option value="<?php echo $mes_array2[$data_mes]; ?>"><?php echo $nome_mes; ?></option>
								<?php } ?>
						</select>
		  		</div>
		  
		  		<div class="form-group">
						<label><h4>/Ano</h4></label>
						<select class="form-control" id="ano" name="ano">
							<option value="">Ano</option>
								<?php for($data_ano = date("Y");$data_ano>=1980;$data_ano--) { ?>
							<option value="<?php echo $ano_array2[$data_ano]; ?>"><?php echo $ano_array2[$data_ano]; ?></option>
								<?php } ?>
						</select>
		  		</div>
		  		<br><br>
		  
		  		<div class="form-group">
						<label><h4>Documento do Convite
						<a tabindex="0" class="btn btn-primary btn-xs" role="button" data-toggle="popover" data-trigger="focus" title="Ajuda" data-content="Adicione o arquivo correspondente ao documento do convite (.pdf, .docx, .doc)">?</a> <!-- Criar o popup de ajuda -->
						</h4></label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<input type="file" name="convite" class="form-control" id="convite">
		  		</div>
		  		<hr>
		  
		  		<table width = "60%" border = "0" frame="none">
						<tr>
							<td align=center>
								<button type="submit" name="cadastrar" id="cadastrar" onClick="Confirma_cadastro_convite()" class="btn btn-primary btn-lg"> Cadastrar</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								<input type="reset"  class="btn btn-warning btn-lg" name="apagar" id="apagar" value="Apagar Campos">
							</td>
						</tr>
		  		</table>
				</div>
				</div>
			</form>	
			<hr/>

			<h1>Convites Cadastrados no Banco de Dados</h1>

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
							<?php if($mes_array['mes'] == 1){$mes = "Janeiro";}if($mes_array['mes'] == 2){$mes = "Fevereiro";}if($mes_array['mes'] == 3){($mes = "Março");}if($mes_array['mes'] == 4){$mes = "Abril";}if($mes_array['mes'] == 5){$mes = "Maio";}if($mes_array['mes'] == 6){$mes = "Junho";}if($mes_array['mes'] == 7){$mes = "Julho";}if($mes_array['mes'] == 8){$mes = "Agosto";}if($mes_array['mes'] == 9){$mes = "Setembro";}if($mes_array['mes'] == 10){$mes = "Outubro";}if($mes_array['mes'] == 11){$mes = "Novembro";}if($mes_array['mes'] == 12){$mes = "Dezembro";}?>

							<details>
								<summary><?php echo "<b class='destaque_mes'>". $mes."</b>";?></summary>
								<?php $dia_select = mysql_query("SELECT DISTINCT dia FROM convites WHERE `ano` =".$ano_array[0]."&& `mes` =".$mes_array[0]); ?>
								<?php $conv = mysql_query("SELECT convite FROM convites WHERE `ano` =".$ano_array[0]."&& `mes` =".$mes_array[0]); ?>

								<?php while($dia_array = mysql_fetch_array($dia_select)){ ?>
									<?php $convite = mysql_fetch_object($conv); ?>
									<?php echo	"<a href='Convites/".$convite->convite." 'target='_blank'' ><b class='destaque_dia'>". $dia_array['dia']." de ".$mes."<br></a></b>";?>
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