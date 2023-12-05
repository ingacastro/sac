<?php
session_start();
include '../../modelo/config.php';
include '../../modelo/consultas.php';
$db=conectar();
$cont= consCtgAd($db);
require '../../vista/menu/menuSecretario.php';
?>