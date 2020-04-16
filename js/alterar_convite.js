function loadDoc(cFunction) {
  var xhttp;
  xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      cFunction(this);
    }
  };
  var manda = document.getElementById("id");
  var selecionado = manda.options[manda.selectedIndex].value;
  var url = "php/select_convite.php?manda="+encodeURIComponent(selecionado);
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

	document.getElementById("dia").value = res[0];
	
	document.getElementById("nome_mes").value = res[1];
	
	document.getElementById("ano").value = res[2];
}