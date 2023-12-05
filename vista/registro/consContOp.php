<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>Mis contingencias</title>
<style type="text/css">
    a:link {color:#000000; text-decoration:none} /* unvisited link */
    a:visited {color:#0000CC;} /* visited link */
    a:hover {color:#FF0000; text-decoration:underline} /* mouse over link */
    a:active {color:#FFFF00;} /* selected link */
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$img='../../vista/cne.jpg';
$img2='../../imagen/LOGO20MAYO.png';
include '../../plantilla/encabezado.php';
?>
<table align="center" width="80%">
    <tr align="center">
        <td colspan="6" align="center">
            <input type="button" class="btn btn-primary btn-flat" value="Regresar al Menú" onclick="javascript:location.href='../menu/menu_operador.php'" class="btn btn-primary btn-flat"/>
        </td>
    </tr>
    <tr>
    	<th>No. de Contingencia</th>
       	<th>Hora de Llamada</th>
        <td align="center"><b>Centro de Votación</b></td>
        <th>Parroquia</th>
        <th>Municipio</th>
        <th>Origen</th>
    </tr>
<?php
while($row=$rsCtg->fetch(PDO::FETCH_BOTH)){
?>
    <tr>
        <td><?php echo $row['id_contingencia'] ?></td>
        <td><?php echo date("g:i a", strtotime($row['hora_registro']))?></td>
<?php
    $consCV= consTM2($db, $row['codigo_centro']);

    while ($row2 = $consCV->fetch(PDO::FETCH_BOTH)){
?>	
        <td align=center><a href="../consulta/consCont.php?id=<?php echo $row['id_contingencia'];?>"><?php echo utf8_encode($row2['nombre']) ?></a></td>
        <td align=center><?php echo $row2['des_parroquia'] ?></td>
        <td align=center><?php echo $row2['des_municipio'] ?></td>
<?php
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
    <tr align="center">
   	<td colspan="6">
            <input type="button" value="Regresar al Menú" onclick="javascript:location.href='../menu/menu_operador.php'" class="btn btn-primary btn-flat"/>
        </td>
    </tr>
</table>
</body>
</html>