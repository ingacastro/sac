<?php
session_start();
date_default_timezone_set('America/La_Paz');
include ("../../modelo/config.php");
include ("../../modelo/consultas.php");
include '../../clases/categoria.php';
include '../../clases/subcategoria.php';
$idUsuarioL=$_SESSION['idUsuarioL'];
$db=conectar();
$id = $_GET['id'];
$qCon=consCtg($db, $id);
$row=$qCon->fetch(PDO::FETCH_BOTH);

if($row['id_coordinador']!=0 && $row['id_coordinador']!=$idUsuarioL){
    echo "<script>
        var coord='¡Está bajo Coordinación!';
        alert(coord);
        location.href='menu_coordinador.php';
    </script>"; 
}else if($row['id_coordinador']==0){
    $hora_coord=date("Y-m-d H:i:s");
    ActualizarCoordinador($idUsuarioL, $hora_coord, $id);
}

$rowCV=consTMNac($db, $row['codigo_centro']);
echo "tipo: ".$row['rds'];
if($row['rds']==1){
    $nomSol="Usuario de Red Social";
    $nombre_solicitante="<a href='".$row['nombre_solicitante']."'>".$row['nombre_solicitante']."</a>";
    $ced="URL";
    if($row['cedula_solicitante']==""){
        $cedula_solicitante="";
    }else{
        $cedula_solicitante="<a href='".$row['cedula_solicitante']."'>".$row['cedula_solicitante']."</a>";
    }
    $tel="Red Social";
    $telefono=$row['telefono_contacto'];
    $desc="";
    $rds=1;
}else if($row['rds']==2){
    $nomSol="RIS";
    $nombre_solicitante=$row['nombre_solicitante'];
    $ced="";
    if($row['cedula_solicitante']==""){
        $cedula_solicitante="";
    }else{
        $cedula_solicitante="<a href='".$row['cedula_solicitante']."'>".$row['cedula_solicitante']."</a>";
    }
    $tel="";
    $telefono="";
    $desc="";
    $rds=2;
}else if($row['rds']==0){
    $nomSol="Nombre del solicitante";
    if($row['nombre_solicitante']==""){
        $nombre_solicitante="Anónimo";
    }else{
        $nombre_solicitante=$row['nombre_solicitante'];
    }
    
    $ced="Cédula";
    if($row['cedula_solicitante']==""){
        $cedula_solicitante=0;
    }else{
        $cedula_solicitante=$row['cedula_solicitante'];
    }
    $tel="Teléfono";
    if($row['telefono_contacto']==""){
        $telefono="Sin teléfono";
    }else{
        $telefono=$row['telefono_contacto'];
    }
    $desc="Descripción del solicitante";
    $rds=0;
}
require '../../vista/consulta/consContCrd.php';
?>