function Excluir_tipo(id,tabela){
	var confirma = confirm("Deseja realmente excluir?");
	if(confirma){
		var url = 'php/excluir_outros_ok?id='+id+'&tabela='+tabela;
		Manda_dados(tabela);
		requisicaoHTTP("GET",url,true);
	}
}

function Excluir_genero(id,tabela){
	var confirma = confirm("Deseja realmente excluir?");
	if(confirma){
		var url = 'php/excluir_outros_ok?id='+id+'&tabela='+tabela;
		Manda_dados(tabela);
		requisicaoHTTP("GET",url,true);
	}
}

function Manda_dados(id){
	var identidade = document.getElementById(id).id;
	document.getElementById("recebe").value = identidade;
}

function trataDados(){
	var info = ajax.responseText;
	alert("Excluido com sucesso");
	var div = document.getElementById("saida");
	div.innerHTML=info;
}