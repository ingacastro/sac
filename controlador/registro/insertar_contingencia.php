<?php
include '../../modelo/config.php';
include '../../modelo/consultas.php';
include '../../clases/categoria.php';
include '../../clases/subcategoria.php';

session_start();
$db=conectar();
if(isset($_SESSION['cat'])){
$cat=$_SESSION['cat'];
    foreach($cat as $c=>$s){
        $catg[]= consCatD($db, $c+1);
        $subCatg[]=consSubD($db, $s);
    }
}
if(!isset($catg)){
    $catg=0;
}
 
if(!isset($subCatg)){
    $subCatg=0;
}
 
date_default_timezone_set('America/La_Paz');
$horaReg=date("Y-m-d H:i");
$horaR=date("H:i:s");
$cod_estado=$_POST['cod_estado'];
$cod_municipio=$_POST['cod_municipio'];
$cod_parroquia=$_POST['cod_parroquia'];
$codigo=$_POST['codigo'];
$rs= consTM2($db, $codigo);
$nombreSol=$_POST['nombre_solicitante'];
$tlf=$_POST['telefono'];
$rds=$_POST['rds'];
InsertarContingencia(utf8_decode($_POST['descripcion_contingencia']), $_POST['hora_llamada'], utf8_decode($nombreSol), $_POST['cedula_solicitante'], utf8_decode($tlf), utf8_decode($_POST['descripcion_solicitante']), $_SESSION['idUsuarioL'] , $_POST['codigo'], $horaReg, $catg, $subCatg, $horaR, $rds);
//InsertarContingencia($_POST['descripcion_contingencia'], $_POST['hora_llamada'], $nombreSol, $_POST['cedula_solicitante'], $tlf, $_POST['descripcion_solicitante'], $_SESSION['idUsuarioL'] , $_POST['codigo'], $horaReg, $catg, $subCatg, $horaR, $rds);

if($_POST['rds']==1){
    $nomSol="Usuario de Red Social";
    $nombre_solicitante=$_POST['nombre_solicitante'];
    $ced="URL";
    if($_POST['cedula_solicitante']==""){
        $cedula_solicitante="";
    }
    $tel="Red Social";
    $telefono="";
    $telefono=$_POST['codigo'];
    $desc="";
    $rds=1;
}else{
    $nomSol="Nombre del solicitante";
    if($_POST['nombre_solicitante']==""){
        $nombre_solicitante="Anónimo";
    }else{
        $nombre_solicitante=$_POST['nombre_solicitante'];
    }
    
    $ced="Cédula";
    if($_POST['cedula_solicitante']==""){
        $cedula_solicitante=0;
    }else{
        $cedula_solicitante=$_POST['cedula_solicitante'];
    }
    $tel="Teléfono";
    if(isset($_POST['telefono_solicitante'])){
         if($_POST['telefono_solicitante']==""){
            $telefono="Sin teléfono"; 
         }
        
    }else{
        $telefono=$_POST['telefono'];
    }
    $desc="Descripción del solicitante";
    $rds=0;
}

require '../../vista/registro/insertarContingencia.php';
?>
