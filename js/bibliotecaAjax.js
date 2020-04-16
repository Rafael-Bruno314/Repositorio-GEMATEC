var ajax;
var dadosUsuario;

// ------- cria o objeto e faz a requisi��o -------
function requisicaoHTTP(tipo,url,assinc){
	if(window.XMLHttpRequest){	  // Mozilla, Safari,...
		ajax = new XMLHttpRequest();
	} 
	else if (window.ActiveXObject){	// IE
		ajax = new ActiveXObject("Msxml2.XMLHTTP");
		if (!ajax) {
			ajax = new ActiveXObject("Microsoft.XMLHTTP");
		}
    }      
    
	if(ajax)	// iniciou com sucesso
		iniciaRequisicao(tipo,url,assinc);
	else
		alert("Seu navegador n�o possui suporte a essa aplica��o!");
}

// ------- Inicializa o objeto criado e envia os dados (se existirem) -------
function iniciaRequisicao(tipo,url,bool){
	ajax.onreadystatechange=trataResposta;
	ajax.open(tipo,url,bool);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
	//ajax.overrideMimeType("text/XML");   /* usado somente no Mozilla */
	ajax.send(dadosUsuario);
}


// ------- Inicia requisi��o com envio de dados -------
function enviaDados(url){
	criaQueryString();
	requisicaoHTTP("POST",url,true);
}


// ------- Cria a string a ser enviada, formato campo1=valor1&campo2=valor2... -------
function criaQueryString(){
	dadosUsuario="";
	var frm = document.forms[0];
	var numElementos =  frm.elements.length;
	for(var i = 0; i < numElementos; i++)  {
		if(i < numElementos-1)  {
			dadosUsuario += frm.elements[i].name+"="+encodeURIComponent(frm.elements[i].value)+"&";
		} else {
			dadosUsuario += frm.elements[i].name+"="+encodeURIComponent(frm.elements[i].value);
		}
	}
}

// ------- Trata a resposta do servidor -------
function trataResposta(){
	if(ajax.readyState == 4){
		if(ajax.status == 200){
			trataDados();  // criar essa fun��o no seu programa
		} else {
			alert("Problema na comunica��o com o objeto XMLHttpRequest.");
		}
	}
}
