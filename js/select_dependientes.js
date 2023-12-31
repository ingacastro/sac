function nuevoAjax(){ 
    /* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
    lo que se puede copiar tal como esta aqui */
    var xmlhttp=false;
    try{
        // Creacion del objeto AJAX para navegadores no IE
        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e){
        try{
            // Creacion del objet AJAX para IE
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(E){
            if (!xmlhttp && typeof XMLHttpRequest!='undefined') xmlhttp=new XMLHttpRequest();
        }
    }
    return xmlhttp; 
}

// Declaro los selects que componen el documento HTML. Su atributo ID debe figurar aqui.
var listadoSelects=new Array();
listadoSelects[0]="paises";
listadoSelects[1]="estados";


function buscarEnArray(array, dato){
	var x=0;
	while(array[x]){
            if(array[x]==dato) return x;
            x++;
	}
	return null;
}

function cargaContenido(idSelectOrigen){
    var posicionSelectDestino=buscarEnArray(listadoSelects, idSelectOrigen)+1;
    var selectOrigen=document.getElementById(idSelectOrigen);
    var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
    if(opcionSeleccionada==0){
        var x=posicionSelectDestino, selectActual=null;
        while(listadoSelects[x]){
            selectActual=document.getElementById(listadoSelects[x]);
            selectActual.length=0;
            var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Elija Funcionario...";
            selectActual.appendChild(nuevaOpcion);	selectActual.disabled=true;
            x++;
        }
    }else if(idSelectOrigen!=listadoSelects[listadoSelects.length-1]){
        var idSelectDestino=listadoSelects[posicionSelectDestino];
        var selectDestino=document.getElementById(idSelectDestino);
        var ajax=nuevoAjax();
        ajax.open("GET", "select_dependientes_proceso.php?select="+idSelectDestino+"&opcion="+opcionSeleccionada, true);
        ajax.onreadystatechange=function(){ 
            if (ajax.readyState==1){
                selectDestino.length=0;
                var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Cargando...";
                selectDestino.appendChild(nuevaOpcion); selectDestino.disabled=true;
                alert(ajax.onreadyState);
            }
                if (ajax.readyState==4){
                    selectDestino.parentNode.innerHTML=ajax.responseText;
                }
        }
        ajax.send(null);
    }
}

