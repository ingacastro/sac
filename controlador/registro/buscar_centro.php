<?php
session_start();
include '../../modelo/config.php';
include '../../modelo/consultas.php';
$db= conectar();
$q = $_GET['q'];
extraer($q, $db);
?>