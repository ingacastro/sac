<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Menú del Coordinador</title>
</head>
<meta content="45" http-equiv="refresh" />
<body class="hold-transition skin-blue sidebar-mini">
<div class="skin-blue">
<?php
if($_SESSION['cod_usuarioL']!=6){
    $img='../../vista/cne.jpg';
    $img2='../../imagen/LOGO20MAYO.png';
    require '../../plantilla/encabezado.php';
?>
    <section class="content">
<div class="row">
        <div class="col-xs-12">
    <div class="box">
  <?php  
}
 ?>

<div class="box-header">
<table class="table table-hover">
    <tr>
        <td colspan="8" align="center">
            <input type="button" class="btn btn-primary btn-flat" value='Ir a Contingencias Coordinadas' onclick="javascript:location.href='../consulta/contCoord.php';" class="button" />
        </td>
    </tr>
    <tr>
        <td colspan="8" align="center">
            <h3 class="box-header">Seleccione la contingencia a coordinar haciendo click en el Centro de Votación</h3>
        </td>
    </tr>
    <tr>
        <th>ÍTEM</th>
        <th>HORA DE LLAMADA</th>
        <th>OPERADOR</th>
        <th>COORDINADOR</th>
        <th>CENTRO DE VOTACIÓN</th>
        <th>DIRECCIÓN</th>
        <th>PARROQUIA</th>
        <th>MUNICIPIO</th>
        <th>ESTADO</th>
        <th>ORIGEN</th>
    </tr>
<?php
while ($row = $rsCoord->fetch(PDO::FETCH_BOTH)){
    $rowU=consUsu($db, $row['id_usuario_registro']);
    if($_SESSION['cod_usuarioL']!=6){
        $rwTM=consTM($db, $row['codigo_centro']);
    }else if($_SESSION['cod_usuarioL']==6){
        $rwTM=consTMNac($db, $row['codigo_centro']);
    }
?>
    <tr>
        <td align="center"><?php echo $row['id_contingencia'] ?></td>
        <td align="center"><?php echo date("g:i a", strtotime($row['hora_registro']))?></td>
        <td align="center"><?php echo utf8_encode($rowU['nombre_usuario'])?></td>
        <td align="center"><font color=red>Sin Coordinador</font></td>	
        <td align="center">
        <a href="../consulta/consContCoord.php?id=<?php echo $row['id_contingencia'];?>">
    <?php echo utf8_encode($rwTM['nombre']) ?>
        </a>
        </td>
        <td align="center"><?php echo utf8_encode($rwTM['direccion']) ?></td>
        <td align="center"><?php echo $rwTM['des_parroquia'] ?></td>
        <td align="center"><?php echo $rwTM['des_municipio'] ?></td>

        <td><?php echo $rwTM['des_estado'] ?></td>
        <?php
        switch($row['rds']){
            case 0:
                $org="Llamada";
                $dsc="0-800";
            break;
            case 1:
                $org="Red social";
                $dsc= utf8_encode($row['telefono_contacto']);
                break;
            case 2:
                $org="RIS";
                $dsc=$row['nombre_solicitante'];
            break;
        }
?>
        <td align="center"><?php echo $org."<br/>".$dsc?></td>
    </tr>
<?php
}
?>
</table>
</div>
</div>
</div>
</div>
</section>
</div>
</body>
</html>