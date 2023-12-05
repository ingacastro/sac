<meta http-equiv="refresh" content="60" />
<?php
include '../modelo/config.php';
include '../modelo/consultas.php';
include 'login.php';
$img='../vista/cne.jpg';
require '../plantilla/encabezado.php';
$db=conectar();
$ttlCtg= consCtgAd($db)->rowCount();
$ttlSC=consCtgUsu(0, $db, 2)->rowCount();
$qAna="select * from contingencia where id_coordinador!=0 and id_contingencia not in (select id_contingencia from asignacioncont union select id_contingencia from resultadocont)";
$rsAna=$db->query($qAna);
$ttlAna=$rsAna->rowCount();
$qAsig="select distinct id_contingencia from asignacioncont where id_contingencia not in (select id_contingencia from resultadocont)";
$rsAsig=$db->query($qAsig);
$ttlAsig=$rsAsig->rowCount();
$qST="select distinct id_contingencia from resultadocont where id_contingencia not in (select distinct id_contingencia from asignacioncont)";
$rsST=$db->query($qST);
$ttlST=$rsST->rowCount();
$qSAsig="select distinct id_contingencia from resultadocont where id_contingencia in (select distinct id_contingencia from asignacioncont)";
$rsSAsig=$db->query($qSAsig);
$ttlSAsig=$rsSAsig->rowCount();
require '../vista/reporteGeneral.php';
?>
