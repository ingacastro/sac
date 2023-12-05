<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Registrar Contingencia</title>
</head>
<script src="../../js/bac.js" language="javascript" type="text/javascript"></script>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$img='../../vista/cne.jpg';
$img2='../../imagen/LOGO20MAYO.png';
require '../../plantilla/encabezado.php';
?>
<form action="insertar_contingencia.php" method="post">
<table align="center">
    <tr>
        <td align="center"><dt>ESTADO</dt><dd><?php echo $_POST['des_estado']; ?></dd></td>
     	<td align="center"><dt>MUNICIPIO</dt><dd><?php echo $_POST['des_municipio']; ?></dd></td>
      	<td align="center"><dt>PARROQUIA</dt><dd><?php echo $_POST['des_parroquia']; ?></dd></td>
    </tr>
    <tr>
    	<td align="center"><dt>CÓDIGO DEL CENTRO</dt><dd><?php echo $_POST['codigo']; ?></dd></td>
        <td align="center"><dt>CENTRO DE VOTACIÓN</dt><dd><?php echo $_POST['nombre']; ?></dd></td>
        <td align="center"><dt>HORA DE LLAMADA</dt><dd><?php echo date("g:i a", strtotime($_POST['hora_llamada'])) ?></dd></td>
    </tr>
    <tr>
        <td colspan=3 align="center"><dt>DIRECCIÓN DEL CENTRO</dt><dd><?php echo $_POST['direccion']; ?></dd></td>
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
    	<td align="center"><label><?php echo $nomSol ?></label><br /><?php echo $nombre_solicitante ?></td>
        <td colspan="2" align="center"><label><?php echo $ced ?></label><br /><?php echo $cedula_solicitante ?></td>
    </tr>
    <tr>
    	<td align="center"><label><?php echo $tel ?></label><br /><?php echo $telefono ?></td>
        <td align="center"><label><?php echo $desc ?></label><br /><?php echo $descripcionSolicitante; ?></td>
    </tr>
    </div>
    </div>
    </div>
</table>
<input type="hidden" name="cod_estado" value="<?php echo $_POST['cod_estado']; ?>" />
<input type="hidden" name="cod_municipio" value="<?php echo $_POST['cod_municipio'] ?>"  />
<input type="hidden" name="cod_parroquia" value="<?php echo $_POST['cod_parroquia'] ?>" />
<input type="hidden" name="codigo" value="<?php echo $_POST['codigo'] ?>" />
<input type="hidden" name="hora_llamada" value="<?php echo $_POST['hora_llamada']; ?>" />
<input type="hidden" name="hora_registro" value="<?php echo $_POST['hora_registro']; ?>" />
<input type="hidden" name="nombre_solicitante" value="<?php echo $nombre_solicitante ?>"  />
<input type="hidden" name="telefono" value="<?php echo $telefono; ?>" />
<input type="hidden" name="cedula_solicitante" value="<?php echo $cedula_solicitante ?>"  />
<input type="hidden" name="descripcion_solicitante" value="<?php echo $descripcionSolicitante ?>" />
<table align="center">
    <div class="box-header with-border">
    <tr>
        <td align="center"><h5 class="box-title">CONTINGENCIA QUE REPORTA</h3></td>
        <td align="center"><h5 class="box-title">DESCRIPCIÓN DE LA SITUACIÓN</h3></td>
    </tr>
    </div>
    <tr>
        <td>    
<?php
if(isset($catg)){
    for($i=0; $i<count($catg); $i++){
        echo utf8_encode($catg[$i]->desc)."<br/>";
    }
}
?>
        </td>
        <td>
<?php
if(isset($subCatg)){
    for($j=0; $j<count($subCatg); $j++){
        echo utf8_encode($subCatg[$j]->desub)."<br/>";
    }
}
if($_POST['descripcion']==""){
    echo"<input name=descripcion_contingencia type=hidden value='$_POST[descripcion]' />";
 }else{
    if(!isset($_POST['registrar'])){
        echo "<textarea name=descripcion_contingencia cols=60 rows=10 class=textarea>";
    }else if(isset($_POST['registrar'])){
        echo "<textarea name=descripcion cols=55 rows=15 class=textarea disabled=disabled>";
    }
  
    echo "$_POST[descripcion]"
    . "</textarea>";
}
?>
        </td>
    </tr>
    <?php
    if(!isset($_POST['registrar'])){
    ?>
    <tr>
    	<td colspan="2" align="center"><h1>¿Desea Registrar esta Contingencia?</h1><br />
        <input type="submit" name="registrar" value="Sí" class="btn btn-primary btn-flat" />
        <input type="button" name="modificar" value="No" onclick="atras()" class="btn btn-primary btn-flat" />
        <input type="button" name="menu" value="Menú" class="btn btn-primary btn-flat" onclick="javascript:location.href='../menu/menu_operador.php';"  />
	</td>
    </tr>
    <?php
    }else if(isset($_POST['registrar'])){
        echo "insertar contingencia";
    }

    ?>
</table>
<input type="hidden" name="rds" value="<?php echo $rs ?>" />
</form>
</body>
</html>