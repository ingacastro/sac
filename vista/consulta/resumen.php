<!DOCTYPE html>
<html>
    <head>
        <title>Consultas</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
        <link rel="stylesheet"  href="../../vista/bower_components/bootstrap/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../vista/bower_components/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="../../vista/bower_components/Ionicons/css/ionicons.min.css" />
        <link rel="stylesheet" href="../../vista/dist/css/AdminLTE.min.css" />
        <link rel="stylesheet" href="../../vista/dist/css/skins/_all-skins.min.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" />
        <script src="../../js/buscador_ajax_centro.js" language="javascript" type="text/javascript"></script>
    </head>
<body class="skin-green">
<table align="center">
    <tr>
        <td align="center">RESUMEN</td>
    </tr>
</table>
<table align="center">
    <tr>
        <td colspan="2" align="center"><h3 class="box-title">Total Contingencias<br /><?php echo $ttlCtg ?></h3> </td>
    </tr>
    <tr>
      	<td align="center"><h3 class="box-title">Solución Telefónica<br /><?php echo $ttlST  ?></h3></td>
       	<td align="center"><h3 class="box-title">Solucionadas bajo Contingente:<br /><?php echo $ttlSAsig; ?></h3></td>
    </tr>
    <tr>
        <td colspan="2" align="center">Reporte por Categorías</td>
    </tr>
    <tr>
        <td style="font-size:16px" align="center">Categoría</td>
        <td style="font-size:16px" align="center">Cantidad</td>
    </tr>
<?php
$c=-1;
$d=-1;
    while($rwCnCt=$rsCnCt->fetch(PDO::FETCH_BOTH)){
        $rwCat=consCatg($db, $rwCnCt['cod_cat']);
        $rwSub=consSubCat($db,  $rwCnCt['cod_sub']);
        $c=$rwCnCt['cod_cat'];
        if($c!=$d){
?>
    <tr>
        <td align="center"><hr><?php echo utf8_encode($rwCat['descripcion_cat']) ?></td>
    </tr>
<?php
        }
?>
    <tr>
        <td style="font-size:16px" align="center"><?php echo utf8_encode($rwSub['desub'])?></td>
        <td style="font-size:16px" align="center"><?php echo $rwCnCt['cant'] ?></td>
    </tr>
<?php
        $d=$rwCnCt['cod_cat'];
    }
?>
    <tr>
        <td colspan="2" align="center">Contingencia por Horas</td>
    </tr>
    <tr>
        <td style="font-size:16px" align="center">Hora</td>
        <td style="font-size:16px" align="center">Cantidad</td>
    </tr>
<?php
    while($rwH=$rsH->fetch(PDO::FETCH_BOTH)){
?>
    <tr>
        <td style="font-size:16px" align="center"><?php echo $rwH['hora'] ?></td>
        <td style="font-size:16px" align="center"><?php echo $rwH['cant'];?></td>
    </tr>
<?php
    }
?>
    <tr>
        <td align="center"><input type="button" class="button" onclick="javascript:location.href='../controlador/ordenado.php?mos=6';" value='Imprimir' /></td>
    </tr>
 </table>
</body>
</html>