<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="estilos.css" />
<title>Consulta de Contingencia del Coordinador</title></head>
<script src="buscador_ajax_centro.js" language="javascript" type="text/javascript"></script>
<body>
<?php
include ("config.php");
include ("login.php");
?>
<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#666666" bgcolor="#FFFFFF">
			<tr>
            	<th width="15%" height="117"><img src="cne.jpg" width="100" height="100" longdesc="http://www.cne.gob.ve" /></th>
    			<th width="60%" align="center" valign="middle">
                	<div align="center" class="style1">
      					<p><strong>CONSEJO NACIONAL ELECTORAL</strong><br />
						<strong> SALA DE ATENCI&Oacute;N DE CONTINGENCIA</strong><br />
						<strong> ELECCIONES 2012-2013</strong></p>
    				</div>
          		</th>
<?php                
                if($loginCorrecto){
		echo "<th><p>Usuario:<h3>".$nombreUsuarioL."</h3><br />";
		
		echo "Tipo de Usuario: <font size=+4>".$tipoUsuarioL;"</font></th></tr>";
	}else{
		echo "<th>Bienvenido, el sistema no te ha reconocido</th></tr>";
	}
?>
</tr>
</table>
<?php
	$consultaTotal=mysql_fetch_array(mysql_query("select count(*) from contingencia "));
?>
	<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#666666" bgcolor="#FFFFFF">
	<tr align="center">
    	<td align="center"><input type="button" value="Regresar al Menú" onclick="javascript:location.href='menu_secretario.php'" /></td>
        <td>Total Contingencias Recibidas: <?php echo "<h2>".$consultaTotal[0]."</h2>"; ?></td>
    </tr>
    </table>
    <table width="70%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#666666" bgcolor="#FFFFFF">
    <tr>
    	<th align="center">Número de la Contingencia</th>
       	<th align="center">Fecha y Hora de la Contingencia</th>
    	<th align="center">Nombre del Centro de Votación</th>
    	<th align="center">Dirección</th>
        <th align="center">Parroquia</th>
        <th align="center">Municipio</th>
    </tr>
	
<?php
	ConsultarContingencia();
	function ConsultarContingencia(){
		$query=mysql_query("select * from contingencia");
		while ($row = mysql_fetch_array($query)){
?>

	<tr>	
<?php
	echo "<td align=center>".$row['id_contingencia']."</td>";
	echo "<td align=center><font size=-1>".$row['hora_fecha']."</font></td>";
		$codigo2 = $row['codigo'];
	
			$query2=mysql_query("select des_municipio, des_parroquia, nombre, direccion from tabla_mesa where codigo=$codigo2");

				while ($row2 = mysql_fetch_array($query2)){
	?>	
	<td align=center><font size="-2"><a href="consultarContingenciaSecret.php?id_contingencia=<?php echo $row['id_contingencia'];?>"><?php echo $row2['nombre']?></a></font></td>
	
	<td align="center"><font size="-2"><?php echo $row2['direccion']?></font></td>
	<?php
    echo "<td align=center><font size=-1>".$row2['des_parroquia']."</font></td>";
	echo "<td align=center><font size=-1>".$row2['des_municipio']."</font></td>";
	
	
		}
	
		}
	}

?>
</table>
<a href="menu_secretario.php">Ir al Menú</a>
</body>
</html>