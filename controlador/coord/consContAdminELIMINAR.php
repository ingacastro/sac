<?php
include '../../modelo/config.php';
include '../../modelo/consultas.php';

$db=conectar();

if(isset($_GET['v'])){
    $v=$_GET['v'];
    $query=conCtg($db, $v);
}else{
    $query=consCtgAd($db);
    $total = $query->rowCount();
}
require '../../vista/coord/consContAdmin.php';
?>