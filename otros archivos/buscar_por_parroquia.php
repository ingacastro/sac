<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Búsqueda por parroquia</title>
<link rel="stylesheet" href="estilos.css" />
</head>
<script src="buscador_ajax_centro.js" language="javascript" type="text/javascript"></script>
<body>
<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#666666" bgcolor="#FFFFFF">
	<tr>
       	<th width="15%" height="117"><img src="cne.jpg" width="100" height="50" longdesc="http://www.cne.gob.ve" /></th>
    	<th width="60%" align="center" valign="middle">
           	<h1>
      	CONSEJO NACIONAL ELECTORAL<br />
		SALA DE ATENCIÓN DE CONTINGENCIA<br />
		ELECCIONES PRESIDENCIALES<BR />
        7 DE OCTUBRE DE 2012
    	</h1>
      	</th>

<?php

	include ("login.php");
	$link = mysql_connect("localhost", "root", "");
	mysql_select_db("sala_de_contingencia", $link);
	
?>
		<th>Usuario:<h1><?php echo $nombreUsuarioL; ?></h1>Tipo de Usuario:<h1><?php echo $tipoUsuarioL; ?></h1></th>
	</tr>
</table>

<?php
if($_POST['select1']==0){
	echo "<script language='javascript'>
		var estado='¡Debe seleccionar el Estado!'
		alert(estado);
		history.back()
		</script>";
	}
	
if($_POST['select2']==0){
	echo "<script language='javascript'>
		var municipio='¡Debe seleccionar el Municipio!'
		alert(municipio);
		history.back()
		</script>";
	}
	
if($_POST['select3']==0){
	echo "<script language='javascript'>
		var parroquia='¡Debe seleccionar la Parroquia!'
		alert(parroquia);
		history.back()
		</script>";
	}

	include ('config.php');
	conectar();
	$estado = $_POST['select1']; 
	$municipio = $_POST['select2'];
	$parroquia2 = $_POST['select3'];
	$query = "select distinct des_estado, des_municipio, des_parroquia from tabla_mesa where cod_estado = $estado and cod_municipio = $municipio and cod_parroquia = $parroquia2";
	$consulta=mysql_query($query);
	while ($resultado = mysql_fetch_row($consulta)){
		echo "<table>";
			echo "<tr><td>ESTADO<br /><input type=hidden name=estado id=estado value=$estado width=20 /><h1>$resultado[0]</h1></td>";
				echo "<td>MUNICIPIO<br /><input type=hidden name=municipio id=municipio value=$municipio width=20  /><h1>$resultado[1]</h1></td>";
				echo "<td>PARROQUIA<br /><input type=hidden name=parroquia id=parroquia value=$parroquia2 width=20  /><h1>$resultado[2]</h1></td>";
			echo "</tr>";
		echo "</table>";
	}
	?>
	<table>
    	<tr>
       		<td colspan="2">CENTRO DE VOTACI&Oacute;N<br /><input type="text" name="centro_de_votacionP" id="centro_de_votacionP" class="input" size="100" maxlength="100" onkeypress="BuscarParroquia();"  /></td>
		</tr>
        <tr>
        	<td colspan="2"><div class="resultados" id="resultados" align="center"></div></td>
        </tr>
		<tr>
        	<td><input type=button class=button onclick="javascript:location.href='menu_operador.php';" value=Menú /></td>
            <td><input type="button" value="Regresar" onclick="atras()" class="button" /></td>
        </tr>
    </table>
</body>
</html>