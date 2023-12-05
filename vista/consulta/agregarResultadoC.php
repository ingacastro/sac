<?php
while ($row=$query->fetch(PDO::FETCH_BOTH)){
    $rowU=consTMNac($db, $row['codigo_centro']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Consulta de Contingencia del Coordinador</title></head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
    <link rel="stylesheet"  href="../../vista/bower_components/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../vista/bower_components/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../vista/bower_components/Ionicons/css/ionicons.min.css" />
    <link rel="stylesheet" href="../../vista/dist/css/AdminLTE.min.css" />
    <link rel="stylesheet" href="../../vista/dist/css/skins/_all-skins.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" />
    <script src="../js/buscador_ajax_centro.js" language="javascript" type="text/javascript"></script>
    <body class="skin-blue">
<table align="center" width="80%">
    <tr>
        <td colspan="3" align="center">
            <input type="button" value="Regresar" class="button" onclick="javascript:location.href='consContCoord.php?id_contingencia=<?php echo $_GET['id_contingencia'] ?>';" /></td>
    </tr>
    <tr>
        <td align="center"><dt>CONTINGENCIA N°</dt><dd><?php echo $_GET['id_contingencia']; ?></dd></td>
        <td align="center"><dt>ESTADO</dt><dd><?php echo $rowU['des_estado']; ?></dd></td>
        <td align="center"><dt>MUNICIPIO</dt><dd><?php echo $rowU['des_municipio']; ?></dd></td>
        <td align="center"><dt>PARROQUIA</dt><dd><?php echo $rowU['des_parroquia']; ?></dd></td>
    </tr>
</table>
<table>
    <tr>
        <td align="center"><dt>CÓDIGO DEL CENTRO</dt><dd><?php echo $row['codigo_centro']; ?></dd></td>
<?php
    $rowCV= consCentro($link, $row['codigo_centro']);
?>
        <td align="center"><dt>CENTRO DE VOTACIÓN</dt><dd><?php echo utf8_encode($rowCV['nombre']); ?></dd></td>
    </tr>
    <tr>
	<td colspan="2" align="center"><dt>DIRECCIÓN DEL CENTRO</dt><dd><?php echo utf8_encode($rowCV['direccion']); ?></dd></td>
    </tr>
    <tr>
        <td colspan="3" align="center"><h3 class="product-title">INFORMACIÓN DE LA CONTINGENCIA</h3></td>
    </tr>
    <tr>
        <td align="center"><dt>HORA DE LLAMADA</dt><dd><?php echo date("g:i a",strtotime("$row[hora_registro]")); ?></dd></td>
        <td align="center"><dt>HORA DE COORDINACIÓN</dt><dd><?php echo date("g:i a", strtotime($row['hora_coordinador']));?></dd></td>
    </tr>
    <tr>
        <td align="center"><dt>Nombre del solicitante-Cédula</dt><dd><?php echo utf8_encode($row['nombre_solicitante']."-".$row['cedula_solicitante']) ?></dd></td>
        <td align="center"><dt>Teléfono-Ocupación</dt><dd><?php echo utf8_encode($row['telefono_contacto'])."-".utf8_encode($row['ocupacion_solicitante']) ?></dd></td>
    </tr>
    <tr>
        <td colspan="3" align="center"><h3 class="box-header">CONTINGENCIA QUE REPORTA</h3></td>
    </tr>
    <tr>
        <td align="center">
<?php
$cat=cont_cat($_GET['id_contingencia']);
if($cat==""){
echo "otros".$cat;
}
$x=0;
for($i=0; $i<count($cat); $i++){
    $db=conectar();
    $c=$cat[$i]['cat'];
    $s=$cat[$i]['sub'];
    $qCat="select * from categoria where idcategoria=$c";
    $rsCat=$db->query($qCat);
    $rwCat=$rsCat->fetch(PDO::FETCH_BOTH);
    $qSub="select * from subcategoria where cat=$c and sub=$s";
    $rsSub=$db->query($qSub);
    $rwSub=$rsSub->fetch(PDO::FETCH_BOTH);
    if($c!=$x){
        echo utf8_encode($rwCat['descripcion_cat'])."<br>";
        $x=$c;
    }
    echo utf8_encode($rwSub['desub'])."<br/>";
}
?>
    </td>
    <td align="center">
<?php 
if ($row['descripcion_contingencia'] != ""){
    echo "<textarea name=descripcion cols=45 rows=8 class=textarea disabled=disabled >";
    echo utf8_encode($row['descripcion_contingencia']);
    echo "</textarea>";
}else{
    echo  "Sin definir";
}
?>	
    <form action="ingresarResultadoC.php?id_contingencia=<?php echo $_GET['id_contingencia']; ?>&id_resultado=<?php echo $_SESSION['idUsuarioL'] ?>" method="post" >
     <tr>
    	<td align="center">Resultado:</td>
        <td align="center"><textarea cols="65" rows="5" class="textarea" name="resultado"></textarea></td>
     </tr>
     <tr>
         <td align="center">
<?php 
    $hora_resultado=date('Y-m-d H:i:s');
    echo date("g:i a", strtotime($hora_resultado));
?>
        </td>
        <input type="hidden" name="hora_resultado" id="hora_asignacion" value="<?php echo $hora_resultado ?>" />
        <td align="center"><input type="submit" value="Ingresar Resultado" class="button" /></td>
    </tr>
    </form>
<?php
}
?>
        </td>
    </tr>
</table>
</body>
</html>

