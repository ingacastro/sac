<?php
include '../../modelo/config.php';
include '../../modelo/consultas.php';
include '../../clases/categoria.php';
include '../../clases/subcategoria.php';
$db=conectar();
session_start();



if(isset($_POST['cat'])){
    $cat=array_filter($_POST['cat']);
    $_SESSION['cat']=$cat;
    foreach($cat as $c=>$s){
        $catg[]= consCatD($db, $c+1);
        $subCatg[]=consSubD($db, $s);
    }
}
echo "tipo: ".$_POST['tipo'];
if(isset($_POST['tipo']) && $_POST['tipo']==1){
    $nomSol="Usuario de Red Social";
    $nombre_solicitante=$_POST['usuario'];
    $ced="URL";
    if($_POST['url']==""){
        $cedula_solicitante="";
    }else{
        $cedula_solicitante=$_POST['url'];
    }
    $tel="Red Social";
    $cod=$_POST['redSocial'];
    $telefono="";
    $telefono=$_POST['redSocial'];
    $desc="";
    $descripcionSolicitante="";
    $rs=1;
}else if(isset($_POST['tipo']) && $_POST['tipo']==2){
    $nomSol="RIS";
    $nombre_solicitante=$_POST['nombre_ris'];
    $ced="";
    $cedula_solicitante="";
    $tel="Teléfono";
    $cod="";
    if($_POST['telefono_ris']==""){
        $telefono="Sin teléfono";
    }else{
        $telefono=$_POST['cod_tlf_ris']."-".$_POST['telefono_ris'];
    }
    $desc="Descripción del RIS";
    if($_POST['desc_ris']==""){
        $descripcionSolicitante="";
    }else{
        $descripcionSolicitante=$_POST['desc_ris'];
    }
    $rs=2;
}else if(isset($_POST['tipo']) && $_POST['tipo']==0){
  
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
    if($_POST['telefono_solicitante']==""){
        $telefono="Sin teléfono";
    }else{
        $telefono=$_POST['cod_tlf_solicitante']."-".$_POST['telefono_solicitante'];
    }
    $desc="Descripción del solicitante";
    if($_POST['ocupacion_solicitante']==""){
        $descripcionSolicitante="";
    }else{
        $descripcionSolicitante=$_POST['ocupacion_solicitante'];
    }
    $rs=0;
}

require '../../vista/registro/registrar_contingencia.php';
?>
