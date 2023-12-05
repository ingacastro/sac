<?php
session_start();
include '../../modelo/config.php';
include '../../modelo/consultas.php';
$db=conectar();
$rsCoord=consCtgUsu(0, $db, $_SESSION['cod_usuarioL']);
require '../../vista/menu/menu_coordinador.php';
?>
