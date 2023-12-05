<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>Contingencia</title>
<link rel="stylesheet" href="estilos.css" />
</head>
<script src="buscador_ajax_centro.js" language="javascript" type="text/javascript"></script>
<body>
<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#666666" bgcolor="#FFFFFF">
<tr>
    <th width="15%" height="117"><img src="../sala_de_contingencia_2011-13/cne.jpg" width="100" height="100" longdesc="http://www.cne.gob.ve" /></th>
    <th width="60%" align="center" valign="middle">
    <div align="center" class="style1">
    <p><strong>CONSEJO NACIONAL ELECTORAL</strong><br />
    <strong> SALA DE ATENCIÓN DE CONTINGENCIA</strong><br />
    <strong> ELECCIONES 2012-2013</strong></p>
    </div>
    </th>
<?php
	include ("login.php");
	$link = mysql_connect("localhost", "root", "");
	mysql_select_db("sala_de_contingencia", $link);
	$codigo = $_GET["codigo"];
	$query = mysql_query("select * from tabla_mesa where codigo = $codigo");
	$row = mysql_fetch_array($query);
?>
    <th>Usuario:<h1><?php echo $nombreUsuarioL; ?></h1>Tipo de Usuario:<br /><font size="+4"><?php echo $tipoUsuarioL; ?></font></th>
</tr>
</table>
<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#666666" bgcolor="#FFFFFF">
    <tr>
       	<td width="33%" align="center">ESTADO<?php echo "<h1>".$row['des_estado']."</h1>"; ?></td>
    	<td width="33%" align="center">MUNICIPIO<?php echo "<h1>".$row['des_municipio']."</h1>"; ?></td>
    	<td width="33%" align="center">PARROQUIA<?php echo "<h1>".$row['des_parroquia']."</h1>"; ?></td>
  </tr>
</table>
<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#666666" bgcolor="#FFFFFF">
    <tr>
       	<td align="center">CÓDIGO DEL CENTRO<br /><?php echo "<h1>".$row['codigo']."</h1>"; ?></td>
        <td align="center">CENTRO DE VOTACIÓN<br /><?php echo "<h1>".$row['nombre']."</h1>"; ?></td>
    </tr>
</table>
<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#666666" bgcolor="#FFFFFF">
    <tr>
       	<td align="center">DIRECCIÓN DEL CENTRO<?php echo "<h1>".$row['direccion']."</h1>"; ?></td>
    </tr>
</table>
<form action="registrar_contingencia.php" method="post">
    <table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#666666" bgcolor="#FFFFFF">
        <tr>
            <td>INFORMACIÓN DE LA CONTINGENCIA</td>
        </tr>
    </table>
    <table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#666666" bgcolor="#FFFFFF">
        <tr>
            <td>Nombre del solicitante: <input name="nombre_solicitante" type="text" size="50" maxlength="50" class="input" /></td>
            <td>Cédula:<input name="cedula_solicitante" type="text" class="input" size="10" maxlength="10"/></td>
        </tr>
        <tr>
            <td>Teléfono:<select name="cod_tlf_solicitante" type="text" class="input" maxlength="4" >
                    <option>0416</option>
                    <option>0426</option>
                    <option>0414</option>
                    <option selected="selected">0424</option>
                    <option>0212</option>
                </select>
                <input name="telefono_solicitante" type="text" class="input" size="8" maxlength="8" /></td>
            <td>Ocupación:<input name="ocupacion_solicitante" type="text" class="input" size="25" maxlength="25" /></td>
        </tr>
    </table>
    <table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#666666" bgcolor="#FFFFFF">
        <tr>
            <td colspan="2" scope="col">ERRORES O FALLAS QUE REPORTA</td>
            <td width="70%" scope="col">DESCRIPCIÓN DE LA SITUACIÓN</td>
        </tr>
        <tr>
            <td>
                <div align="center">
                    <ul id="ul">
                        <li>Captahuellas (SAV)</li>
                        <li>Máquina de Votación</li>
                        <li>Material Electoral</li>
                        <li>Electores</li>
                        <li>Miembros de Mesa</li>
                        <li>Conato de Sabotaje</li>
                        <li>Centro Cerrado</li>
                        <li>Otro Hecho</li>
                  </ul>
                </div>
            </td>
            <td>
                <ul id="ul">
                    <li><input name="sav" type="checkbox" id="sav" value="sav" /></li>
                    <li><input name="maquina" type="checkbox" id="maquina" value="maquina" /></li>
                    <li><input name="material" type="checkbox" id="material" value="material" /></li>
                    <li><input name="elector" type="checkbox" id="elector" value="elector" /></li>
                    <li><input name="miembro" type="checkbox" id="miembro" value="miembro" /></li>
                    <li><input name="conato" type="checkbox" id="conato" value="conato" /></li>
                    <li><input name="cerrado" type="checkbox" id="cerrado" value="cerrado" /></li>
                    <li><input name="otro" type="checkbox" id="otro" value="otro" /></li>
                </ul>
            </td>
            <td>
                <textarea name="descripcion" cols="65" rows="25" class="textarea" ></textarea>
            </td>
        </tr>
    </table>
    <input name="registrar_contingencia" type="submit" value="Registrar Contingencia"  />
    <input type="button" name="modificar" value="Regresar" onclick="atras()" />
    <input name="id_usuario" type="hidden" value="<?php echo $idUsuarioL; ?>" />
    <input name="codigo" type="hidden" value="<?php echo $row['codigo']; ?>" />
    <input name="nombre" type="hidden" value="<?php echo $row['nombre']; ?>" />
    <input name="direccion" type="hidden" value="<?php echo $row['direccion']; ?>" />
    <input name="cod_estado" type="hidden" value="<?php echo $row['cod_estado']; ?>" />
    <input name="des_estado" type="hidden" value="<?php echo $row['des_estado']; ?>" />
    <input name="cod_municipio" type="hidden" value="<?php echo $row['cod_municipio']; ?>" />
    <input name="des_municipio" type="hidden" value="<?php echo $row['des_municipio']; ?>" />
    <input name="cod_parroquia" type="hidden" value="<?php echo $row['cod_parroquia']; ?>" />
    <input name="des_parroquia" type="hidden" value="<?php echo $row['des_parroquia']; ?>" />
</form>
<a href="select_dependientes_3_niveles.php">Regresar</a>
</body>
</html>