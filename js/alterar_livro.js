function  Add_genero(){
	var cat = document.getElementById("genero").value;

	if (cat == "outro") {
		var novo = prompt("Adicione um novo:");
		if (novo == null || novo == "") {
			
		} else {
			Manda_categoria(novo);
		}
	}
}

function Manda_categoria(categoria){
	if(categoria){
		document.getElementById("trapaca_genero").value = categoria;
		var cat = document.getElementById("genero");
		var opt0 = document.createElement("option");
		opt0.value = categoria;
		opt0.text = categoria;
		cat.add(opt0, cat.options[0]);

		for (var i = 0; i < cat.options.length; i++) {
			if (cat.options[i].value == categoria) {
				cat.options[i].selected = "true";
				break;
			}
		}
	}
}

function Confirma() {
  var txt;
	var r = confirm("Deseja realmente alterar essas informações?");
	
  if (r == true) {
    document.getElementById("alterar").value = "alt_dps_da_ganbiarra"; //esse não importa muito!
    document.getElementById("alterar").name = "alt_dps_da_ganbiarra";
  }
}

function Confirma_excluir() {
  var txt;
  var r = confirm("Deseja realmente excluir essas informações?");

  if (r == true) {
    document.getElementById("excluir").value = "exc_dps_da_ganbiarra"; //esse não importa muito!
    document.getElementById("excluir").name = "exc_dps_da_ganbiarra";
  }
}

function Confirma_cadastro() {
  var txt;
	var title = document.getElementById("titulo").value;
  var r = confirm("Deseja realmente cadastrar essas informações?");

  if (r == true) {
		if(title == "" || title == " "){
			alert("O título não pode ficar vazio!");
		}
		else {
			document.getElementById("cadastrar").value = "cad_dps_da_ganbiarra"; //esse não importa muito!
			document.getElementById("cadastrar").name = "cad_dps_da_ganbiarra";
		}
  }
}

function loadDoc(cFunction) {
  var xhttp;
  xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      cFunction(this);
    }
  };

  var manda = document.getElementById("titulo_mudar");
  var selecionado = manda.options[manda.selectedIndex].value;
  var url = "php/select_livro.php?manda="+encodeURIComponent(selecionado);
  xhttp.open("GET",url, true);
  xhttp.send();
}

function myFunction(xhttp) {
	var resposta = xhttp.responseText; // obter a resposta como string
	Tratar_resposta(resposta);
}

function Tratar_resposta(resposta){ //
  var res = resposta.split("@");
	var mostra = "";
	var quant = res.length;

	for(var i=0;i<quant;i++){
		mostra += res[i] + "<br>";
	}

	document.getElementById("titulo").value = res[0];
	document.getElementById("genero").value = res[1];
	document.getElementById("autor").value = res[2];
	document.getElementById("editora").value = res[3];
	document.getElementById("ano").value = res[4];
}