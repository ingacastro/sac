<?php
session_start();
include '../../modelo/config.php';
include '../../modelo/consultas.php';
$idUsuarioL=$_SESSION['idUsuarioL'];
$cod_usuarioL=$_SESSION['cod_usuarioL'];
$tipoUsu=$_SESSION['tipoUsuarioL'];
$db=conectar();

if(isset($_GET['v'])){
    $v=$_GET['v'];
    $query=conCtg($db, $v);
}else{
    $query=consCtgAd($db);
    $total = $query->rowCount();
}

//$cantrds=cantRDS($db)->rowCount();
//$cantMetro= cantMetro($db)->rowCount();
//$cantNac=cantNac($db)->rowCount();
//$cantRIS=cantRIS($db)->rowCount();
require '../../vista/coord/consContAdmin.php';

//require '../../vista/menu/menuAdministrador.php';
?>
