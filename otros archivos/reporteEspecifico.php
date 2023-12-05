<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>Total Específico</title>
<link rel="stylesheet" type="text/css" href="estilos.css">
</head>

<body>
<?php
include ('login.php');
$db=conectar();
?>
<table>
    <tr>
        <td><?php require './plantilla/encabezado.php'; ?></td>
        <td>
<?php
    if($loginCorrecto){
        echo "<th>Usuario:<h1>".$nombreUsuarioL."</h1>";
        echo "Tipo de Usuario: <h1>".$tipoUsuarioL."</h1></th></tr>";
    }else{
        echo "<th>Bienvenido, el sistema no te ha reconocido</th></tr>";
    }
?>
        </td>
    </tr>
</table>
<?php
    $qCnt="select count(*) from contingencia";
    $rsCnt=$db->query($qCnt);
    $totalRecibidas=$rsCnt->fetch(PDO::FETCH_BOTH);
    $qLib="select count(*) from contingencia C, tabla_mesa T where C.codigo_centro=T.codigo and T.cod_estado=1 and T.cod_municipio=1";
    $rsLib=$db->query($qLib);
    $totalLibertador=$rsLib->fetch(PDO::FETCH_BOTH);
    $qCrdL="select count(*) from contingencia C, tabla_mesa T where C.id_coordinador!=0 and C.codigo_centro=T.codigo and T.cod_estado=1 and T.cod_municipio=1";
    $rsCrdL=$db->query($qCrdL);
    $totalCoordinadasL=$rsCrdL->fetch(PDO::FETCH_BOTH);
    $qAsgL="select count(*) from contingencia C, asignacioncont A, tabla_mesa T where C.id_contingencia in (select distinct A.id_contingencia from asignacioncont A, contingencia C where A.id_contingencia=C.id_contingencia) and C.codigo_centro=T.codigo and T.cod_estado=1 and T.cod_municipio=1";
    $rsAsgL=$db->query($qAsgL);
    $totalAsignadasL=$rsAsgL->fetch(PDO::FETCH_BOTH);
    $qRL="select count(*) from resultadocont A, contingencia B, tabla_mesa C where A.id_contingencia=B.id_contingencia and B.codigo_centro=C.codigo and C.cod_estado=1 and C.cod_municipio=1";
    $rsRL=$db->query($qRL);
    $totalResueltasL=$rsRL->fetch(PDO::FETCH_BOTH);
//    $qTCL="select count(*) from contingencia where contingencia_cerrada!=0 and cod_estado=1 and cod_municipio=1";
//    echo $qTCL;
//    $rsCL=$db->query($qTCL);
    
//    $totalCerradasL=$rsCL->fetch(PDO::FETCH_BOTH);
//    $totalCaptahuellaL=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai!=0 and cod_estado=1 and cod_municipio=1"));
//    $totalCaptahuellaD=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=1 and cod_estado=1 and cod_municipio=1"));
//    $totalCaptahuellaF=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=2 and cod_estado=1 and cod_municipio=1"));
//    $totalCaptahuellaG=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=3 and cod_estado=1 and cod_municipio=1"));
//    $totalCaptahuellaH=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=4 and cod_estado=1 and cod_municipio=1"));
//    $totalCaptahuellaI=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=5 and cod_estado=1 and cod_municipio=1"));
//    $totalAcreditaL=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita!=0 and cod_estado=1 and cod_municipio=1"));
//    $totalAcreditaLA=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita=1 and cod_estado=1 and cod_municipio=1"));
//    $totalAcreditaLB=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita=2 and cod_estado=1 and cod_municipio=1"));
//    $totalAcreditaLC=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita=3 and cod_estado=1 and cod_municipio=1"));
//    $totalMaquinaL=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina!=0 and cod_estado=1 and cod_municipio=1"));
//    $totalMaquinaLA=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=1 and cod_estado=1 and cod_municipio=1"));
//    $totalMaquinaLB=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=2 and cod_estado=1 and cod_municipio=1"));
//    $totalMaquinaLC=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=3 and cod_estado=1 and cod_municipio=1"));
//    $totalMaquinaLD=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=4 and cod_estado=1 and cod_municipio=1"));
//    $totalMaterialL=mysql_fetch_array(mysql_query("select count(*) from contingencia where material!=0 and cod_estado=1 and cod_municipio=1"));
//    $totalMaterialLA=mysql_fetch_array(mysql_query("select count(*) from contingencia where material=1 and cod_estado=1 and cod_municipio=1"));
//    $totalMaterialLB=mysql_fetch_array(mysql_query("select count(*) from contingencia where material=2 and cod_estado=1 and cod_municipio=1"));
//    $totalMaterialLC=mysql_fetch_array(mysql_query("select count(*) from contingencia where material=3 and cod_estado=1 and cod_municipio=1"));
//    $totalMiembroL=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro!=0 and cod_estado=1 and cod_municipio=1"));
//    $totalMiembroLA=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=1 and cod_estado=1 and cod_municipio=1"));
//    $totalMiembroLB=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=2 and cod_estado=1 and cod_municipio=1"));
//    $totalMiembroLC=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=3 and cod_estado=1 and cod_municipio=1"));
//    $totalMiembroLD=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=4 and cod_estado=1 and cod_municipio=1"));
//    $totalConatoL=mysql_fetch_array(mysql_query("select count(*) from contingencia where conato!=0 and cod_estado=1 and cod_municipio=1"));
//    $totalCVL=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion!=0 and cod_estado=1 and cod_municipio=1"));
//    $totalCVLA=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=1 and cod_estado=1 and cod_municipio=1"));
//    $totalCVLB=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=2 and cod_estado=1 and cod_municipio=1"));
//    $totalCVLC=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=3 and cod_estado=1 and cod_municipio=1"));
//    $totalCVLD=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=4 and cod_estado=1 and cod_municipio=1"));
//    $totalCVLE=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=5 and cod_estado=1 and cod_municipio=1"));
//    $totalCVLF=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=6 and cod_estado=1 and cod_municipio=1"));
//    $totalCVLG=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=7 and cod_estado=1 and cod_municipio=1"));
//    $totalCVLH=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=8 and cod_estado=1 and cod_municipio=1"));
//    $totalPoliticoL=mysql_fetch_array(mysql_query("select count(*) from contingencia where politico!=0 and cod_estado=1 and cod_municipio=1"));
//    $totalElectorL=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector!=0 and cod_estado=1 and cod_municipio=1"));
//    $totalElectorLA=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=1 and cod_estado=1 and cod_municipio=1"));
//    $totalElectorLB=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=2 and cod_estado=1 and cod_municipio=1"));
//    $totalElectorLC=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=3 and cod_estado=1 and cod_municipio=1"));
//    $totalElectorLD=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=4 and cod_estado=1 and cod_municipio=1"));
//    $totalElectorLE=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=5 and cod_estado=1 and cod_municipio=1"));
//    $totalElectorLF=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=6 and cod_estado=1 and cod_municipio=1"));
//    $totalElectorLG=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=7 and cod_estado=1 and cod_municipio=1"));
//    $totalElectorLH=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=8 and cod_estado=1 and cod_municipio=1"));
//    $totalElectorLI=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=9 and cod_estado=1 and cod_municipio=1"));
//    $totalElectorLJ=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=10 and cod_estado=1 and cod_municipio=1"));
//
//    $totalBaruta=mysql_fetch_array(mysql_query("select count(*) from contingencia where cod_estado=13 and cod_municipio=16"));
//    $totalCoordinadasB=mysql_fetch_array(mysql_query("select count(*) from contingencia where id_coordinador!=0 and cod_estado=13 and cod_municipio=16"));
//    $totalAsignadasB=mysql_fetch_array(mysql_query("select count(*) from contingencia where funcionario!=0 and cod_estado=13 and cod_municipio=16"));
//    $totalResueltasB=mysql_fetch_array(mysql_query("select count(*) from contingencia where resultado!='Sin resultado' and cod_estado=13 and cod_municipio=16"));
//    $totalCerradasB=mysql_fetch_array(mysql_query("select count(*) from contingencia where contingencia_cerrada!=0 and cod_estado=13 and cod_municipio=16"));
//    $totalCaptahuellaB=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai!=0 and cod_estado=13 and cod_municipio=16"));
//    $totalCaptahuellaBD=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=1 and cod_estado=13 and cod_municipio=16"));
//    $totalCaptahuellaBF=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=2 and cod_estado=13 and cod_municipio=16"));
//    $totalCaptahuellaBG=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=3 and cod_estado=13 and cod_municipio=16"));
//    $totalCaptahuellaBH=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=4 and cod_estado=13 and cod_municipio=16"));
//    $totalCaptahuellaBI=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=5 and cod_estado=13 and cod_municipio=16"));
//    $totalAcreditaB=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita!=0 and cod_estado=13 and cod_municipio=16"));
//    $totalAcreditaBA=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita=1 and cod_estado=13 and cod_municipio=16"));
//    $totalAcreditaBB=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita=2 and cod_estado=13 and cod_municipio=16"));
//    $totalAcreditaBC=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita=3 and cod_estado=13 and cod_municipio=16"));
//    $totalMaquinaB=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina!=0 and cod_estado=13 and cod_municipio=16"));
//    $totalMaquinaBA=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=1 and cod_estado=13 and cod_municipio=16"));
//    $totalMaquinaBB=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=2 and cod_estado=13 and cod_municipio=16"));
//    $totalMaquinaBC=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=3 and cod_estado=13 and cod_municipio=16"));
//    $totalMaquinaBD=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=4 and cod_estado=13 and cod_municipio=16"));
//    $totalMaterialB=mysql_fetch_array(mysql_query("select count(*) from contingencia where material!=0 and cod_estado=13 and cod_municipio=16"));
//    $totalMaterialBA=mysql_fetch_array(mysql_query("select count(*) from contingencia where material=1 and cod_estado=13 and cod_municipio=16"));
//    $totalMaterialBB=mysql_fetch_array(mysql_query("select count(*) from contingencia where material=2 and cod_estado=13 and cod_municipio=16"));
//    $totalMaterialBC=mysql_fetch_array(mysql_query("select count(*) from contingencia where material=3 and cod_estado=13 and cod_municipio=16"));
//    $totalMiembroB=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro!=0 and cod_estado=13 and cod_municipio=16"));
//    $totalMiembroBA=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=1 and cod_estado=13 and cod_municipio=16"));
//    $totalMiembroBB=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=2 and cod_estado=13 and cod_municipio=16"));
//    $totalMiembroBC=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=3 and cod_estado=13 and cod_municipio=16"));
//    $totalMiembroBD=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=4 and cod_estado=13 and cod_municipio=16"));
//    $totalConatoB=mysql_fetch_array(mysql_query("select count(*) from contingencia where conato!=0 and cod_estado=13 and cod_municipio=16"));
//    $totalCVB=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion!=0 and cod_estado=13 and cod_municipio=16"));
//    $totalCVBA=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=1 and cod_estado=13 and cod_municipio=16"));
//    $totalCVBB=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=2 and cod_estado=13 and cod_municipio=16"));
//    $totalCVBC=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=3 and cod_estado=13 and cod_municipio=16"));
//    $totalCVBD=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=4 and cod_estado=13 and cod_municipio=16"));
//    $totalCVBE=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=5 and cod_estado=13 and cod_municipio=16"));
//    $totalCVBF=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=6 and cod_estado=13 and cod_municipio=16"));
//    $totalCVBG=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=7 and cod_estado=13 and cod_municipio=16"));
//    $totalCVBH=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=8 and cod_estado=13 and cod_municipio=16"));
//    $totalPoliticoB=mysql_fetch_array(mysql_query("select count(*) from contingencia where politico!=0 and cod_estado=13 and cod_municipio=16"));
//    $totalElectorB=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector!=0 and cod_estado=13 and cod_municipio=16"));
//    $totalElectorBA=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=1 and cod_estado=13 and cod_municipio=16"));
//    $totalElectorBB=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=2 and cod_estado=13 and cod_municipio=16"));
//    $totalElectorBC=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=3 and cod_estado=13 and cod_municipio=16"));
//    $totalElectorBD=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=4 and cod_estado=13 and cod_municipio=16"));
//    $totalElectorBE=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=5 and cod_estado=13 and cod_municipio=16"));
//    $totalElectorBF=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=6 and cod_estado=13 and cod_municipio=16"));
//    $totalElectorBG=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=7 and cod_estado=13 and cod_municipio=16"));
//    $totalElectorBH=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=8 and cod_estado=13 and cod_municipio=16"));
//    $totalElectorBI=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=9 and cod_estado=13 and cod_municipio=16"));
//    $totalElectorBJ=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=10 and cod_estado=13 and cod_municipio=16"));
//
//    $totalChacao=mysql_fetch_array(mysql_query("select count(*) from contingencia where cod_estado=13 and cod_municipio=18"));
//    $totalCoordinadasC=mysql_fetch_array(mysql_query("select count(*) from contingencia where id_coordinador!=0 and cod_estado=13 and cod_municipio=18"));
//    $totalAsignadasC=mysql_fetch_array(mysql_query("select count(*) from contingencia where funcionario!=0 and cod_estado=13 and cod_municipio=18"));
//    $totalResueltasC=mysql_fetch_array(mysql_query("select count(*) from contingencia where resultado!='Sin resultado' and cod_estado=13 and cod_municipio=18"));
//    $totalCerradasC=mysql_fetch_array(mysql_query("select count(*) from contingencia where contingencia_cerrada!=0 and cod_estado=13 and cod_municipio=18"));
//    $totalCaptahuellaC=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai!=0 and cod_estado=13 and cod_municipio=18"));
//    $totalCaptahuellaCD=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=1 and cod_estado=13 and cod_municipio=18"));
//    $totalCaptahuellaCF=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=2 and cod_estado=13 and cod_municipio=18"));
//    $totalCaptahuellaCG=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=3 and cod_estado=13 and cod_municipio=18"));
//    $totalCaptahuellaCH=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=4 and cod_estado=13 and cod_municipio=18"));
//    $totalCaptahuellaCI=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=5 and cod_estado=13 and cod_municipio=18"));
//    $totalAcreditaC=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita!=0 and cod_estado=13 and cod_municipio=18"));
//    $totalAcreditaCA=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita=1 and cod_estado=13 and cod_municipio=18"));
//    $totalAcreditaCB=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita=2 and cod_estado=13 and cod_municipio=18"));
//    $totalAcreditaCC=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita=3 and cod_estado=13 and cod_municipio=18"));
//    $totalMaquinaC=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina!=0 and cod_estado=13 and cod_municipio=18"));
//    $totalMaquinaCA=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=1 and cod_estado=13 and cod_municipio=18"));
//    $totalMaquinaCB=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=2 and cod_estado=13 and cod_municipio=18"));
//    $totalMaquinaCC=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=3 and cod_estado=13 and cod_municipio=18"));
//    $totalMaquinaCD=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=4 and cod_estado=13 and cod_municipio=18"));
//    $totalMaterialC=mysql_fetch_array(mysql_query("select count(*) from contingencia where material!=0 and cod_estado=13 and cod_municipio=18"));
//    $totalMaterialCA=mysql_fetch_array(mysql_query("select count(*) from contingencia where material=1 and cod_estado=13 and cod_municipio=18"));
//    $totalMaterialCB=mysql_fetch_array(mysql_query("select count(*) from contingencia where material=2 and cod_estado=13 and cod_municipio=18"));
//    $totalMaterialCC=mysql_fetch_array(mysql_query("select count(*) from contingencia where material=3 and cod_estado=13 and cod_municipio=18"));
//    $totalMiembroC=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro!=0 and cod_estado=13 and cod_municipio=18"));
//    $totalMiembroCA=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=1 and cod_estado=13 and cod_municipio=18"));
//    $totalMiembroCB=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=2 and cod_estado=13 and cod_municipio=18"));
//    $totalMiembroCC=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=3 and cod_estado=13 and cod_municipio=18"));
//    $totalMiembroCD=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=4 and cod_estado=13 and cod_municipio=18"));
//    $totalConatoC=mysql_fetch_array(mysql_query("select count(*) from contingencia where conato!=0 and cod_estado=13 and cod_municipio=18"));
//    $totalCVC=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion!=0 and cod_estado=13 and cod_municipio=18"));
//    $totalCVCA=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=1 and cod_estado=13 and cod_municipio=18"));
//    $totalCVCB=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=2 and cod_estado=13 and cod_municipio=18"));
//    $totalCVCC=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=3 and cod_estado=13 and cod_municipio=18"));
//    $totalCVCD=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=4 and cod_estado=13 and cod_municipio=18"));
//    $totalCVCE=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=5 and cod_estado=13 and cod_municipio=18"));
//    $totalCVCF=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=6 and cod_estado=13 and cod_municipio=18"));
//    $totalCVCG=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=7 and cod_estado=13 and cod_municipio=18"));
//    $totalCVCH=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=8 and cod_estado=13 and cod_municipio=18"));
//    $totalPoliticoC=mysql_fetch_array(mysql_query("select count(*) from contingencia where politico!=0 and cod_estado=13 and cod_municipio=18"));
//    $totalElectorC=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector!=0 and cod_estado=13 and cod_municipio=18"));
//    $totalElectorCA=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=1 and cod_estado=13 and cod_municipio=18"));
//    $totalElectorCB=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=2 and cod_estado=13 and cod_municipio=18"));
//    $totalElectorCC=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=3 and cod_estado=13 and cod_municipio=18"));
//    $totalElectorCD=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=4 and cod_estado=13 and cod_municipio=18"));
//    $totalElectorCE=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=5 and cod_estado=13 and cod_municipio=18"));
//    $totalElectorCF=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=6 and cod_estado=13 and cod_municipio=18"));
//    $totalElectorCG=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=7 and cod_estado=13 and cod_municipio=18"));
//    $totalElectorCH=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=8 and cod_estado=13 and cod_municipio=18"));
//    $totalElectorCI=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=9 and cod_estado=13 and cod_municipio=18"));
//    $totalElectorCJ=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=10 and cod_estado=13 and cod_municipio=18"));
//
//    $totalEH=mysql_fetch_array(mysql_query("select count(*) from contingencia where cod_estado=13 and cod_municipio=19"));
//    $totalCoordinadasEH=mysql_fetch_array(mysql_query("select count(*) from contingencia where id_coordinador!=0 and cod_estado=13 and cod_municipio=19"));
//    $totalAsignadasEH=mysql_fetch_array(mysql_query("select count(*) from contingencia where funcionario!=0 and cod_estado=13 and cod_municipio=19"));
//    $totalResueltasEH=mysql_fetch_array(mysql_query("select count(*) from contingencia where resultado!='Sin resultado' and cod_estado=13 and cod_municipio=19"));
//    $totalCerradasEH=mysql_fetch_array(mysql_query("select count(*) from contingencia where contingencia_cerrada!=0 and cod_estado=13 and cod_municipio=19"));					
//    $totalCaptahuellaEH=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai!=0 and cod_estado=13 and cod_municipio=19"));
//    $totalCaptahuellaEHD=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=1 and cod_estado=13 and cod_municipio=19"));
//    $totalCaptahuellaEHF=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=2 and cod_estado=13 and cod_municipio=19"));
//    $totalCaptahuellaEHG=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=3 and cod_estado=13 and cod_municipio=19"));
//    $totalCaptahuellaEHH=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=4 and cod_estado=13 and cod_municipio=19"));
//    $totalCaptahuellaEHI=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=5 and cod_estado=13 and cod_municipio=19"));
//    $totalAcreditaEH=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita!=0 and cod_estado=13 and cod_municipio=19"));
//    $totalAcreditaEHA=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita=1 and cod_estado=13 and cod_municipio=19"));
//    $totalAcreditaEHB=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita=2 and cod_estado=13 and cod_municipio=19"));
//    $totalAcreditaEHC=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita=3 and cod_estado=13 and cod_municipio=19"));
//    $totalMaquinaEH=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina!=0 and cod_estado=13 and cod_municipio=19"));
//    $totalMaquinaEHA=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=1 and cod_estado=13 and cod_municipio=19"));
//    $totalMaquinaEHB=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=2 and cod_estado=13 and cod_municipio=19"));
//    $totalMaquinaEHC=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=3 and cod_estado=13 and cod_municipio=19"));
//    $totalMaquinaEHD=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=4 and cod_estado=13 and cod_municipio=19"));
//    $totalMaterialEH=mysql_fetch_array(mysql_query("select count(*) from contingencia where material!=0 and cod_estado=13 and cod_municipio=19"));
//    $totalMaterialEHA=mysql_fetch_array(mysql_query("select count(*) from contingencia where material=1 and cod_estado=13 and cod_municipio=19"));
//    $totalMaterialEHB=mysql_fetch_array(mysql_query("select count(*) from contingencia where material=2 and cod_estado=13 and cod_municipio=19"));
//    $totalMaterialEHC=mysql_fetch_array(mysql_query("select count(*) from contingencia where material=3 and cod_estado=13 and cod_municipio=19"));
//    $totalMiembroEH=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro!=0 and cod_estado=13 and cod_municipio=19"));
//    $totalMiembroEHA=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=1 and cod_estado=13 and cod_municipio=19"));
//    $totalMiembroEHB=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=2 and cod_estado=13 and cod_municipio=19"));
//    $totalMiembroEHC=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=3 and cod_estado=13 and cod_municipio=19"));
//    $totalMiembroEHD=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=4 and cod_estado=13 and cod_municipio=19"));
//    $totalConatoEH=mysql_fetch_array(mysql_query("select count(*) from contingencia where conato!=0 and cod_estado=13 and cod_municipio=19"));
//    $totalCVEH=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion!=0 and cod_estado=13 and cod_municipio=19"));
//    $totalCVEHA=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=1 and cod_estado=13 and cod_municipio=19"));
//    $totalCVEHB=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=2 and cod_estado=13 and cod_municipio=19"));
//    $totalCVEHC=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=3 and cod_estado=13 and cod_municipio=19"));
//    $totalCVEHD=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=4 and cod_estado=13 and cod_municipio=19"));
//    $totalCVEHE=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=5 and cod_estado=13 and cod_municipio=19"));
//    $totalCVEHF=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=6 and cod_estado=13 and cod_municipio=19"));
//    $totalCVEHG=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=7 and cod_estado=13 and cod_municipio=19"));
//    $totalCVEHH=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=8 and cod_estado=13 and cod_municipio=19"));
//    $totalPoliticoEH=mysql_fetch_array(mysql_query("select count(*) from contingencia where politico!=0 and cod_estado=13 and cod_municipio=19"));
//    $totalElectorEH=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector!=0 and cod_estado=13 and cod_municipio=19"));
//    $totalElectorEHA=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=1 and cod_estado=13 and cod_municipio=19"));
//    $totalElectorEHB=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=2 and cod_estado=13 and cod_municipio=19"));
//    $totalElectorEHC=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=3 and cod_estado=13 and cod_municipio=19"));
//    $totalElectorEHD=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=4 and cod_estado=13 and cod_municipio=19"));
//    $totalElectorEHE=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=5 and cod_estado=13 and cod_municipio=19"));
//    $totalElectorEHF=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=6 and cod_estado=13 and cod_municipio=19"));
//    $totalElectorEHG=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=7 and cod_estado=13 and cod_municipio=19"));
//    $totalElectorEHH=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=8 and cod_estado=13 and cod_municipio=19"));
//    $totalElectorEHI=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=9 and cod_estado=13 and cod_municipio=19"));
//    $totalElectorEHJ=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=10 and cod_estado=13 and cod_municipio=19"));
//
//    $totalS=mysql_fetch_array(mysql_query("select count(*) from contingencia where cod_estado=13 and cod_municipio=9"));
//    $totalCoordinadasS=mysql_fetch_array(mysql_query("select count(*) from contingencia where id_coordinador!=0 and cod_estado=13 and cod_municipio=9"));
//    $totalAsignadasS=mysql_fetch_array(mysql_query("select count(*) from contingencia where funcionario!=0 and cod_estado=13 and cod_municipio=9"));
//    $totalResueltasS=mysql_fetch_array(mysql_query("select count(*) from contingencia where resultado!='Sin resultado' and cod_estado=13 and cod_municipio=9"));
//    $totalCerradasS=mysql_fetch_array(mysql_query("select count(*) from contingencia where contingencia_cerrada!=0 and cod_estado=13 and cod_municipio=9"));
//    $totalCaptahuellaS=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai!=0 and cod_estado=13 and cod_municipio=9"));
//    $totalCaptahuellaSD=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=1 and cod_estado=13 and cod_municipio=9"));
//    $totalCaptahuellaSF=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=2 and cod_estado=13 and cod_municipio=9"));
//    $totalCaptahuellaSG=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=3 and cod_estado=13 and cod_municipio=9"));
//    $totalCaptahuellaSH=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=4 and cod_estado=13 and cod_municipio=9"));
//    $totalCaptahuellaSI=mysql_fetch_array(mysql_query("select count(*) from contingencia where sai=5 and cod_estado=13 and cod_municipio=9"));
//    $totalAcreditaS=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita!=0 and cod_estado=13 and cod_municipio=9"));
//    $totalAcreditaSA=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita=1 and cod_estado=13 and cod_municipio=9"));
//    $totalAcreditaSB=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita=2 and cod_estado=13 and cod_municipio=9"));
//    $totalAcreditaSC=mysql_fetch_array(mysql_query("select count(*) from contingencia where acredita=3 and cod_estado=13 and cod_municipio=9"));
//    $totalMaquinaS=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina!=0 and cod_estado=13 and cod_municipio=9"));
//    $totalMaquinaSA=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=1 and cod_estado=13 and cod_municipio=9"));
//    $totalMaquinaSB=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=2 and cod_estado=13 and cod_municipio=9"));
//    $totalMaquinaSC=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=3 and cod_estado=13 and cod_municipio=9"));
//    $totalMaquinaSD=mysql_fetch_array(mysql_query("select count(*) from contingencia where maquina=4 and cod_estado=13 and cod_municipio=9"));
//    $totalMaterialS=mysql_fetch_array(mysql_query("select count(*) from contingencia where material!=0 and cod_estado=13 and cod_municipio=9"));
//    $totalMaterialSA=mysql_fetch_array(mysql_query("select count(*) from contingencia where material=1 and cod_estado=13 and cod_municipio=9"));
//    $totalMaterialSB=mysql_fetch_array(mysql_query("select count(*) from contingencia where material=2 and cod_estado=13 and cod_municipio=9"));
//    $totalMaterialSC=mysql_fetch_array(mysql_query("select count(*) from contingencia where material=3 and cod_estado=13 and cod_municipio=9"));
//    $totalMiembroS=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro!=0 and cod_estado=13 and cod_municipio=9"));
//    $totalMiembroSA=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=1 and cod_estado=13 and cod_municipio=9"));
//    $totalMiembroSB=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=2 and cod_estado=13 and cod_municipio=9"));
//    $totalMiembroSC=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=3 and cod_estado=13 and cod_municipio=9"));
//    $totalMiembroSD=mysql_fetch_array(mysql_query("select count(*) from contingencia where miembro=4 and cod_estado=13 and cod_municipio=9"));
//    $totalConatoS=mysql_fetch_array(mysql_query("select count(*) from contingencia where conato!=0 and cod_estado=13 and cod_municipio=9"));
//    $totalCVS=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion!=0 and cod_estado=13 and cod_municipio=9"));
//    $totalCVSA=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=1 and cod_estado=13 and cod_municipio=9"));
//    $totalCVSB=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=2 and cod_estado=13 and cod_municipio=9"));
//    $totalCVSC=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=3 and cod_estado=13 and cod_municipio=9"));
//    $totalCVSD=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=4 and cod_estado=13 and cod_municipio=9"));
//    $totalCVSE=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=5 and cod_estado=13 and cod_municipio=9"));
//    $totalCVSF=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=6 and cod_estado=13 and cod_municipio=9"));
//    $totalCVSG=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=7 and cod_estado=13 and cod_municipio=9"));
//    $totalCVSH=mysql_fetch_array(mysql_query("select count(*) from contingencia where centrovotacion=8 and cod_estado=13 and cod_municipio=9"));
//    $totalPoliticoS=mysql_fetch_array(mysql_query("select count(*) from contingencia where politico!=0 and cod_estado=13 and cod_municipio=9"));
//    $totalElectorS=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector!=0 and cod_estado=13 and cod_municipio=9"));
//    $totalElectorSA=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=1 and cod_estado=13 and cod_municipio=9"));
//    $totalElectorSB=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=2 and cod_estado=13 and cod_municipio=9"));
//    $totalElectorSC=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=3 and cod_estado=13 and cod_municipio=9"));
//    $totalElectorSD=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=4 and cod_estado=13 and cod_municipio=9"));
//    $totalElectorSE=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=5 and cod_estado=13 and cod_municipio=9"));
//    $totalElectorSF=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=6 and cod_estado=13 and cod_municipio=9"));
//    $totalElectorSG=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=7 and cod_estado=13 and cod_municipio=9"));
//    $totalElectorSH=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=8 and cod_estado=13 and cod_municipio=9"));
//    $totalElectorSI=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=9 and cod_estado=13 and cod_municipio=9"));
//    $totalElectorSJ=mysql_fetch_array(mysql_query("select count(*) from contingencia where elector=10 and cod_estado=13 and cod_municipio=9"));

?>

<table>
    <tr>
    	<td colspan="6"><h3>Total de Contingencias Recibidas: <?php echo $totalRecibidas[0]; ?></h3></td>        
    </tr>
</table>
<table class="tablaR">
    <tr class="modo3">
        <td><h1>Municipio</h1></td>
    	<td><h1>Libertador<br  /><?php echo $totalLibertador[0] ?></h1></td>
      	<td><h1>Chacao<br  /><?php echo $totalChacao[0] ?></h1></td>
       	<td><h1>Baruta<br  /><?php echo $totalBaruta[0] ?></h1></td>
      	<td><h1>Sucre<br  /><?php echo $totalS[0] ?></h1></td>
       	<td><h1>El Hatillo<br  /><?php echo $totalEH[0] ?></h1></td>
    </tr>
    <tr class="modo4">
    	<td><h1>Coordinadas</h1></td>
        <td><h1><?php echo$totalCoordinadasL[0]; ?></h1></td>
        <td><h1><?php echo$totalCoordinadasC[0]; ?></h1></td>
        <td><h1><?php echo$totalCoordinadasB[0]; ?></h1></td>
        <td><h1><?php echo$totalCoordinadasS[0]; ?></h1></td>
        <td><h1><?php echo$totalCoordinadasEH[0]; ?></h1></td>
    </tr>
    <tr class="modo4">
    	<td><h1>Asignadas</h1></td>
        <td><h1><?php echo $totalAsignadasL[0]  ?></h1></td>
        <td><h1><?php echo $totalAsignadasC[0]  ?></h1></td>
        <td><h1><?php echo $totalAsignadasB[0]  ?></h1></td>
        <td><h1><?php echo $totalAsignadasS[0]  ?></h1></td>
        <td><h1><?php echo $totalAsignadasEH[0]  ?></h1></td>
    </tr>
    <tr class="modo4">
    	<td><h1>Solucionadas</h1></td>
        <td><h1><?php echo $totalResueltasL[0]; ?></h1></td>
        <td><h1><?php echo $totalResueltasC[0]; ?></h1></td>
        <td><h1><?php echo $totalResueltasB[0]; ?></h1></td>
        <td><h1><?php echo $totalResueltasS[0]; ?></h1></td>
        <td><h1><?php echo $totalResueltasEH[0]; ?></h1></td>
    </tr>
    <tr class="modo4">
    	<td><h1>Cerradas</h1></td>
        <td><h1><?php echo $totalCerradasL[0]; ?></h1></td>
        <td><h1><?php echo $totalCerradasC[0]; ?></h1></td>
        <td><h1><?php echo $totalCerradasB[0]; ?></h1></td>
        <td><h1><?php echo $totalCerradasS[0]; ?></h1></td>
        <td><h1><?php echo $totalCerradasEH[0]; ?></h1></td>
    </tr>
    <tr class="modo1">
    	<td><h1>SAI</h1></td>
        <td><h1><?php echo $totalCaptahuellaL[0]; ?></h1></td>
        <td><h1><?php echo $totalCaptahuellaC[0]; ?></h1></td>
        <td><h1><?php echo $totalCaptahuellaB[0]; ?></h1></td>
        <td><h1><?php echo $totalCaptahuellaS[0]; ?></h1></td>
        <td><h1><?php echo $totalCaptahuellaEH[0]; ?></h1></td>
    </tr>
    <tr class="modo2">
        <td><h4>SAI Dañado</h4></td>
      	<td><h4><?php echo $totalCaptahuellaD[0]; ?></h4></td>
       	<td><h4><?php echo $totalCaptahuellaCD[0]; ?></h4></td>
       	<td><h4><?php echo $totalCaptahuellaBD[0]; ?></h4></td>
       	<td><h4><?php echo $totalCaptahuellaSD[0]; ?></h4></td>        
       	<td><h4><?php echo $totalCaptahuellaEHD[0]; ?></h4></td>
    </tr>
    <tr class="modo2">
        <td><h4>Falta de SAI</h4></td>
      	<td><h4><?php echo $totalCaptahuellaF[0]; ?></h4></td>
       	<td><h4><?php echo $totalCaptahuellaCF[0]; ?></h4></td>
       	<td><h4><?php echo $totalCaptahuellaBF[0]; ?></h4></td>
       	<td><h4><?php echo $totalCaptahuellaSF[0]; ?></h4></td>        
       	<td><h4><?php echo $totalCaptahuellaEHF[0]; ?></h4></td>
    </tr>
    <tr class="modo2">
        <td><h4>Tardanza en Sustitución de Contingencia</h4></td>
      	<td><h4><?php echo $totalCaptahuellaG[0]; ?></h4></td>
       	<td><h4><?php echo $totalCaptahuellaBG[0]; ?></h4></td>
       	<td><h4><?php echo $totalCaptahuellaCG[0]; ?></h4></td>
       	<td><h4><?php echo $totalCaptahuellaSG[0]; ?></h4></td>        
       	<td><h4><?php echo $totalCaptahuellaEHG[0]; ?></h4></td>
    </tr>
    <tr class="modo2">
        <td><h4>SAI No reconoce la huella</h4></td>
      	<td><h4><?php echo $totalCaptahuellaH[0]; ?></h4></td>
      	<td><h4><?php echo $totalCaptahuellaCH[0]; ?></h4></td>
     	<td><h4><?php echo $totalCaptahuellaBH[0]; ?></h4></td>
     	<td><h4><?php echo $totalCaptahuellaSH[0]; ?></h4></td>        
       	<td><h4><?php echo $totalCaptahuellaEHH[0]; ?></h4></td>
    </tr>
    <tr class="modo2">
        <td><h4>Ausencia del Operador SAI</h4></td>
      	<td><h4><?php echo $totalCaptahuellaI[0]; ?></h4></td>
       	<td><h4><?php echo $totalCaptahuellaCI[0]; ?></h4></td>
       	<td><h4><?php echo $totalCaptahuellaBI[0]; ?></h4></td>
       	<td><h4><?php echo $totalCaptahuellaSI[0]; ?></h4></td>        
        <td><h4><?php echo $totalCaptahuellaEHI[0]; ?></h4></td>
    </tr>
    <tr class="modo1">
    	<td><h1>Acreditación</h1></td>
      	<td><h1><?php echo $totalAcreditaL[0]; ?></h1></td>
      	<td><h1><?php echo $totalAcreditaC[0]; ?></h1></td>        
      	<td><h1><?php echo $totalAcreditaB[0]; ?></h1></td>        
      	<td><h1><?php echo $totalAcreditaS[0]; ?></h1></td>                
      	<td><h1><?php echo $totalAcreditaEH[0]; ?></h1></td>
    </tr>
    <tr class="modo2">
        <td><h4>Miembros de Mesa No Acreditado</h4></td>
        <td><h4><?php echo $totalAcreditaLA[0]; ?></h4></td>
        <td><h4><?php echo $totalAcreditaCA[0]; ?></h4></td>
        <td><h4><?php echo $totalAcreditaBA[0]; ?></h4></td>                
        <td><h4><?php echo $totalAcreditaSA[0]; ?></h4></td>        
        <td><h4><?php echo $totalAcreditaEHA[0]; ?></h4></td>        
    </tr>
    <tr class="modo2">
    	<td><h4>Miembros de Mesa con Acreditación Falsa</h4></td>
        <td><h4><?php echo $totalAcreditaLB[0]; ?></h4></td>
        <td><h4><?php echo $totalAcreditaCB[0]; ?></h4></td>
        <td><h4><?php echo $totalAcreditaBB[0]; ?></h4></td>
        <td><h4><?php echo $totalAcreditaSB[0]; ?></h4></td>
        <td><h4><?php echo $totalAcreditaEHB[0]; ?></h4></td>
	</tr>
    <tr class="modo2">
    	<td><h4>Testigos No Acreditados o con Acreditación Falsa</h4></td>
        <td><h4><?php echo $totalAcreditaLC[0]; ?></h4></td>
        <td><h4><?php echo $totalAcreditaCC[0]; ?></h4></td>
        <td><h4><?php echo $totalAcreditaBC[0]; ?></h4></td>                
        <td><h4><?php echo $totalAcreditaSC[0]; ?></h4></td>
        <td><h4><?php echo $totalAcreditaEHC[0]; ?></h4></td>
	</tr>
    <tr class="modo1">
    	<td><h1>Máquinas de Votación</h1></td>
        <td><h1><?php echo $totalMaquinaL[0]; ?></h1></td>
        <td><h1><?php echo $totalMaquinaC[0]; ?></h1></td>
        <td><h1><?php echo $totalMaquinaB[0]; ?></h1></td>
        <td><h1><?php echo $totalMaquinaS[0]; ?></h1></td>
        <td><h1><?php echo $totalMaquinaEH[0]; ?></h1></td>                                
    </tr>
    <tr class="modo2">
       	<td><h4>Falla de Impresión</h4></td>
        <td><h4><?php echo $totalMaquinaLA[0]; ?></h4></td>
        <td><h4><?php echo $totalMaquinaCA[0]; ?></h4></td>        
        <td><h4><?php echo $totalMaquinaBA[0]; ?></h4></td>
        <td><h4><?php echo $totalMaquinaSA[0]; ?></h4></td>
        <td><h4><?php echo $totalMaquinaEHA[0]; ?></h4></td>
    </tr>
    <tr class="modo2">
    	<td><h4>Máquina No Funciona</h4></td>
        <td><h4><?php echo $totalMaquinaLB[0]; ?></h4></td>
        <td><h4><?php echo $totalMaquinaCB[0]; ?></h4></td>
        <td><h4><?php echo $totalMaquinaBB[0]; ?></h4></td>
        <td><h4><?php echo $totalMaquinaSB[0]; ?></h4></td>                        
        <td><h4><?php echo $totalMaquinaEHB[0]; ?></h4></td>        
    </tr>
    <tr class="modo2">
    	<td><h4>Tardanza en Sustitución de Máquina de Votación</h4></td>
        <td><h4><?php echo $totalMaquinaLC[0]; ?></h4></td>
        <td><h4><?php echo $totalMaquinaCC[0]; ?></h4></td>        
        <td><h4><?php echo $totalMaquinaBC[0]; ?></h4></td>
        <td><h4><?php echo $totalMaquinaSC[0]; ?></h4></td>
        <td><h4><?php echo $totalMaquinaEHC[0]; ?></h4></td>                        
    </tr>
    <tr class="modo2">
       	<td><h4>Ausencia del Operador de la Máquina de Votación</h4></td>
        <td><h4><?php echo $totalMaquinaLD[0]; ?></h4></td>
        <td><h4><?php echo $totalMaquinaCD[0]; ?></h4></td>        
        <td><h4><?php echo $totalMaquinaBD[0]; ?></h4></td>
        <td><h4><?php echo $totalMaquinaSD[0]; ?></h4></td>
        <td><h4><?php echo $totalMaquinaEHD[0]; ?></h4></td> 
    </tr>
    <tr class="modo1">
    	<td><h1>Material Electoral</h1></td>
        <td><h1><?php echo $totalMaterialL[0] ?></h1></td>
        <td><h1><?php echo $totalMaterialC[0] ?></h1></td>        
        <td><h1><?php echo $totalMaterialB[0] ?></h1></td>
        <td><h1><?php echo $totalMaterialS[0] ?></h1></td>                
        <td><h1><?php echo $totalMaterialEH[0] ?></h1></td>
    </tr>
    <tr class="modo2">
    	<td><h4>Cotillón Incompleto</h4></td>
        <td><h4><?php echo $totalMaterialLA[0] ?></h4></td>
        <td><h4><?php echo $totalMaterialCA[0] ?></h4></td>        
        <td><h4><?php echo $totalMaterialBA[0] ?></h4></td>
        <td><h4><?php echo $totalMaterialSA[0] ?></h4></td>
        <td><h4><?php echo $totalMaterialEHA[0] ?></h4></td>                        
    </tr>
    <tr class="modo2">
    	<td><h4>Falta Cotillón</h4></td>
        <td><h4><?php echo $totalMaterialLB[0] ?></h4></td>
        <td><h4><?php echo $totalMaterialCB[0] ?></h4></td>
        <td><h4><?php echo $totalMaterialBB[0] ?></h4></td>
        <td><h4><?php echo $totalMaterialSB[0] ?></h4></td>
        <td><h4><?php echo $totalMaterialEHB[0] ?></h4></td>                                
    </tr>
    <tr class="modo2">
    	<td><h4>Material Electoral Erróneamente Asignado</h4></td>
        <td><h4><?php echo $totalMaterialLC[0] ?></h4></td>
        <td><h4><?php echo $totalMaterialCC[0] ?></h4></td>        
        <td><h4><?php echo $totalMaterialBC[0] ?></h4></td>
        <td><h4><?php echo $totalMaterialSC[0] ?></h4></td>
        <td><h4><?php echo $totalMaterialEHC[0] ?></h4></td>                        
    </tr>
    <tr class="modo1">
    	<td><h1>Miembros de Mesa</h1></td>
        <td><h1><?php echo $totalMiembroL[0] ?></h1></td>
        <td><h1><?php echo $totalMiembroC[0] ?></h1></td>
        <td><h1><?php echo $totalMiembroB[0] ?></h1></td>
        <td><h1><?php echo $totalMiembroS[0] ?></h1></td>
        <td><h1><?php echo $totalMiembroEH[0] ?></h1></td>                                
    </tr>
    <tr class="modo2">
      	<td><h4>No Constitución por ausencia de Miembros de Mesa</h4></td>
        <td><h4><?php echo $totalMiembroLA[0] ?></h4></td>
        <td><h4><?php echo $totalMiembroCA[0] ?></h4></td>
        <td><h4><?php echo $totalMiembroBA[0] ?></h4></td>        
        <td><h4><?php echo $totalMiembroSA[0] ?></h4></td>
        <td><h4><?php echo $totalMiembroEHA[0] ?></h4></td>                
    </tr>
    <tr class="modo2">
      	<td><h4>Miembros de Mesa desconocen el Proceso de Votación</h4></td>
        <td><h4><?php echo $totalMiembroLB[0] ?></h4></td>
        <td><h4><?php echo $totalMiembroCB[0] ?></h4></td>        
        <td><h4><?php echo $totalMiembroBB[0] ?></h4></td>
        <td><h4><?php echo $totalMiembroSB[0] ?></h4></td>
        <td><h4><?php echo $totalMiembroEHB[0] ?></h4></td>                
    </tr>
    <tr class="modo2">
      	<td><h4>Desconocimiento del Procedimiento del Acto de Verificación Ciudadana</h4></td>
        <td><h4><?php echo $totalMiembroLC[0] ?></h4></td>
        <td><h4><?php echo $totalMiembroCC[0] ?></h4></td>        
        <td><h4><?php echo $totalMiembroBC[0] ?></h4></td>        
        <td><h4><?php echo $totalMiembroSC[0] ?></h4></td>        
        <td><h4><?php echo $totalMiembroEHC[0] ?></h4></td>        
    </tr>
    <tr class="modo2">
      	<td><h4>Mal manejo de la Contingencia de Transmisión</h4></td>
        <td><h4><?php echo $totalMiembroLD[0] ?></h4></td>
        <td><h4><?php echo $totalMiembroCD[0] ?></h4></td>        
        <td><h4><?php echo $totalMiembroBD[0] ?></h4></td>
        <td><h4><?php echo $totalMiembroSD[0] ?></h4></td>
        <td><h4><?php echo $totalMiembroEHD[0] ?></h4></td>                        
    </tr>
    <tr class="modo1">
      	<td><h1>Conato de Sabotaje</h1></td>
        <td><h1><?php echo $totalConatoL[0] ?></h1></td>
        <td><h1><?php echo $totalConatoC[0] ?></h1></td>        
        <td><h1><?php echo $totalConatoB[0] ?></h1></td>
        <td><h1><?php echo $totalConatoS[0] ?></h1></td>
        <td><h1><?php echo $totalConatoEH[0] ?></h1></td>                
    </tr>        
   	<tr class="modo1">
      	<td><h1>Centros de Votación</h1></td>
        <td><h1><?php echo $totalCVL[0] ?></h1></td>
        <td><h1><?php echo $totalCVC[0] ?></h1></td>        
        <td><h1><?php echo $totalCVB[0] ?></h1></td>        
        <td><h1><?php echo $totalCVS[0] ?></h1></td>        
        <td><h1><?php echo $totalCVEH[0] ?></h1></td>        
    </tr>
    <tr class="modo2">
      	<td><h4>Mesa(s) No Constituída(s)</h4></td>
        <td><h4><?php echo $totalCVLA[0] ?></h4></td>
        <td><h4><?php echo $totalCVCA[0] ?></h4></td>        
        <td><h4><?php echo $totalCVBA[0] ?></h4></td>        
        <td><h4><?php echo $totalCVSA[0] ?></h4></td>        
        <td><h4><?php echo $totalCVEHA[0] ?></h4></td>        
    </tr>
    <tr class="modo2">
     	<td><h4>Mesas no constituída por Centro de Votación Cerrado</h4></td>
        <td><h4><?php echo $totalCVLB[0] ?></h4></td>
        <td><h4><?php echo $totalCVCB[0] ?></h4></td>        
        <td><h4><?php echo $totalCVBB[0] ?></h4></td>        
        <td><h4><?php echo $totalCVSB[0] ?></h4></td>
        <td><h4><?php echo $totalCVEHB[0] ?></h4></td>                
    </tr>
    <tr class="modo2">
      	<td><h4>Cerrado por Electores en Cola</h4></td>
        <td><h4><?php echo $totalCVLC[0] ?></h4></td>
        <td><h4><?php echo $totalCVCC[0] ?></h4></td>
        <td><h4><?php echo $totalCVBC[0] ?></h4></td>
        <td><h4><?php echo $totalCVSC[0] ?></h4></td>                        
        <td><h4><?php echo $totalCVEHC[0] ?></h4></td>        
    </tr>
    <tr class="modo2">
      	<td><h4>Electores exceden capacidad física del área de Verificación Ciudadana</h4></td>
        <td><h4><?php echo $totalCVLD[0] ?></h4></td>
        <td><h4><?php echo $totalCVCD[0] ?></h4></td>        
        <td><h4><?php echo $totalCVBD[0] ?></h4></td>
        <td><h4><?php echo $totalCVSD[0] ?></h4></td>
        <td><h4><?php echo $totalCVEHD[0] ?></h4></td>                        
    </tr>
    <tr class="modo2">
      	<td><h4>Presión de los electores para reapertura del Centro cuando finalizó el proceso</h4></td>
        <td><h4><?php echo $totalCVLE[0] ?></h4></td>
        <td><h4><?php echo $totalCVCE[0] ?></h4></td>
        <td><h4><?php echo $totalCVBE[0] ?></h4></td>
        <td><h4><?php echo $totalCVSE[0] ?></h4></td>
        <td><h4><?php echo $totalCVEHE[0] ?></h4></td>                                
    </tr>
    <tr class="modo2">
      	<td><h4>Centro de Acopio para la Contingencia sin Inventario</h4></td>
        <td><h4><?php echo $totalCVLF[0] ?></h4></td>
        <td><h4><?php echo $totalCVCF[0] ?></h4></td>        
        <td><h4><?php echo $totalCVBF[0] ?></h4></td>
        <td><h4><?php echo $totalCVSF[0] ?></h4></td>
        <td><h4><?php echo $totalCVEHF[0] ?></h4></td>                        
    </tr>
    <tr class="modo2">
      	<td><h4>Mala Transmisión de la Contingencia</h4></td>
        <td><h4><?php echo $totalCVLG[0] ?></h4></td>
        <td><h4><?php echo $totalCVCG[0] ?></h4></td>        
        <td><h4><?php echo $totalCVBG[0] ?></h4></td>
        <td><h4><?php echo $totalCVSG[0] ?></h4></td>
        <td><h4><?php echo $totalCVEHG[0] ?></h4></td>                        
    </tr>
    <tr class="modo2">
      	<td><h4>Falla Eléctrica en el Centro de Votació</h4></td>
        <td><h4><?php echo $totalCVLH[0] ?></h4></td>
        <td><h4><?php echo $totalCVCH[0] ?></h4></td>        
        <td><h4><?php echo $totalCVBH[0] ?></h4></td>
        <td><h4><?php echo $totalCVSH[0] ?></h4></td>
        <td><h4><?php echo $totalCVEHH[0] ?></h4></td>                
    </tr>
    <tr class="modo1">
      	<td><h1>Proselitismo Político</h1></td>
        <td><h1><?php echo $totalPoliticoL[0] ?></h1></td>
        <td><h1><?php echo $totalPoliticoC[0] ?></h1></td>        
        <td><h1><?php echo $totalPoliticoB[0] ?></h1></td>
        <td><h1><?php echo $totalPoliticoS[0] ?></h1></td>
        <td><h1><?php echo $totalPoliticoEH[0] ?></h1></td>                        
    </tr>
    <tr class="modo1">
      	<td><h1>Problemas con el Elector</h1></td>
        <td><h1><?php echo $totalElectorL[0] ?></h1></td>
        <td><h1><?php echo $totalElectorC[0] ?></h1></td>
        <td><h1><?php echo $totalElectorB[0] ?></h1></td>
        <td><h1><?php echo $totalElectorS[0] ?></h1></td>
        <td><h1><?php echo $totalElectorEH[0] ?></h1></td>                                
    </tr>    
    <tr class="modo2">
      	<td><h4>El elector daña el Material Electoral</h4></td>
        <td><h4><?php echo $totalElectorLA[0] ?></h4></td>
        <td><h4><?php echo $totalElectorCA[0] ?></h4></td>
        <td><h4><?php echo $totalElectorBA[0] ?></h4></td>
        <td><h4><?php echo $totalElectorSA[0] ?></h4></td>
        <td><h4><?php echo $totalElectorEHA[0] ?></h4></td>
    </tr>    
    <tr class="modo2">
      	<td><h4>Enfrentamiento entre electores</h4></td>
        <td><h4><?php echo $totalElectorLB[0] ?></h4></td>
        <td><h4><?php echo $totalElectorCB[0] ?></h4></td>
        <td><h4><?php echo $totalElectorBB[0] ?></h4></td>
        <td><h4><?php echo $totalElectorSB[0] ?></h4></td>
        <td><h4><?php echo $totalElectorEHB[0] ?></h4></td>                        
    </tr>    
    <tr class="modo2">
      	<td><h4>Error de Selección al Votar</h4></td>
        <td><h4><?php echo $totalElectorLC[0] ?></h4></td>
        <td><h4><?php echo $totalElectorCC[0] ?></h4></td>
        <td><h4><?php echo $totalElectorBC[0] ?></h4></td>
        <td><h4><?php echo $totalElectorSC[0] ?></h4></td>
        <td><h4><?php echo $totalElectorEHC[0] ?></h4></td>                                
    </tr>            
    <tr class="modo2">
      	<td><h4>Elector daña el comprobante de Votación</h4></td>
        <td><h4><?php echo $totalElectorLD[0] ?></h4></td>
        <td><h4><?php echo $totalElectorCD[0] ?></h4></td>
        <td><h4><?php echo $totalElectorBD[0] ?></h4></td>
        <td><h4><?php echo $totalElectorSD[0] ?></h4></td>
        <td><h4><?php echo $totalElectorEHD[0] ?></h4></td>                                
    </tr>    
    <tr class="modo2">
      	<td><h4>Elector se niega a introducir comprobante de votación en la caja de resguardo</h4></td>
        <td><h4><?php echo $totalElectorLE[0] ?></h4></td>
        <td><h4><?php echo $totalElectorCE[0] ?></h4></td>        
        <td><h4><?php echo $totalElectorBE[0] ?></h4></td>
        <td><h4><?php echo $totalElectorSE[0] ?></h4></td>
        <td><h4><?php echo $totalElectorEHE[0] ?></h4></td>                        
    </tr>    
    <tr class="modo2">
      	<td><h4>Elector se niega a pasar por SAI</h4></td>
        <td><h4><?php echo $totalElectorLF[0] ?></h4></td>
        <td><h4><?php echo $totalElectorCF[0] ?></h4></td>
        <td><h4><?php echo $totalElectorBF[0] ?></h4></td>
        <td><h4><?php echo $totalElectorSF[0] ?></h4></td>
        <td><h4><?php echo $totalElectorEHF[0] ?></h4></td>                               
    </tr>    
    <tr class="modo2">
      	<td><h4>Elector quiere votar más de una vez</h4></td>
        <td><h4><?php echo $totalElectorLG[0] ?></h4></td>
        <td><h4><?php echo $totalElectorCG[0] ?></h4></td>
        <td><h4><?php echo $totalElectorBG[0] ?></h4></td>
        <td><h4><?php echo $totalElectorSG[0] ?></h4></td>
        <td><h4><?php echo $totalElectorEHG[0] ?></h4></td>                                  
    </tr>    
    <tr class="modo2">
      	<td><h4>Elector manifiesta que votaron por él</h4></td>
        <td><h4><?php echo $totalElectorLH[0] ?></h4></td>
        <td><h4><?php echo $totalElectorCH[0] ?></h4></td>
        <td><h4><?php echo $totalElectorBH[0] ?></h4></td>        
        <td><h4><?php echo $totalElectorSH[0] ?></h4></td>
        <td><h4><?php echo $totalElectorEHH[0] ?></h4></td>                
    </tr>    
    <tr class="modo2">
      	<td><h4>Enfrentamiento entre Electores y Autoridad Pública</h4></td>
        <td><h4><?php echo $totalElectorLI[0] ?></h4></td>
        <td><h4><?php echo $totalElectorCI[0] ?></h4></td>
        <td><h4><?php echo $totalElectorBI[0] ?></h4></td>
        <td><h4><?php echo $totalElectorSI[0] ?></h4></td>
        <td><h4><?php echo $totalElectorEHI[0] ?></h4></td>                                
    </tr>    
    <tr class="modo2">
      	<td><h4>Asistencia al Elector No Requerida</h4></td>
        <td><h4><?php echo $totalElectorLJ[0] ?></h4></td>
        <td><h4><?php echo $totalElectorCJ[0] ?></h4></td>
        <td><h4><?php echo $totalElectorBJ[0] ?></h4></td>
        <td><h4><?php echo $totalElectorSJ[0] ?></h4></td>
        <td><h4><?php echo $totalElectorEHJ[0] ?></h4></td>                                
    </tr>
</table>
<table>
    <tr>
    	<td><a href="javascript:window.print()">Imprimir esta página</a></td>
    	<td align="center"><a href="menu_administrador.php">Volver al Menú</a></td>
    </tr>
</table>

<?php

//Primero leemos los datos enviados por el formulario
$v1 = $totalLibertador[0];
$v2 = $totalChacao[0];
$v3 = $totalBaruta[0];
$v4 = $totalS[0];
$v5 = $totalEH[0];

//sumamos para saber cual es el total o 100%
$total = $v1+$v2+$v3+$v4+$v5;

//El valor maximo de longitud de la barra es 400
$long = 400;

//calculamos la longitud de cada valor enviado
$long_v1 = $v1 * $long / $long;
$long_v2 = $v2 * $long / $long;
$long_v3 = $v3 * $long / $long;
$long_v4 = $v4 * $long / $long;
$long_v5 = $v5 * $long / $long;

//Es hora de los porcentajes a mostrar
$por_v1 = 100 * $v1 / $total;
$por_v2 = 100 * $v2 / $total;
$por_v3 = 100 * $v3 / $total;
$por_v4 = 100 * $v4 / $total;
$por_v5 = 100 * $v5 / $total;

?>
<!--
<table>
<tr>
<td><b>Libertador</b></td>
<td>&nbsp;</td><td width="<?php echo $long_v1; ?>" bgcolor="#000066"> </td>
<td>&nbsp;<?php echo $por_v1; ?>&nbsp;(<i><?php echo $v1; ?></i>)</td>
</tr>
</table>
<table>
<tr>
<td><b>Chacao</b></td>
<td>&nbsp;</td><td width="<?php echo $long_v2; ?>" bgcolor="#CC9900"> </td>
<td>&nbsp;<?php echo $por_v2; ?>&nbsp;(<i><?php echo $v2; ?></i>)</td>
</tr>
</table>
<table>
<tr>
<td><b>Baruta</b></td>
<td>&nbsp;</td><td width="<?php echo $long_v3; ?>"  bgcolor="#006600"></td>
<td>&nbsp;<?php echo $por_v3; ?>&nbsp;(<i><?php echo $v3; ?></i>)</td>
</tr>
</table>
<table>
<tr>
<td><b>Sucre</b></td>
<td>&nbsp;</td><td width="<?php echo $long_v4; ?>"  bgcolor="#006600"></td>
<td>&nbsp;<?php echo $por_v4; ?>&nbsp;(<i><?php echo $v4; ?></i>)</td>
</tr>
</table>
<table>
<tr>
<td><b>El Hatillo</b></td>
<td>&nbsp;</td><td width="<?php echo $long_v5; ?>"  bgcolor="#006600"></td>
<td>&nbsp;<?php echo $por_v5; ?>&nbsp;(<i><?php echo $v5; ?></i>)</td>
</tr>
</table>
-->
</body>
</html>