// JavaScript Document
function Buscador_centro(){
    var xmlhttp = false;
    try {
        xmlhttp = new
        ActiveXobject("Msxml2.XMLHTTP");
    }catch (e){
        try{
            xmlhttp = new
            ActiveXObject("Microsoft.XMLHTTP");
        }catch (E){
            xmlhttp = false;
        }
    }

    if (!xmlhttp && typeof XMLHttpRequest!='undefined'){
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function Buscar(){
    var centro_votacion = document.getElementById('centro_de_votacion').value;
    var Resultados = document.getElementById('resultados');
    ajax = Buscador_centro();
    ajax.open("GET", "buscar_centro.php?q="+centro_votacion);
    ajax.onreadystatechange = function (){
        if(ajax.readyState == 4){
            Resultados.innerHTML = ajax.responseText;
        }
    }
    ajax.send(null)
}

function BuscarParroquia(){
    var centro_votacionP = document.getElementById('centro_de_votacionP').value;
    var estado = document.getElementById('estado').value;
    var municipio = document.getElementById('municipio').value;
    var parroquia2 = document.getElementById('parroquia').value;
    var parroquia = document.getElementsByName('select3').value;
    var Resultados = document.getElementById('resultados');
    ajax = Buscador_centro();
    ajax.open("GET", "buscar_centro_parroquia.php?r="+centro_votacionP+"&e="+estado+"&m="+municipio+"&p="+parroquia2);
    ajax.onreadystatechange = function (){
        if(ajax.readyState == 4){
            Resultados.innerHTML = ajax.responseText;	
        }
    }
    ajax.send(null)
}

function atras(){
    history.go(-1);
}

function reload(form){
    var val=form.cod_estado.options[form.cod_estado.options.selectedIndex].value;
    self.location='principal.php?cod_estado=' + val ;
}

function Blink(){
    var ElemsBlink = document.getElementsByTagName('blink');
    for(var i=0;i<ElemsBlink.length;i++)
    ElemsBlink[i].style.visibility = ElemsBlink[i].style.visibility=='visible' ?'hidden':'visible';
}

