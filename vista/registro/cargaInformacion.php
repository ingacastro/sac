<head>
  <title>Registro de Contingencia</title>
  <script src="../../js/bac.js" language="javascript" type="text/javascript"></script>
  <script src="../../js/acciones.js" language="javascript" type="text/javascript"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php 
$img='../../vista/cne.jpg';
$img2='../../imagen/LOGO20MAYO.png';
include '../../plantilla/encabezado.php';
if ($rsC->rowCount()>=1){
    $rowC=$rsC->fetch(PDO::FETCH_BOTH);
    $rowUsu=consUsu($db, $rowC['id_usuario_registro']);
?>
<table align="center" width="80%">
    <script>
        var similar='¡Existe un registro similar a este!';
        alert(similar);
    </script>
    <tr>
        <td colspan="3" align="center">
            <font color="#0000FF" size="+2">
                <blink>Existe una contingencia registrada para este Centro de Votación por: <?php echo utf8_encode($rowUsu['nombre_usuario']) ?> a las <?php echo date('g:i a', strtotime($rowC['hora_registro'])) ?></blink>
            </font>
        </td>	
    </tr>
</table>
<?php
}
?>
<div class="row">
<div class="col-xs-12">
<form role="form" action="registrar_contingencia.php" name="buscar_por_centro" method="post" >
<table align="center" width="80%">
    <tr>
        <td align="center"><dt>ESTADO</dt><dd><?php echo $row['des_estado']; ?></dd></td>
        <td align="center"><dt>MUNICIPIO</dt><dd><?php echo utf8_encode($row['des_municipio']); ?></dd></td>
        <td align="center"><dt>PARROQUIA</dt><dd><?php echo utf8_encode($row['des_parroquia']); ?></dd></td>
    </tr>
    <tr>
       	<td align="center"><dt>CÓDIGO DEL CENTRO</dt><dd><?php echo $row['codigo']; ?></dd></td>
        <td align="center"><dt>CENTRO DE VOTACIÓN</dt><dd><?php echo utf8_encode($row['nombre']); ?></dd></td>
        <td align="center"><dt>HORA DE LA LLAMADA</dt><dd><?php echo date("g:i a", strtotime($hora_llamada)); ?></dd></td>
    </tr>
    <tr>
       	<td colspan="3" align="center"><dt>DIRECCIÓN DEL CENTRO</dt><dd><?php echo utf8_encode($row['direccion']); ?></dd></td>
    </tr>
</table>
<div class="box-header">
    <div class="box">
<table align="center" width="80%">
    <tr>
        <td>
            <input type="radio" value="0" name="tipo" checked="checked" onclick="ocuMos('lla')"/>Llamada
            <input type="radio" value="1" name="tipo" onclick="ocuMos('red')"/>Red Social
            <input type="radio" value="2" name="tipo" onclick="ocuMos('ris')"/>RIS
        </td>
    </tr>
     <tr>
        <td colspan="3" align="center"><h3 class="box-title">INFORMACIÓN DE LA CONTINGENCIA</h3></td>
    </tr>
    </table>
 <div id="lla">
<table align="center" width="80%">
    <tr>
        <div class="form-group">
        <div class="col-xs-5">
        <td align="center">
            <label>Nombre del solicitante</label><br />
            <input name="nombre_solicitante" type="text"  maxlength="100" class="form-control" />
        </td>
        <td align="center">
            <label>Cédula</label><br />
            <input class="form-control" name="cedula_solicitante" type="text"  maxlength="8"/>
        </td>
        </div>
        </div>
    </tr>
    <tr>
        <td align="center"><label>Teléfono</label>
        <div class="form-group">
        <div class="col-xs-3">
            <select class="form-control" name="cod_tlf_solicitante" type="text">
                <option>0416</option>
                <option selected="selected">0426</option>
                <option>0414</option>
                <option>0424</option>
                <option>0412</option>
                <option>0212</option>
            </select>
       </div>
        <div class="col-xs-5">
            <input name="telefono_solicitante" type="text" class="input" size="16" maxlength="8" />
        </div>
        </div>
        </td>
        <td>
            <label>Descripción del Solicitante</label>
            <div class="form-group">
                <input name="ocupacion_solicitante" type="text" class="input" size="25" maxlength="200" />
            </div>
        </td>
        </div>
        <input type="hidden" name="hora_registro" value="<?php echo $hora_registro?>" />
        <input type="hidden" name="hora_llamada" value="<?php echo $hora_llamada?>" />
    </tr>
</table>
</div>
<div id="red" style="display: none">
<table align="center" width="80%">
    <tr>
        <div class="form-group">
        <div class="col-xs-5">
        <td align="center">
            <label>Usuario de Red Social</label><br />
            <input name="usuario" type="text"  maxlength="200" class="form-control" />
        </td>
        <td align="center">
            <label>URL</label><br />
            <input class="form-control" name="url" type="text"  maxlength="200"/>
        </td>
        </div>
        </div>
    </tr>
    <tr>
        <td align="center" colspan="2">
            <label>Red Social</label>
            <div class="form-group">
            <div class="col-xs-3">
                <select class="form-control" name="redSocial" type="text">
                    <option selected="selected">Twitter</option>
                    <option>Facebook</option>
                    <option>Instagram</option>
                    <option>Página Web</option>
                    <option>Whatsapp</option>
                    <option>Televisión</option>
                </select>
           </div>
           </div>
        </td>
        <input type="hidden" name="hora_registro" value="<?php echo $hora_registro?>" />
        <input type="hidden" name="hora_llamada" value="<?php echo $hora_llamada?>" />
    </tr>
</table>
    </div>
    <div id="ris" style="display: none">
        <table align="center" width="80%">
        <tr>
        <div class="form-group">
        <div class="col-xs-5">
        <td align="center">
            <label>RIS</label><br />
            <input name="nombre_ris" type="text"  maxlength="100" class="form-control" />
        </td>
        </div>
        </div>
        </tr>
            <tr>
        <td align="center"><label>Teléfono</label>
        <div class="form-group">
        <div class="col-xs-3">
            <select class="form-control" name="cod_tlf_ris" type="text">
                <option>0416</option>
                <option selected="selected">0426</option>
                <option>0414</option>
                <option>0424</option>
                <option>0412</option>
                <option>0212</option>
            </select>
       </div>
        <div class="col-xs-5">
            <input name="telefono_ris" type="text" class="input" size="16" maxlength="8" />
        </div>
        </div>
        </td>
        <td>
            <label>Descripción del RIS</label>
            <div class="form-group">
                <input name="desc_ris" type="text" class="input" size="25" maxlength="200" />
            </div>
        </td>
        </div>
    </tr>
        </table>
    </div>
        </div>
    </div>
        <table align="center">
    <div class="box-header with-border">
    <tr>
        <td colspan="2" align="center"><h3 class="box-title">CONTINGENCIA QUE REPORTA</h3></td>
    </tr>
    </div>
    <?php
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
        <select class="form-control" name="cat[]" id="" class="select" onchange="">
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
        <td colspan="2" align="center"><h3 class="box-title">De ser necesario, describa más detalladamente la contingencia</h3>
            <textarea name="descripcion" id="descripcion" cols="100" rows="15" class="textarea" style="visibility:visible;" ></textarea>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <textarea name="categ" id="categ" cols="100" rows="5" class="textarea" style="visibility: hidden"></textarea>
        </td>
    </tr>
    <tr>
        <td align="center"><input name="registrar_contingencia" type="submit" class="btn btn-primary btn-flat" value="Registrar Contingencia" /></td>
    	<td align="center"><input type="button" name="modificar" value="Regresar" class="btn btn-primary btn-flat" onclick="atras()" /></td>
    </tr>
</table>
       
    <input name="codigo" type="hidden" value="<?php echo $row['codigo']; ?>" />
    <input name="nombre" type="hidden" value="<?php echo utf8_encode($row['nombre']); ?>" />
    <input name="direccion" type="hidden" value="<?php echo utf8_encode($row['direccion']); ?>" />
    <input name="cod_estado" type="hidden" value="<?php echo $row['cod_estado']; ?>" />
    <input name="des_estado" type="hidden" value="<?php echo utf8_encode($row['des_estado']); ?>" />
    <input name="cod_municipio" type="hidden" value="<?php echo $row['cod_municipio']; ?>" />
    <input name="des_municipio" type="hidden" value="<?php echo utf8_encode($row['des_municipio']); ?>" />
    <input name="cod_parroquia" type="hidden" value="<?php echo $row['cod_parroquia']; ?>" />
    <input name="des_parroquia" type="hidden" value="<?php echo utf8_encode($row['des_parroquia']); ?>" />
</form>
        </div>
        </div>
</body>
