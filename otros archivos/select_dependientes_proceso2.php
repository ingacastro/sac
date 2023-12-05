<?php
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"paises"=>"contingente",
"estados"=>"funcionario"
);

function validaSelect($selectDestino)
{
	// Se valida que el select enviado via GET exista
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) return true;
	else return false;
}

function validaOpcion($opcionSeleccionada)
{
	// Se valida que la opcion seleccionada por el usuario en el select tenga un valor numerico
	if(is_numeric($opcionSeleccionada)) return true;
	else return false;
}

$selectDestino=$_GET["select"]; $opcionSeleccionada=$_GET["opcion"];

if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada))
{
	$tabla=$listadoSelects[$selectDestino];
	include 'conexion.php';
	conectar();
	$consulta=mysql_query("SELECT id, opcion, celular FROM $tabla WHERE relacion='$opcionSeleccionada'") or die(mysql_error());
	$consulta2=mysql_query("SELECT id, opcion, celular FROM $tabla WHERE relacion='$opcionSeleccionada'") or die(mysql_error());
	$consulta3=mysql_query("SELECT id, opcion, celular FROM $tabla WHERE relacion='$opcionSeleccionada'") or die(mysql_error());
	desconectar();
	
	// Comienzo a imprimir el select
	echo "<td><select name='estados2' id='estados2' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Elige</option>";
	while($registro2=mysql_fetch_row($consulta2))
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		$registro2[1]=htmlentities($registro2[1]);
		// Imprimo las opciones del select
		echo "<option value='".$registro2[0]."'>".$registro2[1]." ".$registro2[2]."</option>";
	}			
	echo "</select></td>";
	echo "<td><select name='estados3' id='estados2' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Elige</option>";
	while($registro3=mysql_fetch_row($consulta3))
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		$registro3[1]=htmlentities($registro3[1]);
		// Imprimo las opciones del select
		echo "<option value='".$registro3[0]."'>".$registro3[1]." ".$registro3[2]."</option>";
	}			
	echo "</select></td>";

}
?>