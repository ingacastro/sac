<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Contingencias Coordinadas</title>
</head>
<script src="../../js/bac.js" language="javascript" type="text/javascript"></script>
<script src="../../js/acciones.js" language="javascript" type="text/javascript"></script>
<body class="bg-gray-light">
<?php
$img='../../vista/cne.jpg';
$img2='../../imagen/LOGO20MAYO.png';
require '../../plantilla/encabezado.php';
?>
<table align="center" width="80%">
    <tr>
        <td align="center" colspan="8"><input type="button" name="modificar" value="Regresar" onclick="atras()" class="button" /></td>
    </tr>
<?php
$total = $query->rowCount();
if($total>0){
?>
    <tr>
        <th>Ítem</th>
        <th>Hora de Llamada</th>
        <th>Registrado por</th>
        <th>Coordinado por</th>
        <th>Nombre del Centro</th>
        <th>Dirección del Centro</th>
        <th>Parroquia</th>
        <th>Municipio</th>
        <th>Estatus</th>
        <th>Origen</th>
    </tr>
<?php
while ($row = $query->fetch(PDO::FETCH_BOTH)){
?>
    <tr>
        <td align="center"><?php echo $row['id_contingencia'] ?></td>
        <td align="center"><?php echo date("g:i a", strtotime($row['hora_registro'])) ?></td>
<?php
    $rowU=consUsu($db, $row['id_usuario_registro']);
?>
        <td align="center"><?php echo utf8_encode($rowU['nombre_usuario']) ?></td>
<?php
    $filaC=consUsu($db, $row['id_coordinador']);
?>
        <td align="center"><?php echo utf8_encode($filaC['nombre_usuario']) ?></td>
<?php
    $qCV=consTM2($db, $row['codigo_centro']);
    while($row2 = $qCV->fetch(PDO::FETCH_BOTH)){
?>
        <td align="center">
            <font size="2">
                <a href="consContCoord.php?id=<?php echo $row['id_contingencia'];?>">
                    <?php echo utf8_encode($row2['nombre'])?>
                </a>
            </font>
        </td>
        <td align="center"><?php echo utf8_encode($row2['direccion'])?></td>
        <td align="center"><?php echo $row2['des_parroquia'] ?></td>
        <td align="center"><?php echo $row2['des_municipio'] ?></td>
<?php

    }

$rsRsCon=consSRes($db, $row['id_contingencia']);

if($rsRsCon->rowCount()>0){
    $res=1;
}else{
    $res=0;
}

$asig=consAsig($db, $row['id_contingencia']);
if($asig->rowCount()>0){
    $ctasig=1;
}else{
    $ctasig=0;
}

    if($ctasig==0 && $res==0){
        echo "<td align=center>Sin asignar</td>";
    }else if($ctasig==0 && $res!=0){
        echo "<td align=center>Solucionado Vía Telefónica</td>";
    }else if($ctasig!=0 && $res==0){
        echo "<td align=center>Asignado</td>";
    }else if($ctasig!=0 && $res!=0){
        echo "<td align=center>EMCE</td>";
    }else if($res==1){
        echo "<td align=center>Solucionado por EMCE</td>";
    }
    
    switch($row['rds']){
            case 0:
                $org="Llamada";
                $dsc="0-800";
            break;
            case 1:
                $org="Red social";
                $dsc=$row['telefono_contacto'];
                break;
            case 2:
                $org="RIS";
                $dsc=$row['nombre_solicitante'];
            break;
        }
?>
        <td align="center"><?php echo $org."<br/>".$dsc?></td>
        <?php
}
?>
    </tr>
<?php
    }else{
?>
        <tr>
            <td align="center">¡Usted no tiene Contingencias actualmente, vuelva al menú y escoja una!</td>
        </tr>
<?php
    }
?>
    <tr>
        <td align="center" colspan="8"><input type="button" name="modificar" value="Regresar" onclick="atras()" class="button" /></td>
    </tr>
</table>
</body>
</html>

