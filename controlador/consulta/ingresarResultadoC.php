<?php
include '../../modelo/config.php';
include '../../modelo/consultas.php';
include'../login.php';


$id_resultado= $_GET['id_resultado'];
if(isset($_POST['resultado'])){
    $resultado = utf8_decode($_POST['resultado']);
}else if(isset($_GET['resultado'])){
    $resultado = utf8_decode($_GET['resultado']);
}else{
    $resultado="";
}
date_default_timezone_set('America/La_Paz');
$hora_resultado=date("Y-m-d H:i:s");
$db=conectar();

require '../../vista/consulta/ingresarResultadoC.php';
?>
