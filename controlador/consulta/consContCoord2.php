<?php
session_start();
date_default_timezone_set('America/La_Paz');
include ("../../modelo/config.php");
include ("../../modelo/consultas.php");
include '../../clases/categoria.php';
include '../../clases/subcategoria.php';
$img='../../vista/cne.jpg';
$idUsuarioL=$_SESSION['idUsuarioL'];
$cod_usuarioL=$_SESSION['cod_usuarioL'];
$tipoUsu=$_SESSION['tipoUsuarioL'];
$db=conectar();
$id = $_GET['id'];
$consCtg=consCtg($db, $id);
$row=$consCtg->fetch(PDO::FETCH_BOTH);

if($row['id_coordinador']!=0 && $row['id_coordinador']!=$idUsuarioL){
    echo "<script>
        var coord='¡Está bajo Coordinación!';
        alert(coord);
        location.href='../menu/menu_coordinador.php';
    </script>"; 
}else if($row['id_coordinador']==0){
    $hora_coord=date("Y-m-d H:i:s");
    ActualizarCoordinador($idUsuarioL, $hora_coord, $id);
}

$rowCV=consTM($db, $row['codigo_centro']);
$rsCont=consCtg($db, $id);
$cat=cont_cat($id);
$result=consultarRes($db, $id);
require '../../vista/consulta/consContCrd.php';
?>