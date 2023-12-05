<!DOCTYPE html>
<html>
    <head>
        <title>Inicio de Sesión</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="vista/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="vista/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="vista/bower_components/Ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="vista/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="vista/plugins/iCheck/square/blue.css" >
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
<body class="hold-transition login-page">
    <div class="login-box" align="center">
<?php
$img='./vista/cne.jpg';
$img2='imagen/LOGO20MAYO.png';
include './plantilla/encabezado.php';
?>
<div class="login-box-body">
    <p class="login-box-msg">Ingrese usuario y contraseña</p>
<form  action="./controlador/usuario/ingresar_a_sistema.php" method="post" name="ingreso de usuario">
     <div class="form-group has-feedback">
        <input type="text" name="usuario" class="form-control" placeholder="Usuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
          <input type="password" class="form-control" name="contrasena" placeholder="Contrasena">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4 text-center"></div>
        <div class="col-xs-4 text-center">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <div class="col-xs-4 text-center"></div>
      </div>
</form>
</div>
          </div>
    </body>
</html>
