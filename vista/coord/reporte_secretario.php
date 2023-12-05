<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<link rel="stylesheet" href="../css/estilos.css" />
<title>Reporte Secretario</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
    <link rel="stylesheet"  href="../../vista/bower_components/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../vista/bower_components/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../vista/bower_components/Ionicons/css/ionicons.min.css" />
    <link rel="stylesheet" href="../../vista/dist/css/AdminLTE.min.css" />
    <link rel="stylesheet" href="../../vista/dist/css/skins/_all-skins.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" />
</head>
    <body class="hold-transition skin-blue">
<?php
$img='../../vista/cne.jpg';
$img2='../../imagen/LOGO20MAYO.png';
include '../../plantilla/encabezado.php';
?>
    <table align="center" width="80%">
    <tr>
        <td align="center"><?php echo $rowU['des_estado'] ?></td>
        <td align="center"><?php echo $rowU['des_municipio'] ?></td>
        <td align="center"><?php echo $rowU['des_parroquia'] ?></td>
    </tr>
    <tr>
        <td align="center"><dt>Código del CV</dt><dd><?php echo $row['codigo_centro'] ?></dd></td>
        <td colspan="2" align="center"><dt>CENTRO DE VOTACIÓN</dt><dd><?php echo utf8_encode($rowCV['nombre']) ?></dd></td>
    </tr>
    <tr>
        <td colspan="3" align="center"><dt>DIRECCIÓN DEL CENTRO</dt><dd><?php echo utf8_encode($rowCV['direccion']) ?></dd></td>
    </tr>
    <tr>
        <td colspan="3" align="center">INFORMACIÓN DEL SOLICITANTE</td>
    <tr>
        <td colspan="2" align="center"><dt>Nombre -- Cédula</dt><dd><?php echo utf8_encode($row['nombre_solicitante'])." -- ".$row['cedula_solicitante'] ?></dd></td>
  
        <td align="center"><dt>Teléfono/Ocupación</dt><dd><?php echo utf8_encode($row['telefono_contacto'])." / ".$row['ocupacion_solicitante'] ?></dd></td>
    </tr>
    <tr>
        <td colspan="3" align="center">CONTINGENCIA QUE REPORTA</td>
    </tr>
    <tr>
        <td colspan="2" align="center">
<?php
$cat=cont_cat($id);
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
    <td colspan="2">
<?php
    if ($row['descripcion_contingencia'] != ""){
        echo "<td><textarea name=descripcion cols=65 rows=8 class=textarea>";
        echo utf8_encode($row['descripcion_contingencia']);
        echo "</textarea></td>";
    }else{
        echo  "<tr><td colspan=2>Sin definir</td></tr>";
    }
?>	
    </td>
    </tr>
    <tr>
    <td>RESULTADO DE LA CONTINGENCIA</td>
    </tr>
    <tr>
        <td>
<?php
$catRes=cont_catRes($db, $id);
$x=0;
for($i=0; $i<count($catRes); $i++){
    $c=$catRes[$i]['cat'];
    $s=$catRes[$i]['sub'];
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
        <td><?php echo conDesRes($db, $id) ?></td>
    </tr>
    <tr>
  	<td colspan="3"><input type="button" class="button" value="Imprimir" onclick="javascript:window.print();" /></td>
    </tr>
</table>
</body>
</html>

