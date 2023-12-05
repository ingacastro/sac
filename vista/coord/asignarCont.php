<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Asignar Contingente</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
<link rel="stylesheet"  href="../../vista/bower_components/bootstrap/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="../../vista/bower_components/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" href="../../vista/bower_components/Ionicons/css/ionicons.min.css" />
<link rel="stylesheet" href="../../vista/dist/css/AdminLTE.min.css" />
<link rel="stylesheet" href="../../vista/dist/css/skins/_all-skins.min.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" />
</head>
<script src="../select_dependientes2.js" language="javascript" type="text/javascript"></script>
<body>
<?php
$img='../../vista/cne.jpg';
$img2='../../imagen/LOGO20MAYO.png';
require '../../plantilla/encabezado.php';
$hora_asignacion=date("Y-m-d H:i:s");
?>
<section class="content">
<div class="box">
<div class="box-header">
<table align="center">
    <tr>
        <td colspan="3" align="center">El(Los) Funcionario(s) responsable(s) asignado a las <?php echo date("g:i a", strtotime($hora_asignacion))?> para la contingencia N° <?php echo $_GET['id'] ?> son:
        </td>
    </tr>
    <tr>
    	<td>Funcionario</td>
       	<td>Oficina</td>
      	<td>Celular</td>
    </tr>
    <tr>
        <td><?php echo utf8_encode($rowFunc['opcion']);?></td>
        <td><?php echo utf8_encode($rowOfic['opcion']);?></td>
        <td><?php echo $rowFunc['celular'] ?></td>
    </tr>
    <tr>
        <td><?php echo utf8_encode($rowFunc2['opcion']); ?></td>
        <td><?php echo utf8_encode($rowOfic2['opcion']); ?></td>
        <td><?php echo $rowFunc2['celular'] ?></td>
    </tr>
    <tr>
        <td><?php echo utf8_encode($rowFunc3['opcion']);?></td>
        <td><?php echo utf8_encode($rowOfic3['opcion']);?></td>
        <td><?php echo $rowFunc3['celular']?></td>
    </tr>
    <tr>
        <td>VPN: <?php echo $rwvpn['vpn'];?></td>
    </tr>
</table>
    <table align="center">
    <tr>
        <td>
        <input type="button" class="button" onclick="javascript:location.href='../menu/menu_coordinador.php';" value="Ir a Menú" />
        <input type="button" class="button" onclick="javascript:location.href='../coord/reporte_coordinador.php?id=<?php echo $_GET['id'] ?>';" value="Imprimir" />
        <input type="button" value="Regresar" onclick="javascript:history.back(-1)" class="button" />
        </td>
    </tr>
</table>
</div>
</div>
</section>
</body>
</html>