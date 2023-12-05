// JavaScript Document
//buscador de estado, municipio y parroquia
//creando objeto XMLHttpRequest de Ajax
var obXHR;
	try{
		obXHR=new XMLHttpRequest()
	}catch(err){
		try{
			obXHR=new ActiveXObject("Msxml2.XMLHTTP");
		}catch(err){
			try{
				obXHR=new ActiveObject("Microsoft.XMLHTTP");
			}catch(err){
				obXHR=false;
			}
		}
	}

function cargar(url, obId) {
	var obCon = document.getElementById(obId);
	obXHR.open("GET", url);
	obXHR.onreadystatechange = function() {
		if(obXHR.readyState == 4 && obXHR.status == 200) {
			obXML = obXHR.responseXML;
			obDes = obXML.getElementsByTagName("descri");
			obCon.length=obDes.length;
			for(var i=0; i<obdes .length; i++){
				obCon.options[i].value=obDes[i].firstChild.nodeValue;
				obCon.options[i].text=obDes[i].firstChild.nodeValue;
			}
		}
	}
	obXHR.send(null);
}