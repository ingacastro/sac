<?php
$ttlCtg= consCtgAd($db)->rowCount();
$qST="select distinct id_contingencia from resultadocont where id_contingencia not in (select distinct id_contingencia from asignacioncont)";
$rsST=$db->query($qST);
$ttlST=$rsST->rowCount();
$qSAsig="select distinct id_contingencia from resultadocont where id_contingencia in (select distinct id_contingencia from asignacioncont)";
$rsSAsig=$db->query($qSAsig);
$ttlSAsig=$rsSAsig->rowCount();
$qCnCt="select cod_cat, cod_sub, count(*) as cant from cont_cat group by cod_cat, cod_sub";
$rsCnCt=$db->query($qCnCt);
$rsH=reporteH($db);
if(isset($_GET['mos']) && $_GET['mos']==6){
    include '../../vista/reporte_resumen.php';
}else{
    include '../../vista/consulta/resumen.php';
}
?>