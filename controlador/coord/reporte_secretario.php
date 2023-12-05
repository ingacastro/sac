<?php
$id=$_GET['id'];
include '../../modelo/config.php';
include '../../modelo/consultas.php';
include('../login.php');
$db=conectar();
$qRes=consCtg($db, $id);
$row=$qRes->fetch(PDO::FETCH_BOTH);
$rsCV=consTM2($db, $row['codigo_centro']);
$rowCV=$rsCV->fetch(PDO::FETCH_BOTH);
$qU="select * from tabla_mesa where cod_estado = $rowCV[cod_estado] and cod_municipio=$rowCV[cod_municipio] and cod_parroquia=$rowCV[cod_parroquia]";
$queryU=$db->query($qU);
$rowU=$queryU->fetch(PDO::FETCH_BOTH);
require '../../vista/coord/reporte_secretario.php';
?>
