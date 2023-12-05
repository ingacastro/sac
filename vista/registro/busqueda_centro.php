<head>
    <title>Búsqueda de Centro de Votación</title>
    <script type="text/javascript" src="../js/sd3n.js"></script>
    <script src="../../js/bac.js" language="javascript" type="text/javascript"></script>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
    <link rel="stylesheet"  href="../../vista/bower_components/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../vista/bower_components/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../../vista/bower_components/Ionicons/css/ionicons.min.css"/>
    <link rel="stylesheet" href="../../vista/dist/css/AdminLTE.min.css"/>
    <link rel="stylesheet" href="../../vista/dist/css/skins/_all-skins.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" />
</head>
<?php
$img='../../vista/cne.jpg';
$img2='../../imagen/LOGO20MAYO.png';
require '../../plantilla/encabezado.php';
?>
<table width='auto' align='center'>
    <tr>
        <td align="center">CENTRO DE VOTACIÓN<br />
            <input type="text" name="centro_de_votacion" id="centro_de_votacion" class="input" size="100" maxlength="100" onkeypress="Buscar();"  />
        </td>
    </tr>
    <tr>
        <td align="center">
            <div class="resultados" id="resultados">
            </div>
        </td>
    </tr>
    <tr>
        <td align="center">
<?php 
if ($_SESSION['tipoUsuarioL']=='Operador'){
    echo "<input type=button class='btn btn-primary btn-flat' onclick=javascript:location.href='../menu/menu_operador.php'; value=Menú />";
}else if($_SESSION['tipoUsuarioL']=='Coordinador General' || $_SESSION['tipoUsuarioL']=='Administrador'){
    echo "<input type=button class='btn btn-primary btn-flat' onclick=javascript:location.href='menu_administrador.php'; value=Menú />";
}
?>
        </td>
    </tr>
</table>
