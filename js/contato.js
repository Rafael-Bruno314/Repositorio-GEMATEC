function alerta(valor){
	if(valor == ""){
		document.getElementById("mostrar").style.display = "block";
	}
}

function Confirma() {
	
	var nome = document.getElementById("nome").value;
	var email = document.getElementById("email").value;
	var mensagem = document.getElementById("mensagem").value;
	
	if(nome != "" && email != "" && mensagem != ""){
		var r = confirm("Deseja confirmar esta ação?");
		if (r == true) {
			document.getElementById('theForm').onsubmit = enviaDados('php/enviar_contato.php');
			document.getElementById('theForm').reset();
		}
	}else{
		alert ("As informações não foram preenchidas");
	}
}

function trataDados(){
	var info = ajax.responseText;  // obter a resposta como string
	alert(info);
}