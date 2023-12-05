<meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
  <link rel="stylesheet"  href="../../vista/bower_components/bootstrap/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../../vista/bower_components/font-awesome/css/font-awesome.min.css"/>
  <link rel="stylesheet" href="../../vista/bower_components/Ionicons/css/ionicons.min.css"/>
  <link rel="stylesheet" href="../../vista/dist/css/AdminLTE.min.css"/>
  <link rel="stylesheet" href="../../vista/dist/css/skins/_all-skins.min.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" />  
<div class="login-logo" align="center">
    <img src="<?php echo $img ?>"  width="150" height="100" longdesc="http://www.cne.gob.ve" />
    <img src="<?php echo $img2 ?>"  width="150" height="100" longdesc="http://www.cne.gob.ve" />
  </div>
<title>REFERENDO CONSULTIVO 2023</title>

<!-- <table width="88%" align="center">
    <tr>
        <td align="center"> -->
<?php
$col = $col1 = '';
if(isset($_SESSION['nombreUsuarioL'])){
    $col = 6;
    $col1 = '<div class="col-md-3"></div>';
} else {
    $col = 12;
    $col1 = '';
}
?>
<div class="row">
    <?=$col1?>
    <div class="col-md-<?=$col?> text-center">
        CONSEJO NACIONAL ELECTORAL<br />
        SALA DE ARTICULACIÓN CON LOS <br />
        ORGANISMOS DEL PODER PÚBLICO NACIONAL Y <br />
        ATENCIÓN DE INCIDENCIAS ELECTORALES<br />
        REFERENDO CONSULTIVO 2023<br />
        3 DE DICIEMBRE
    </div>

        <!-- </td> -->
<?php
if(isset($_SESSION['nombreUsuarioL'])){
?>
    <!-- <td align='center' width='12%'> -->
    <div class="col-md-3 text-center">
    <?php echo utf8_encode($_SESSION['nombreUsuarioL']) ?><br/>
    <a href='../../controlador/usuario/cerrarSesion.php'>Salir</a>
    </div>
    <!-- </td> -->
<?php
}
?>
</div>
    <!-- </tr>
</table> -->
