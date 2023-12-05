<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>Consulta de Contingencia del Coordinador</title></head>
<script src="../../js/buscador_ajax_centro.js" language="javascript" type="text/javascript"></script>
<script src="../../js/sd.js" language="javascript" type="text/javascript"></script>
<body>
<?php
$img='../../vista/cne.jpg';
$img2='../../imagen/LOGO20MAYO.png';
include '../../plantilla/encabezado.php';
while ($row=$rsCont->fetch(PDO::FETCH_BOTH)){
$rowCV= consTMNac($db, $row['codigo_centro']);

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
}else{
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
?>
    <table align="center">
    <tr>
        <td colspan="3" align="center"><input type="button" class="btn btn-primary btn-flat" value="Regresar" onclick="atras()" /></td>
    </tr>
</table>
<table align="center">
    <tr>
        <td align="center"><dt>CONTINGENCIA N°</dt><dd><h2><?php echo $id; ?></h2></dd></td>
        <td align="center"><dt>MUNICIPIO</dt><dd><?php echo $rowCV['des_municipio']; ?></dd></td>
        <td align="center"><dt>PARROQUIA</dt><dd><?php echo $rowCV['des_parroquia']; ?></dd></td>
     </tr>
    <tr>
        <td align="center"><dt>CÓDIGO DEL CENTRO</dt><dd><?php echo $row['codigo_centro']; ?></dd></td>
        <td colspan="2" align="center">CENTRO DE VOTACIÓN</dt><dd><?php echo utf8_encode($rowCV['nombre']); ?></dd></td>
    </tr>
    <tr>
	<td colspan="3" align="center"><dt>DIRECCIÓN DEL CENTRO</dt><dd><?php echo utf8_encode($rowCV['direccion']); ?></dd></td>
    </tr>
    <tr>
        <td colspan="3" align="center"><h3 class="box-title">INFORMACIÓN DE LA CONTINGENCIA</h3></td>
    </tr>
    <tr>
        <td align="center"><dt>HORA DE LLAMADA</dt><dd><?php echo date("g:i a", strtotime("$row[hora_registro]"));?></dd></td>
        <td align="center"><dt>HORA DE COORDINACIÓN</dt><dd>
        <?php
        if($row['id_coordinador']==0){
            echo "Sin coordinación";
        }else{
            echo date("g:i a", strtotime("$row[hora_coordinador]"));
        }
        ?>
        </dd></td>
    </tr>
</table>
<table align="center">
    <tr>
        <td align="center"><dt><?php echo $nomSol ?></dt><dd><?php echo utf8_encode($nombre_solicitante) ?></dd><dt><?php echo $ced ?></dt><dd></dd><?php echo $cedula_solicitante; ?></dd></td>
        <td align="center"><dt><?php echo $tel ?></dt><dd><?php echo utf8_encode($telefono) ?></dd><dt><?php echo $desc ?></dt><dd><?php echo $row['ocupacion_solicitante']; ?></dd></td>
    </tr>
    <tr>
        <td colspan="3" align="center">CONTINGENCIA QUE REPORTA</td>
    </tr>
    <tr>
        <td align="center">
<?php
$db=conectar();
$cat=cont_cat($id);

if($cat[0]['cat']==0){
    echo "Otros<br/>";
}else{
    $x=0;
    for($i=0; $i<count($cat); $i++){
        $db=conectar();
		if($cat[$i]['cat']!=0){
        $c=$cat[$i]['cat'];
        $s=$cat[$i]['sub'];
        $rwCat=consCatD($db, $c);
        $rwSub=consSubD($db, $s);
        if($c!=$x){
            echo utf8_encode($rwCat->desc)."<br>";
            $x=$c;
        }
        echo utf8_encode($rwSub->desub)."<br/>";
		}
    }
}
    if ($row['descripcion_contingencia'] != ""){
?>
        <td align="center">
            <textarea name=descripcion cols=45 rows=8 class=textarea>
        <?php echo utf8_encode($row['descripcion_contingencia']); ?>
            </textarea>
        </td>
<?php
    }else{
?>
        <tr>
            <td colspan=2 align="center">Sin definir</td>
        </tr>
<?php
    }
?>
    </td>
    </tr>
</table>
<table align="center">
<?php
$rsRes=consSRes($db, $id);
$rsAC=consAsig($db, $id);
    if($rsAC->rowCount()>=1){
?>
    <table align="center">
        <tr>
            <td align="center">FUNCIONARIO</td>
            <td align="center">OFICINA</td>
        </tr>
<?php
        while($rwAC=$rsAC->fetch(PDO::FETCH_BOTH)){
            $rwF=consFunc($db, $rwAC['id_funcionario']);
?>
            <tr>
            <td align=center><?php echo utf8_encode($rwF['opcion']) ?></td>
<?php
            $rwO=consCont($db, $rwF['relacion']);
?>
            <td align="center"><?php echo utf8_encode($rwO['opcion']) ?></td>
            </tr>
<?php
        }
?>
        </table>
        <br/>
<?php       
    }else if($rsRes->rowCount()==0){
?>
        <form action="asignar_contingente.php?id_contingencia=<?php echo $id ?>" method="post">
        <table align="center">
            <tr>
                <td align="center"><?php generaPaises()?></td>
                <td align="center">
                <select disabled=disabled name=estados id=estados>
                    <option value=0>Selecciona opci&oacute;n...</option>
                </select>
                <select disabled=disabled name=estados id=estados>
                    <option value=0>Selecciona opci&oacute;n...</option>
                </select>
                <select disabled=disabled name=estados id=estados>
                    <option value=0>Selecciona opci&oacute;n...</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan=2 align=center><input type=submit value="Asignar" class="btn btn-primary btn-flat" /></td>
            <td align=center><input type="button" value='Regresar' onclick=javascript:history.back(-1) class="btn btn-primary btn-flat" /></td>
        </tr>
        </table>
        </form>
<?php
    }
?>
    <table align="center">
<?php
    if($rsRes->rowCount()>0){
        while($rwRes=$rsRes->fetch(PDO::FETCH_BOTH)){
?>
        <tr>
            <td align="center">Resultado</td>
        </tr>
        <tr>
            <td align="center"><?php echo utf8_encode($rwRes['des_res']) ?></td>
        </tr>
<?php
        }
    }
}
?>
        <tr>
            <td align="center">
                <input type='button' class="btn btn-primary btn-flat" onclick="javascript:location.href='reporte_administrador.php?id=<?php echo $id ?>';" value='Imprimir' />
            </td>
        </tr>    
        <tr>
            <td colspan="2" align="center">
                <a href=../menu/menu_administrador.php>Ir al Menú</a>
            </td>
        </tr>
    </table>
</body>
</html>
