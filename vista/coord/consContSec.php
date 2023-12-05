<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>Consulta de Contingencia</title>
</head>
    <script src="../buscador_ajax_centro.js" language="javascript" type="text/javascript"></script>
<body class="bg-gray-light">
<?php
$img='../../vista/cne.jpg';
$img2='../../imagen/LOGO20MAYO.png';
require '../../plantilla/encabezado.php';
?>
<div class="box-body">
<form name="resultado" action="../coord/ingresarResultado.php?id_contingencia=<?php echo $_GET['id_contingencia']; ?>&id_resultado=<?php echo $_SESSION['idUsuarioL'] ?>" method="post" >
<table width="80%" align="center">
    <tr>
        <td align="center"><dt>ESTADO</dt><dd><?php echo $rowCV['des_estado']; ?></dd></td>
        <td align="center"><dt>MUNICIPIO</dt><dd><?php echo $rowCV['des_municipio']; ?></dd></td>
        <td align="center"><dt>PARROQUIA</dt><dd><?php echo $rowCV['des_parroquia']; ?></dd></td>
    </tr>
    <tr>
        <td align="center"><dt>CÓDIGO DEL CENTRO</dt><dd><?php echo $row['codigo_centro']; ?></dd></td>
        <td align="center" colspan="2"><dt>CENTRO DE VOTACIÓN</dt><dd><?php echo utf8_encode($rowCV['nombre']) ?></dd></td>
    </tr>
    <tr>
        <td align="center" colspan="3"><dt>DIRECCIÓN DEL CENTRO</dt><dd><?php echo utf8_encode($rowCV['direccion']); ?></dd></td>
    </tr>
    <tr>
        <td colspan="3" align="center"><h3 class="product-title">INFORMACIÓN DE LA CONTINGENCIA</h3></td>
    </tr>
    <tr>
        <td align="center"><dt>HORA DE LLAMADA</dt><dd><?php echo date("g:i a", strtotime($row['hora_registro']));?></dd></td>
        <td align="center"><dt>COORDINACIÓN</dt><dd><?php echo $coord['nombre_usuario']."<br/>".date("g:i a", strtotime($row['hora_coordinador']));?></dd></td>
<?php
$rsAC=consAsig($db, $_GET['id_contingencia']);
if($rsAC->rowCount()>0){
    $rwAC=$rsAC->fetch(PDO::FETCH_BOTH);
?>
        <td align="center"><dt>HORA DE ASIGNACIÓN</dt><dd><?php echo date("g:i a", strtotime($rwAC['hora_asignacion']))?></dd></td>
<?php
}else{
?>
        <td align="center"><dt>HORA DE ASIGNACIÓN</dt><dd>Sin asignar</dd></td>
<?php
}
?>
    </tr>
    <tr>
        <td align="center"><dt>Nombre del solicitante/Cédula</dt><dd><?php echo utf8_encode($row['nombre_solicitante'])."/".$row['cedula_solicitante'] ?></dd></td>
       	<td align="center"><dt>Teléfono--Ocupación</dt><dd><?php echo utf8_encode($row['telefono_contacto'])."--".$row['ocupacion_solicitante'] ?></dd></td>
    </tr>
    <tr>
        <td align="center" colspan="3"><h3 class="product-info">CONTINGENCIA QUE REPORTA</h3></td>
    </tr>
    <tr>
        <td align="center">
<?php

if($cat[0]['cat']==0){
    echo "OTROS<br/>";
}else{
    $x=0;
    for($i=0; $i<count($cat); $i++){
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
?>
        </td>
        <td colspan=2 align="center" >
            <textarea disabled="disabled" name="descripcion" cols="65" rows="8" class="textarea">
<?php
if ($row['descripcion_contingencia'] != ""){
    echo utf8_encode($row['descripcion_contingencia']);    
}else{
?>
        Sin definir
<?php
}
?>
            </textarea>	
        </td>
    </tr>
<?php
if($rsAC->rowCount()>=1){
?>
    <tr>
        <td align="center"><dt>FUNCIONARIO</dt></td>
        <td align="center"><dt>OFICINA</dt></td>
    </tr>
<?php
    while($rwAC=$rsAC->fetch(PDO::FETCH_BOTH)){
        $rwF=consFunc($db, $rwAC['id_funcionario']);
        $rwO=consCont($db, $rwF['relacion']);
        $vpn=consVPN($db, $rwAC['idvpn']);
?>
    <tr>
        <td align="center"><?php echo utf8_encode($rwF['opcion'])?></td>
        <td align="center"><?php echo utf8_encode($rwO['opcion'])?></td>
        <td align="center"><?php echo utf8_encode($vpn['vpn'])?></td>
    </tr>
<?php   
    }
}else if($rsAC->rowCount()==0 && $_SESSION['cod_usuarioL']!=6){
?>
    <tr>
        <td align="center">FUNCIONARIO</td>
        <td align="center">OFICINA</td>
    </tr>
<?php
    while($rwAC=$rsAC->fetch(PDO::FETCH_BOTH)){
        $rwF=consFunc($db, $rwAC['id_funcionario']);
        $rwO=consCont($db, $rwF['relacion']);
?>
    <tr>
        <td align="center"><?php echo utf8_encode($rwF['opcion']) ?></td>
        <td align="center"><?php echo utf8_encode($rwO['opcion']) ?></td>
    </tr>
<?php
    }
}
?>
    <tr>
        <td colspan="3" align="center"><h3 class="product-info">CONTINGENCIA SEGÚN RESULTADO</h3></td>
    </tr>
<?php
$res=consultarRes($db, $_GET['id_contingencia']);
if($res){
?>
    <tr>
        <td align="center">
<?php
    $catRes=cont_catRes($db, $_GET['id_contingencia']);
    $x=0;

    for($i=0; $i<count($catRes); $i++){
        $c=$catRes[$i]['cat'];
        $s=$catRes[$i]['sub'];
        $rwCat=consCatg($db, $c);
        $rsSub=consSubCat($db, $s);
        if($c!=$x){
            echo utf8_encode($rwCat['descripcion_cat'])."<br>";
            $x=$c;
        }
        echo utf8_encode($rsSub['desub'])."<br/>";
    }
?>
        </td>
        <td align="center"><?php echo conDesRes($db, $id_contingencia) ?></td>
    </tr>
<?php
}else{
    $cat=consCat($db);
    $f='<tr>';
    $cf='</tr>';
    $c='<td>';
    $cc='</td>';
    $n=0;
    for($i=1; $i<count($cat); $i++){
        if($n==0){
            echo $f;
        }
        echo $c.utf8_encode($cat[$i]->desc)."<br/>";
        $subCat= consSub($db, $cat[$i]->id);
?>
        <select class="form-control" name="categ[]" id="" class="select" onchange="">
            <option value="0">Seleccione...</option>
<?php
        for($j=0; $j<count($subCat); $j++){
?>
            <option value="<?php echo $subCat[$j]->idsubcat?>"><?php echo utf8_encode($subCat[$j]->desub) ?></option>
<?php
        }
?>    
        </select>
<?php
        if($n==1){
            echo $cf;
            $n=0;
        }else{
            $n++;
        }
        echo $cc;
    }
?>
        <tr>
        <td colspan="2" align="center">Resultado:<br/>
            <textarea name="res" id="res" cols="100" rows="10" class="textarea" style="visibility:visible;" ></textarea>
        </td>
    </tr>
<?php  
}
?>
    <tr>
    	<td align="center"><input type="button" class="button" value="Imprimir" onclick="javascript:location.href='reporte_secretario.php?id=<?php echo $_GET['id_contingencia'] ?>';" /></td>
<?php
if(!$res){
?>
        <td align="center"><input type="submit" class="button" value="Ingresar Resultado" /></td>
<?php
}
?>  
        <td align="center"><a href="../../controlador/menu/menu_secretario.php">Ir a Menú</a></td>
    </tr>
</table>
</form>
</div>
</body>
</html>