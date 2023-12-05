<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Contingencia Registrada</title>
</head>
<body class="hold-transition skin-blue sidebar"  >
<?php
$img='../../vista/cne.jpg';
$img2='../../imagen/LOGO20MAYO.png';
require '../../plantilla/encabezado.php';
?>
<table align="center" width="80%">
<?php
while ($row = $rs->fetch(PDO::FETCH_BOTH)){
?>
    <tr>
        <td align="center"><dt>ESTADO</dt><dd><?php echo $row['des_estado']; ?></dd></td>
        <td align="center"><dt>MUNICIPIO</dt><dd><?php echo $row['des_municipio']; ?></dd></td>
        <td align="center"><dt>PARROQUIA</dt><dd><?php echo $row['des_parroquia']; ?></dd></td>
    </tr>
    <tr>
        <td align="center"><dt>CÓDIGO DEL CENTRO</dt><dd><?php echo $row['codigo'] ?></dd></td>
        <td align="center"><dt>CENTRO DE VOTACIÓN</dt><dd><?php echo utf8_encode($row['nombre']) ?></dd></td>
        <td align="center"><dt>HORA DE LLAMADA</dt><dd><?php echo date("g:i a", strtotime($_POST['hora_llamada'])) ?></dd></td>
    </tr>
    <tr>
       	<td colspan="3" align="center"><dt>DIRECCIÓN DEL CENTRO</dt><dd><?php echo utf8_encode($row['direccion']); ?></dd></td>
    </tr>
    <div class="box-header">
    <tr>
        <td colspan="3" align="center"><h3 class="box-title">INFORMACIÓN DE LA CONTINGENCIA</h3></td>
    </tr>
    </div>
    <div class="box">
    <div class="form-group">
    <div class="col-xs-5">
    <tr>
        <td align="center"><label><?php echo $nomSol ?></label><br /><?php echo $_POST['nombre_solicitante'] ?></td>
        <td align="center"><label><?php echo $ced ?><br /><?php echo $_POST['cedula_solicitante'] ?></td>
    </tr>
    <tr>
        <td align="center"><label><?php echo $tel ?></label><br /><?php echo $_POST['telefono']; ?></td>
        <td align="center"><label><?php echo $desc ?></label><br /><?php echo $_POST['descripcion_solicitante']; ?></td>
    </tr>
    </div>
    </div>
    </div>
</table>
<table align="center">
    <tr>
        <div class="box-header with-border">
        <td align="center">CONTINGENCIA QUE REPORTA</td>
        <td align="center">DESCRIPCIÓN DE LA SITUACIÓN</td>
        </div>
    </tr>
    <tr>
        <td align="center">
<?php
$x=0;
    if((isset($catg) && $catg!=0) && isset($subCatg) && $subCatg!=0){
        for($i=0; $i<count($catg); $i++){
        $cat=consCatD($db, $catg[$i]->id);
        $sub=consSubD($db, $subCatg[$i]->idsubcat);
        if($catg!=$x){
            echo utf8_encode($cat->desc)."<br>";
            $x=$c;
        }
        echo utf8_encode($sub->desub)."<br/>";

        }
    }
}
?>
        </td>
        <td align="center">
            <textarea name=descripcion cols="45" rows="15" class=textarea disabled=disabled><?php echo $_POST['descripcion_contingencia'] ?></textarea>
        </td>
    </tr>
    <tr>
        <td align="center">Hora de Registro<?php echo date("g:i a", strtotime($horaReg)); ?></td>
    </tr>
    <tr>
        <td align="center"><input type="button" class="button" value="Registrar Otro" onclick="javascript:location.href='busqueda_centro.php';" /></td>
        <td align="center"><input type="button" class="button" value="Menú" onclick="javascript:location.href='../menu/menu_operador.php';" /></td>
    </tr>
</table>
</body>
</html>