<!DOCTYPE html>
<html>
    <head>
        <title>Men&uacute; de Secretaria(o)</title>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
        <link rel="stylesheet"  href="../../vista/bower_components/bootstrap/dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../../vista/bower_components/font-awesome/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="../../vista/bower_components/Ionicons/css/ionicons.min.css"/>
        <link rel="stylesheet" href="../../vista/dist/css/AdminLTE.min.css"/>
        <link rel="stylesheet" href="../../vista/dist/css/skins/_all-skins.min.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" />
        <script src="../../js/bac.js" language="javascript" type="text/javascript"></script>
        <meta content="45" http-equiv="refresh" />
    </head>
    <body class="skin-blue">
    <?php
$img='../../vista/cne.jpg';
$img2='../../imagen/LOGO20MAYO.png';
require '../../plantilla/encabezado.php';
    ?>
<table>
    <tr>
        <td align="center" colspan="8"><h2>Seleccione la contingencia a consultar</h2></td>
    </tr>
    <tr>
        <td width = 5% align="center"><b>Ítem</b></td>
        <td width = 7% align="center"><b>Hora de la Llamada</b></td>
        <td width = 7% align=center><b>Hora de Coordinación</b></td>
        <td width = 7% align=center><b>Hora de Solución</b></td>
        <td width = 15% align=center><b>Nombre del Centro</b></td>
        <td width = 10% align=center><b>Parroquia</b></td>
        <td width = 10% align=center><b>Municipio</b></td>
        <td width = 10% align=center><b>Estado</b></td>
        <td width = 7% align=center><b>Solucionado por</b></td>
    </tr>
<?php
    while($row=$cont->fetch(PDO::FETCH_BOTH)){
?>
    <tr>
        <td align=center><?php echo $row['id_contingencia'] ?></td>
        <td align=center><?php echo date("g:i a", strtotime($row['hora_registro'])) ?></td>
        <td align=center>
<?php
    if($row['hora_coordinador']==null){
        echo "Sin coordinar";
    }else{
        
        $coord=consUsu($db, $row['id_coordinador']);
        echo utf8_encode($coord['nombre_usuario'])."<br/>".date("g:i a", strtotime($row['hora_coordinador']));
    }
?>
        </td>
<?php
    $rsRsCn=resCont($db, $row['id_contingencia']);
    if($rsRsCn->rowCount()>=1){
        $rwRsCn=$rsRsCn->fetch(PDO::FETCH_BOTH);
        echo "<td align=center>".date("g:i a", strtotime($rwRsCn['hora_resultado']))."</td>";
    }else{
        echo "<td align=center>Sin Resultado</td>";
    }

    $rowU=consUsu($db, $row['id_usuario_registro']);
    $rsTM= consTM2($db, $row['codigo_centro']);

    while ($row2 = $rsTM->fetch(PDO::FETCH_BOTH)){
?>
        <td align="center">
            <font size="2">
            <a href="../coord/consContSec.php?id_contingencia=<?php echo $row['id_contingencia'];?>">
                <?php echo utf8_encode($row2['nombre']) ?>
            </a>
            </font>
        </td>

            <td align="center"><font size=-1><?php echo utf8_encode($row2['des_parroquia']) ?></font></td>
            <td align="center"><font size=-1><?php echo utf8_encode($row2['des_municipio']) ?></font></td>
            <td align="center"><font size=-1><?php echo utf8_encode($row2['des_estado']) ?></font></td>
<?php
    }
        
    $r=consSRes($db, $row['id_contingencia']);
        if($r->rowCount()>0){
            $res=1;
            $rst=consSRes($db, $row['id_contingencia']);
        }else{
            $res=0;
        }
    
    $a=consAsig($db, $row['id_contingencia']);
        if($a->rowCount()>0){
            $asig=1;
        }else{
            $asig=0;
        }

        if($asig==0 && $res==0){
            echo "<td class=modo3>Sin asignar</td>";
        }else if($asig==0 && $res!=0){
            echo "<td class=modo1>Vía Telefónica</td>";
        }else if($asig!=0 && $res==0){
            echo "<td class=modo2>En proceso</td>";
        }else if($asig!=0 && $res!=0){
            echo "<td class=modo1>EMCE</td>";
        }else if($result==1){
            echo "<td class=modo1>Con Resultado</td>";

        }
    }
?>
	</tr>
    </table>
</body>
</html>
