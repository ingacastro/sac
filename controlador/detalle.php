<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>Ordenar</title>
<link rel="stylesheet" type="text/css" href="../css/estilos.css"></link>
<script src="../buscador_ajax_centro.js" language="javascript" type="text/javascript"></script>
</head>

<body>
<?php
include ('../modelo/config.php');
include ("login.php");
$img='../vista/cne.jpg';
$db=conectar();
require '../plantilla/encabezado.php';
?>
<input type="button" name="" value="Regresar" onclick="atras()" class="button" />
<?php
foreach ($_GET as $key => $value){
    switch($key){
        case 'cat':
        echo "<table class=tablaR>";
            echo "<tr>";
                echo "<td>";
                $qCat="select * from categoria where cat=$value";
                $resCat=mysql_query($qCat);
                $rowCat=mysql_fetch_array($resCat);
                echo "Categoría<br>".utf8_encode($rowCat['des']);
                echo "</td>";
            echo "</tr>";
        echo "</table>";
        switch($value){
            case 1:
                $query1="select * from contingencia where sai!=0";
            break;
            case 2:
                $query1="select * from contingencia where acredita!=0";
            break;
            case 3:
                $query1="select * from contingencia where maquina!=0";
            break;
            case 4:
                $query1="select * from contingencia where material!=0";
            break;
            case 5:
                $query1="select * from contingencia where miembro!=0";
            break;
            case 6:
                $query1="select * from contingencia where conato!=0";
            break;
            case 7:
                $query1="select * from contingencia where centrovotacion!=0";
            break;
            case 8:
                $query1="select * from contingencia where politico!=0";
            break;
            case 9:
                $query1="select * from contingencia where elector!=0";
            break;
            case 10:
                $query1="select * from contingencia where membrana!=0";
            break;

        }
        break;
		
        case 'cv':
            $qCV="select * from tabla_mesa where codigo=$value";
            $resCV=$db->query($qCV);
            $rowCV=$resCV->fetch(PDO::FETCH_BOTH);
            echo "Centro de Votación<br>".utf8_encode($rowCV['nombre']);
            $query1="select * from contingencia where codigo_centro=$value";
        break;

        case 'hora':
            $hora=$value;
            $hora1=date("H:i:s", strtotime($value));
            $horaAd=$hora1+1;
            echo "Contingencias solicitadas a la(s) $value";
            $query1="select * from contingencia where hora between '$hora1' and '$horaAd:00:00'";
        break;

        case 'mun':
            $mun=$_GET['mun'];
            $parr=$_GET['parr'];
            $edo=$_GET['edo'];
            $query1="select * from contingencia where cod_estado=$edo and cod_municipio=$mun and cod_parroquia=$parr";
            echo "Municipio y Parroquia";
        break;

	}
	
	echo "<table class=tablaR>";
            echo "<tr>";
                echo "<td>Ítem</td>";
                echo "<td>Centro de Votación</td>";
                echo "<td>Descripción</td>";
                echo "<td>Subcategoría</td>";
                echo "<td>Resultado</td>";
                echo "<td>Solucionado por</td>";
                echo "<td>Hora de Llamada</td>";
                echo "<td>Hora de Coordinación</td>";
                echo "<td>Hora de Asignación</td>";
                echo "<td>Hora de Resultado</td>";
                echo "<td>Parroquia</td>";
                echo "<td>Municipio</td>";
                echo "<td>Estado</td>";
            echo "</tr>";
	$res1=$db->query($query1);
	while($row1=$res1->fetch(PDO::FETCH_BOTH)){
            echo "<tr>";
            echo "<td>$row1[id_contingencia]</td>";
            $qryCV="select * from tabla_mesa where codigo=$row1[codigo_centro]";
            $respCV=$db->query($qryCV);
            $rowNCV=$respCV->fetch(PDO::FETCH_BOTH);
            echo "<td>".utf8_encode($rowNCV['nombre'])."</td>";
            echo "<td>".utf8_encode($row1['descripcion_contingencia'])."</td>";
            echo "<td>";						
            
            echo "</td>";
//            echo "<td>".utf8_encode($row1['resultado'])."</td>";
//            if($row1['resultadoC']!=1){
//                $qFunc="select * from contingencia where id_contingencia=$row1[id_contingencia]";
//                $resF=mysql_query($qFunc);
//                $rowF=mysql_fetch_array($resF);
//                $qUnd= "select F.ID, F.relacion, C.id, C.opcion from funcionario F, contingente C where F.relacion=C.id and F.ID=$rowF[funcionario]";
//                $resUnd=mysql_query($qUnd);
//                $rowUnd=mysql_fetch_array($resUnd);
//                echo "<td>".utf8_encode($rowUnd['opcion'])."</td>";
//            }else{
//                echo "<td>Coordinador</td>";
//            }

//            echo "<td>".date("g:i a", strtotime($row1['hora_registro']))."</td>";
//            if($row1['hora_coordinador']!='00:00:00'){echo "<td>".date("g:i a", strtotime($row1['hora_coordinador']))."</td>";}else{echo "<td></td>";}
//            if($row1['hora_asignacion']!='00:00:00'){echo "<td>".date("g:i a", strtotime($row1['hora_asignacion']))."</td>";}else{echo "<td></td>";}
//            if($row1['hora_resultado']!='00:00:00'){echo "<td>".date("g:i a", strtotime($row1['hora_resultado']))."</td>";}else{echo "<td></td>";}

            $qParr="select * from tabla_mesa where codigo=$row1[codigo_centro]";
            $resParr=$db->query($qParr);
            $rowParr=$resParr->fetch(PDO::FETCH_BOTH);

            echo "<td>$rowParr[des_parroquia]</td>";
            echo "<td>$rowParr[des_municipio]</td>";
            echo "<td>$rowParr[des_estado]</td>";
        echo "</tr>";
	}
	echo "</table>";
}
?>
</body>
</html>