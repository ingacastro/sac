<?php
session_start();
include '../../modelo/config.php';
include '../../modelo/consultas.php';
include '../../clases/categoria.php';
include '../../clases/subcategoria.php';

$codigo = $_GET['codigo'];
$db=conectar();
$rsC=consDupCtg($db, $codigo);
if($_SESSION['cod_usuarioL']==6){
    $row= consTMNac($db, $codigo);    
}else if($_SESSION['cod_usuarioL']!=6){
    $row= consTMNac($db, $codigo);  
}
date_default_timezone_set('America/Caracas');
$hora_registro=date("Y-m-d H:i");
$hora_llamada=date("Y-m-d H:i");
$horaR=date("H:i:s");

$cat=consCat($db);

require '../../vista/registro/cargaInformacion.php';
?>
