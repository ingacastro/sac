<?php
session_start();
include '../../modelo/config.php';
include '../../modelo/consultas.php';
include '../../clases/categoria.php';
include '../../clases/subcategoria.php';
$db=conectar();
$id = $_GET['id'];
$rsCont=consCtg($db, $id);
$cat=cont_cat($id);
$idUsuarioL=$_SESSION['idUsuarioL'];

require '../../vista/consulta/consCont.php';
?>