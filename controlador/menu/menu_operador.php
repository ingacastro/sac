<?php
include '../../modelo/config.php';
include '../../modelo/consultas.php';
include '../login.php';

if($_SESSION['cod_usuarioL']==6){
    $db=conectar();
    $rsCoord=consCtgNac($db);
}

require '../../vista/menu/menu_operador.php';

if($_SESSION['cod_usuarioL']==6){
    $rsCoord=consCtgUsu(0, $db, $_SESSION['cod_usuarioL']);
    require '../../vista/menu/menu_coordinador.php';
}

?>

