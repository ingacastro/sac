<?php
session_start();
include '../../modelo/config.php';
include '../../modelo/consultas.php';

$db=conectar();
if($_SESSION['cod_usuarioL']==6){
    $query=consNacUsu($db, $_SESSION['idUsuarioL']);
}else{
    $query=consCtgUsu($_SESSION['idUsuarioL'], $db, $_SESSION['cod_usuarioL']);
}
require '../../vista/consulta/contCoord.php';
?>
