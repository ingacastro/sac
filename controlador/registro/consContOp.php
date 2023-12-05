<?php
session_start();
include '../../modelo/config.php';
include '../../modelo/consultas.php';
$db=conectar();
$id_usuario=$_GET['id_usuario'];
$rsCtg=consCtgUsu($id_usuario, $db, $_SESSION['cod_usuarioL']);
require '../../vista/registro/consContOp.php';
?>
