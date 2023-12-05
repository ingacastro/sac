
<?php
session_start();
include '../../modelo/config.php';
include '../../modelo/consultas.php';
include '../../clases/categoria.php';
include '../../clases/subcategoria.php';
$idUsuarioL=$_SESSION['idUsuarioL'];
$cod_usuarioL=$_SESSION['cod_usuarioL'];
$tipoUsu=$_SESSION['tipoUsuarioL'];

$db=conectar();
$id_contingencia = $_GET['id_contingencia'];
$cat=$_POST['categ'];
$c= $cat[0];
if(isset($_POST['categ'])&& $_POST['categ']!=0){
    $cat=array_filter($_POST['categ']);
    $_SESSION['cat']=$cat;
    foreach($cat as $c=>$s){
        $catg[]= consCatD($db, $c+1);
        $subCatg[]=consSubD($db, $s);
    }
}

if($c==0){
    $subCatg=0;
}
echo $subCatg;
date_default_timezone_set('America/La_Paz');
$hora_resultado=date("Y-m-d H:i:s");
InsertarResultado($db, $id_contingencia, $idUsuarioL, utf8_decode($_POST['res']),  $hora_resultado, $subCatg);
require '../../vista/coord/ingresarResultado.php';
?>
       