<?php
include ("../../modelo/config.php");
include '../../modelo/consultas.php';
include '../../clases/categoria.php';
include '../../clases/subcategoria.php';
$id = $_GET['id'];
$db=conectar();
$rsCont=consCtg($db, $id);
require '../../vista/consulta/consContCrdAdm.php';
?>
