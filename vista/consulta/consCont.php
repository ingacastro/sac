<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>Consulta de Contingencia de Operador</title>
</head>
<script src="../../js/bac.js" language="javascript" type="text/javascript"></script>
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
        <td colspan="3" align="center"><input type="button" class="btn btn-primary btn-flat" value="Regresar" onclick="atras()" /></td>
    </tr>
</table>
<?php
while ($row=$rsCont->fetch(PDO::FETCH_BOTH)){
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
    }else if($row['rds']==2){
        $nomSol="RIS";
        $nombre_solicitante=$row['nombre_solicitante'];
        $ced="";
        if($row['cedula_solicitante']==""){
            $cedula_solicitante="";
        }else{
            $cedula_solicitante="<a href='https://".$row['cedula_solicitante']."'>".$row['cedula_solicitante']."</a>";
        }
        $tel="";
        $telefono="";
        $desc="";
        $rds=2;
    }else if($row['rds']==0){
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
<table>
   <tr>
<?php
    $rsCV= consTM2($db, $row['codigo_centro']);
    $rwCV=$rsCV->fetch(PDO::FETCH_BOTH);
?>
       <td align="center"><dt>ESTADO</dt><dd><?php echo $rwCV['des_estado']; ?></dd></td>
	<td align="center"><dt>MUNICIPIO</dt><dd><?php echo $rwCV['des_municipio']; ?></dd></td>
	<td align="center"><dt>PARROQUIA</dt><dd><?php echo $rwCV['des_parroquia']; ?></dd></td>
    </tr>
    <tr>
       	<td align="center"><dt>CÓDIGO DEL CENTRO</dt><dd><?php echo $rwCV['codigo']; ?></dd></td>
        <td align="center"><dt>CENTRO DE VOTACIÓN</dt><dd><?php echo utf8_encode($rwCV['nombre']); ?></dd></td>
        <td align="center"><dt>HORA DEL REGISTRO</dt><dd><?php echo date("h:m a",strtotime($row['hora_registro']));?></dd></td>
    </tr>
    <tr>
    	<td colspan="3" align="center">DIRECCIÓN DEL CENTRO<?php echo "<h3>".utf8_encode($rwCV['direccion'])."</h3>"; ?></td>
    </tr>
</table>
<table align="center">
    <div class="box-header">
    <tr>
        <td colspan="3" align="center"><h3 class="box-title">INFORMACIÓN DE LA CONTINGENCIA</h3></td>
    </tr>
    </div>
    <tr>
        <td align="center"><dt><?php echo $nomSol ?></dt><dd><?php echo utf8_encode($nombre_solicitante) ?></dd><dt><?php echo $ced ?></dt><dd></dd><?php echo $cedula_solicitante; ?></dd></td>
        <td align="center"><dt><?php echo $tel ?></dt><dd><?php echo utf8_encode($telefono) ?></dd><dt><?php echo $desc ?></dt><dd><?php echo $row['ocupacion_solicitante']; ?></dd></td>
    </tr>
    <tr>
    	<td align="center"><label><?php echo $tel ?></label><br />
            <?php
            
            echo utf8_encode($row['telefono_contacto']) 
            ?>
        </td>
        <td align="center"><label><?php echo $desc ?></label><br /><?php echo $row['ocupacion_solicitante'] ?></td>
    </tr>
    <tr>
        <div class="box-header with-border">
        <td align="center">CONTINGENCIA QUE REPORTA</td>
        <td align="center">DESCRIPCIÓN DE LA SITUACIÓN</td>
        </div>
    </tr>
    <tr>
	<td align="center">
<?php
if($cat[0]['cat']==0){
    echo "Otros<br/>";
}else{
    
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
}
?>
        </td>
        <td align="center">
    <?php
    if($row['descripcion_contingencia']==""){
        echo "Sin detalles.";
    }else{
    ?>
    <textarea name="descripcion" cols="45" rows="15" class="textarea" disabled="disabled" >
        <?php echo utf8_encode($row['descripcion_contingencia']); ?>
    </textarea>
<?php
    }
}
?>	
        </td>
    </tr>
    <tr>
        <td align="center"><a href="../menu/menu_operador.php">Ir al Menú</a></td>
        <td align="center"><input type="button" name="modificar" value="Atrás" class="btn btn-primary btn-flat" onclick="atras()" /></td>
    </tr>
</table>
</div>
</section>
</body>
</html>
