<?php
date_default_timezone_set('America/La_Paz');
include '../../modelo/config.php';
include '../../modelo/consultas.php';
include ("../login.php");
$img='../../vista/cne.jpg';
$img2='../../imagen/LOGO20MAYO.png';
require '../../plantilla/encabezado.php';
$db=conectar();
$query=consCtg($db, $_GET['id_contingencia']);

require '../../vista/consulta/agregarResultadoC.php';