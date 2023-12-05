<?php
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"paises"=>"contingente",
"estados"=>"funcionario"
);

function validaSelect($selectDestino){
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) return true;
	else return false;
}

function validaOpcion($opcionSeleccionada){
    if(is_numeric($opcionSeleccionada)) return true;
    else return false;
}

$selectDestino=$_GET["select"]; $opcionSeleccionada=$_GET["opcion"];

if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada)){
	$tabla=$listadoSelects[$selectDestino];
	include '../../modelo/config.php';
	$db=conectar();
        $q1="SELECT id, opcion, celular FROM $tabla WHERE relacion='$opcionSeleccionada'";
        $q2="SELECT id, opcion, celular FROM $tabla WHERE relacion='$opcionSeleccionada'";
        $q3="SELECT id, opcion, celular FROM $tabla WHERE relacion='$opcionSeleccionada'";
        $consulta=$db->query($q1);
        $consulta2=$db->query($q2);
        $consulta3=$db->query($q3);
	
	echo "<td><select class='form-control' name='".$selectDestino."' id='".$selectDestino."' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Elige</option>";
        while($registro=$consulta->fetch(PDO::FETCH_BOTH)){
            $registro[1]= utf8_encode($registro[1]);
            echo "<option value='".$registro[0]."'>".$registro[1]." ".utf8_encode($registro[2])."</option>";
	}			
	echo "</select></td>";
	echo "<td><select class='form-control' name='estados2' id='".$selectDestino."' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Elige</option>";
        while($registro2=$consulta2->fetch(PDO::FETCH_BOTH)){
		$registro2[1]=utf8_encode($registro2[1]);
		echo "<option value='".$registro2[0]."'>".$registro2[1]." ".utf8_encode($registro2[2])."</option>";
	}			
	echo "</select></td>";
	echo "<td><select class='form-control' name='estados3' id='".$selectDestino."' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Elige</option>";
        while($registro3=$consulta3->fetch(PDO::FETCH_BOTH)){
		$registro3[1]=utf8_encode($registro3[1]);
		echo "<option value='".$registro3[0]."'>".$registro3[1]." ".utf8_encode($registro3[2]) ."</option>";
	}			
	echo "</select></td>";
}
?>