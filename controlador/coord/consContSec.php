<?php //
session_start();
include '../../modelo/config.php';
include '../../modelo/consultas.php';
include '../../clases/categoria.php';
include '../../clases/subcategoria.php';
$db=conectar();
$id_contingencia = $_GET['id_contingencia'];
$qCont=consCtg($db, $_GET['id_contingencia']);
$row=$qCont->fetch(PDO::FETCH_BOTH);
$coord=consUsu($db, $row['id_coordinador']);
$rsCV=consTM2($db, $row['codigo_centro']);
$rowCV=$rsCV->fetch(PDO::FETCH_BOTH);
$cat=cont_cat($_GET['id_contingencia']);
$rsAC= consAsig($db, $_GET['id_contingencia']);
$rwRes=consSRes($db, $_GET['id_contingencia']);
require '../../vista/coord/consContSec.php';
?>
