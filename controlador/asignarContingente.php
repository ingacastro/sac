<?php
include '../modelo/config.php';
include '../modelo/consultas.php';
include ('login.php');
$img='../vista/cne.jpg';
require '../plantilla/encabezado.php';
$db=conectar();
var_dump($_POST);

date_default_timezone_set('America/La_Paz');
require '../vista/asignarCont.php';
?>
