<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Contingencias</title>
<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<script src="buscador_ajax_centro.js" language="javascript" type="text/javascript"></script>
<body>

<?php
	include ('config.php');
	include ("login.php");
?>
<input type="button" name="modificar" value="Regresar" onclick="atras()" class="button" />
<table>
    <tr>
    	<th width="25%" height="117"><img src="cne.jpg" width="100" height="50" /></th>
        <th width="50%" align="center" valign="middle">
       <h1>CONSEJO NACIONAL ELECTORAL<br />SALA DE ATENCIÓN DE CONTINGENCIAS<br />ELECCIONES MUNICIPALES<BR />8 DE DICIEMBRE DE 2013</h1>
<?php
	if($loginCorrecto){
		echo "<th>Usuario:<h1>".$nombreUsuarioL."</h1>";
		echo "Tipo de Usuario: <h1>".$tipoUsuarioL."</h1><a href=cerrarSesion.php>Salir</a></th></tr>";
	}else{
		echo "<th>Bienvenido, el sistema no te ha reconocido</th></tr>";
	}
?>
		</th>
	</tr>
</table>
<select class="select4">
	<option>Ordenar Por...</option>
	<option>hora de llamada</option>
   	<option>Parroquia</option>
    <option>Municipio</option>
    <option>Centro de Votación</option>
</select>
<table class="tabla">
<?php
	$query=mysql_query("select * from contingencia order by id_contingencia desc");
	$total = mysql_num_rows($query);

	if($total>0){
	echo "<tr class=modo1>";
		echo "<td >Ítem</td>";
		echo "<td >Hora de Llamada</td>";
		echo "<td >Registrado por</td>";
		echo "<td >Coordinado por</td>";
		echo "<td >Nombre del Centro</td>";
		echo "<td >Dirección del Centro</td>";
		echo "<td >Parroquia</td>";
		echo "<td >Municipio</td>";
        echo "<td >Estatus</td>";
		echo "<td>Resultado</td>";
	echo "</tr>";
	
	
	while ($row = mysql_fetch_array($query)){
		echo "<tr>";
			echo "<td class=modo1>".$row['id_contingencia']."</td>";
			echo "<td class=modo1>".date("g:i a", strtotime($row['hora_registro']))."</td>";
			$id_usuario=$row['id_usuario'];
			$queryU=mysql_query("select * from usuario where id_usuario=$id_usuario");
			$rowU=mysql_fetch_array($queryU);
			echo "<td class=modo1>".$rowU['nombre_usuario']."</td>";

			$coord = mysql_query("select * from usuario where id_usuario=$row[id_coordinador]");
			$filaC=mysql_fetch_array($coord);
			echo "<td class=modo1>".$filaC['nombre_usuario']."</td>";
			
			$codigo2 = $row['codigo'];

			$query2=mysql_query("select des_municipio, des_parroquia, nombre, direccion from tabla_mesa where codigo=$codigo2");

			while ($row2 = mysql_fetch_array($query2)){
	?>	
	
    <td class=modo1><font size="2"><?php echo $row2['nombre']?></font></td>
	
	<td class=modo1><?php echo $row2['direccion']?></td>

	<?php
    echo "<td class=modo1>".$row2['des_parroquia']."</td>";
	echo "<td class=modo1>".$row2['des_municipio']."</td>";
			}

	if($row['id_resultado']!=0 && $row['contingencia_cerrada']==0 && $row['resultadoC']==0){		
					echo "<td class=modo2>Solucionado</td>";
				}else if($row['funcionario']!=0  && $row['id_resultado']==0 && $row['contingencia_cerrada']==0 ){
					echo "<td class=modo1>Asignado</td>";
				}else if($row['contingencia_cerrada']!=0){
					echo "<td class=modo1>CERRADO</td>";
				}else if($row['id_coordinador']==0){
					echo "<td class=modo2>Sin Coordinar</td> ";
				}else if($row['resultadoC']==1){
					echo "<td class=modo2>Solucionado por Coordinador</td> ";
				}
	
	$queryF=mysql_query("select * from usuario where id_usuario=$row[id_resultado]");
	$rowF=mysql_fetch_array($queryF);
	
	echo "<td class=modo1>$rowF[nombre_usuario]</td>";

	}

?>
	</tr>
    </table>
    <?php
	}else{
		echo "¡Usted no tiene Contingencias actualmente, vuelva al menú y escoja una!";
	}
	?>
<input type="button" name="modificar" value="Regresar" onclick="atras()" class="button" />
</body>
</html>