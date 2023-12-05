<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Consulta de Contingencia del Coordinador</title>
</head>
<script src="../../js/buscador_ajax_centro.js" language="javascript" type="text/javascript"></script>
<script src="../../js/select_dependientes.js" language="javascript" type="text/javascript"></script>
<body  class="bg-gray-light">
<?php
$img='../../vista/cne.jpg';
$img2='../../imagen/LOGO20MAYO.png';
require '../../plantilla/encabezado.php';
?>
<section class="content">
        <div class="box">
<table align="center">
    <tr>
        <td colspan="3" align="center"><input type="button" class="button" value="Regresar" onclick="atras()" /></td>
    </tr>
</table>
    <div class="box-header">
<table align="center" width="80%">
    <tr>
        <td align="center"><dt>CONTINGENCIA N°</dt><dd><?php echo $id; ?></dd></td>
        <td align="center"><dt>ESTADO - MUNICIPIO</dt><dd><?php echo $rowCV['des_estado']."-".$rowCV['des_municipio']; ?></dd></td>
        <td align="center"><dt>PARROQUIA</dt><dd><?php echo $rowCV['des_parroquia']; ?></dd></td>
    </tr>
    <tr>
        <td align="center"><dt>CÓDIGO DEL CENTRO</dt><dd><?php echo $row['codigo_centro']; ?></dd></td>
        <td align="center"><dt>CENTRO DE VOTACIÓN</dt><dd><?php echo utf8_encode($rowCV['nombre']); ?></dd></td>
    </tr>
    <tr>
        <td align="center" colspan="3"><dt>DIRECCIÓN DEL CENTRO</dt><dd><?php echo utf8_encode($rowCV['direccion']); ?></dd></td>
    </tr>
    <tr>
        <td align="center" colspan="3"><h3 class="product-title">INFORMACIÓN DE LA CONTINGENCIA</h3></td>
    </tr>
    <tr>
        <td align="center"><dt>HORA DE LLAMADA</dt><dd><?php echo date("g:i a", strtotime("$row[hora_registro]"));?></dd></td>
        <td align="center"><dt>HORA DE COORDINACIÓN</dt>
            <dd>
<?php
    if($row['id_coordinador']==0){
?>
        Sin coordinar
<?php
    }else{
        echo date("g:i a", strtotime("$row[hora_coordinador]"));
    }
?>
            </dd>
        </td>
    </tr>
    <tr>
        <td align="center"><dt><?php echo $nomSol ?></dt><dd><?php echo utf8_encode($nombre_solicitante) ?></dd><dt><?php echo $ced ?></dt><dd></dd><?php echo $cedula_solicitante; ?></dd></td>
        <td align="center"><dt><?php echo $tel ?></dt><dd><?php echo utf8_encode($telefono) ?></dd><dt><?php echo $desc ?></dt><dd><?php echo $row['ocupacion_solicitante']; ?></dd></td>
    </tr>
    <tr>
        <td align="center" colspan="3"><h3 class="box-header">CONTINGENCIA QUE REPORTA</h3></td>
    </tr>
    <tr>
        <td align="center">
<?php
    $cat=cont_cat($id);
    if($cat==""){
        echo "otros".$cat;
    }

    $x=0;
    for($i=0; $i<count($cat); $i++){
        $c=$cat[$i]['cat'];
        $s=$cat[$i]['sub'];
        if($s!=0 && $c!=0){
            $catg=consCatD($db, $c);
            $sub=consSubD($db, $s);
            if($c!=$x){
                echo utf8_encode($catg->desc)."<br>";
                $x=$c;
            }
            echo utf8_encode($sub->desub)."<br/>";
      }
    }

    if ($row['descripcion_contingencia'] != ""){
?>
        <td  align="center"><textarea name=descripcion cols=45 rows=8 class=textarea>
        <?php echo utf8_encode($row['descripcion_contingencia']);  ?>
        </textarea>
        </td>
<?php
    }else{
?>
    <tr>
        <td align="center" colspan="3">¡Sin descripción adicional!</td>
    </tr>
<?php
    }
?>
        </td>
    </tr>
</table>
</div>
</div>
<div class="box">
<div class="box-header">
<div class="col-md-12">
<table align="center">
    <tr>
        <td align="center" colspan="3">
<?php
$rwRes=consSRes($db, $id);
if($rwRes->rowCount()==0){
?>
    En caso de solución telefónica presione aquí <input class="box-header" type=button class=button value='Solución por Teléfono' onclick="javascript:location.href='agregarResultadoC.php?id_contingencia=<?php echo $id; ?>'" />
<?php
}else if($rwRes->rowCount()>0){
    ?>
    Resultado:<br/>
    <?php
    $res=consultarRes($db, $id);
    if($res){
        $catRes=cont_catRes($db, $id);
        $x=0;
        for($i=0; $i<count($catRes); $i++){
            $c=$catRes[$i]['cat'];
            $s=$catRes[$i]['sub'];
            $qCat="select * from categoria where idcategoria=$c";
            $rsCat=$db->query($qCat);
            $rwCat=$rsCat->fetch(PDO::FETCH_BOTH);
            $qSub="select * from subcategoria where cat=$c and sub=$s";
            $rsSub=$db->query($qSub);
            $rwSub=$rsSub->fetch(PDO::FETCH_BOTH);
            if($c!=$x){
                $x=$c;
            }
            echo $rwSub['desub']."<br/>";
        }
    echo conDesRes($db, $id)."<br/>";
    }
}
?>
        </td>
    </tr>
</table>

<?php
$rsAC= consAsig($db, $id);
    if($rsAC->rowCount()>=1){
?>
<table align="center">
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
?>
<br/>
<?php
    }else if($rsAC->rowCount()==0 && $rwRes->rowCount()==0   && $_SESSION['cod_usuarioL']!=6){

        $rsAC=consAsig($db, $id);
        if($rsAC->rowCount()>=1){
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
<?php
        }
?>
        </tr>
    </table>
</div>
</div>
</div>
    <?php
        }else{
?>
<div class="form-group" align="center">
<div class="box">
<div class="box box-primary">
<form role="form" action="../../controlador/coord/asignar_contingente.php?id=<?php echo $id ?>" method="post">
    <table align="center">
    <tr>
        <td align="center" class="active"><label>SELECCIONE UN EMCE</label></td>
    </tr>
    <div class="form-group">
    <tr>
        <td align="center" colspan="2"><?php generaPaises() ?></td>
    </tr>
        </div>
    <div class="form-group">
    <tr>
    <td align="center" colspan="2">
        <select disabled="disabled" class="form-control" name="estados" id="estados">
            <option value=0>Selecciona opci&oacute;n...</option>
        </select>
        <select disabled="disabled" class="form-control" name="estados" id="estados">
            <option value=0>Selecciona opci&oacute;n...</option>
        </select>
        <select class="form-control" disabled="disabled" name="estados" id="estados">
            <option value=0>Selecciona opci&oacute;n...</option>
        </select>
        </td>
    </tr>
        </div>
    <tr>
        <td align="center">VPN</td>
    </tr>
    <tr>
        <td align="center">
        <select class="form-control" name="vpn" id="vpn">
            <option value="0">Seleccione VPN...</option>
<?php
        $qvpn="select * from vpn";
        $rsvpn=$db->query($qvpn);
        while($rwvpn=$rsvpn->fetch(PDO::FETCH_BOTH)){
           echo "<option value=$rwvpn[idvpn]>$rwvpn[vpn]</option>";
        }
?>
        </select>
        </td>
    </tr>
    <div class="box-footer">
    <tr>
        <td class="box-footer" align="center"><input type=submit value=Asignar class=button /></td>
        <td class="box-footer" align="center"><input type=button value='Regresar' onclick="javascript:history.back(-1)" class=button /></td>
    </tr>
    </div>
    </table>
</form>
</div>
</div>
</div>
    <?php
        }
    }
?>
<table align="center">
    <tr>
        <td align="center" class="box-footer">
    <input type='button' class='button' onclick=javascript:location.href='../coord/reporte_coordinador.php?id=<?php echo $id ?>'; value='Imprimir' />
    </td>
    <td align="center" class="box-footer">
<?php
if($_SESSION['cod_usuarioL']==6){
?>
        <a href=../menu/menu_operador.php>Ir al Menú</a>            
<?php
}else{
?>
        <a href=../menu/menu_coordinador.php>Ir al Menú</a>
        </td>
<?php
}
?>
    </tr>
</table>
    </section>
</body>
</html>