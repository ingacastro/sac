<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>Consulta de Contingencia de Operador</title>
<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<script src="buscador_ajax_centro.js" language="javascript" type="text/javascript"></script>
<body>
<?php
	include ("config.php");
	include ("login.php");
?>
<table>
	<tr>
    	<td colspan="3"><input class="button" type="button" value="Regresar" onclick="atras()" /></td>
    </tr>

	<tr>
    	<th width="15%" height="117"><img src="cne.jpg" width="100" height="50" longdesc="http://www.cne.gob.ve" /></th>
        <th width="60%" align="center" valign="middle">
        	<h1>
    	CONSEJO NACIONAL ELECTORAL<br />
		SALA DE ATENCI�N DE CONTINGENCIA<br />
		ELECCIONES PRESIDENCIALES 7 DE OCTUBRE 2012
		</h1>
      	</th>
	<?php
        if($loginCorrecto){
            echo "<th><p>Usuario:<h1>".$nombreUsuarioL."</h1>";
            echo "Tipo de Usuario: <h1>".$tipoUsuarioL;"</h1></th></tr>";
        }else{
            echo "<th>Bienvenido, el sistema no te ha reconocido</th></tr>";
        }
    ?>
</table>
	<?php
        $id_contingencia = $_GET['id_contingencia'];
        consultarContingenciaID($id_contingencia);
        function consultarContingenciaID($id_contingencia){
            $query=mysql_query("select * from contingencia where id_contingencia = $id_contingencia");
            while ($row=mysql_fetch_array($query)){
    ?>
<table>
   	<tr>
	<?php
		$queryU=mysql_query("select * from tabla_mesa where cod_estado = $row[cod_estado] and cod_municipio=$row[cod_municipio] and cod_parroquia=$row[cod_parroquia] and codigo=$row[codigo]");
		$rowU=mysql_fetch_array($queryU);
	?>
		<td width="33%" align="center">ESTADO <?php echo "<h3>".$rowU['des_estado']."</h3>"; ?></td>
		<td width="33%" align="center">MUNICIPIO<?php echo "<h3>".$rowU['des_municipio']."</h3>"; ?></td>
		<td width="33%" align="center">PARROQUIA<?php echo "<h3>".$rowU['des_parroquia']."</h3>"; ?></td>
	</tr>

	<tr>
    	<td align="center">C�DIGO DEL CENTRO<br /><?php echo "<h3>".$row['codigo']."</h3>"; ?></td>
        <td colspan="2">CENTRO DE VOTACI�N<br /><?php echo "<h3>".$rowU['nombre']."</h3>"; ?></td>
	</tr>
   	<tr>
		<td colspan="3">DIRECCI�N DEL CENTRO<?php echo "<h3>".$rowU['direccion']."</h3>"; ?></td>
    </tr>
   	<tr>
       	<td colspan="3">INFORMACI�N DE LA CONTINGENCIA</td>
   	</tr>
</table>
<table>
   	<tr>
       	<td>Nombre del solicitante: <?php echo "<h3>".$row['nombre_del_solicitante']."</h3>" ?></td>
       	<td>C�dula:<?php echo "<h3>".$row['cedula_solicitante']."</h3>" ?></td>
       	<td>Tel�fono:<?php echo "<h3>".$row['telefono_contacto']."</h3>" ?></td>
       	<td>Ocupaci�n:<?php echo "<h1>".$row['ocupacion_solicitante']."</h1>" ?></td>
   	</tr>
</table>
<TABLE>
      	<td colspan="2">CONTINGENCIA QUE REPORTA</td>
       	<td>DESCRIPCI�N DE LA SITUACI�N</td>
  	</tr>
   	<tr>
       	<td colspan="2">
<?php
	$consulta=consultarContingenciaI($id_contingencia);
	if($consulta['sai']!=0){
		echo "SAI: <br />";
		switch($consulta['sai']){

			case 1:
			echo "SAI Da�ado<br />";
			break;
			
			case 2:
			echo "Falta el SAI<br />";
			break;
			
			case 3:
			echo "Tardanza en Sustituci�n de Contingencia<br />";
			break;
			
			case 4:
			echo "SAI No reconoce la huella<br />";
			break;
			
			case 5:
			echo "Ausencia del Operador SAI<br />";
			break;
			}
	}
	
	if($consulta['acredita']!=0){
		echo "ACREDITACI�N: <br />";
		switch($consulta['acredita']){

			case 1:
			echo "Miembros de Mesa No Acreditados<br />";
			break;
			
			case 2:
			echo "Miembros de Mesa con Acreditaci�n Falsa<br />";
			break;
			
			case 3:
			echo "Tardanza en Sustituci�n de Contingencia<br />";
			break;
		}
	}
	
	if($consulta['maquina']!=0){
		echo "M�QUINAS DE VOTACI�N: <br />";
		switch($consulta['maquina']){
		
			case 1:
			echo "Falla de Impresi�n<br />";
			break;
	
			case 2:
			echo "No Funciona<br />";
			break;
			
			case 3:
			echo "Tardanza en Sustituci�n de M�quina de Votaci�n<br />";
			break;

			case 4:
			echo "Ausencia del Operador de la M�quina de Votaci�n<br />";
			break;

			}
	}

    if($consulta['material']!=0){
		echo "MATERIAL ELECTORAL: <br />";
		switch($consulta['material']){
			
			case 1:
			echo "Cotill�n Incompleto<br />";
			break;
			
			case 2:
			echo "Falta de Cotill�n<br />";
			break;
			
			case 3:
			echo "Material Electoral Err�neamente Asignado<br />";
			break;
			}
	}
	
	if($consulta['miembro']!=0){
		echo "MIEMBROS DE MESA: <br />";
		switch($consulta['miembro']){
			
			case 1:
			echo "No Constituci�n por Ausencia de Miembros de Mesa<br />";
			break;
			
			case 2:
			echo "Miembros de Mesa Desconocen Procedimiento de Votaci�n<br />";
			break;
			
			case 3:
			echo "Desconocimiento del Procedimiento del Acto de Verificaci�n Ciudadana<br />";
			break;
			
			case 4:
			echo "Mal Manejo de la Contingencia de Transmisi�n<br />";
			break;

			}
	}
	
	if($consulta['conato']!=0){
		echo "CONATO DE SABOTAJE: <br />";
		switch($consulta['conato']){
			
			case 1:
			echo "Conato de Sabotaje<br />";
			break;
			
			}
	}
		
	if($consulta['centrovotacion']!=0){
		echo "CENTROS DE VOTACI�N: <br />";
		switch($consulta['centrovotacion']){

			case 1:
			echo "Mesa(s) No Constitu�da(s)<br />";
			break;
			
			case 2:
			echo "Mesa(s) no se puede constituir porque el Centro de Votaci�n est� Cerrado<br />";
			break;
			
			case 3:
			echo "Cerrado con Electores en Cola<br />";
			break;
			
			case 4:
			echo "Electores Exceden Capacidad F�sica del �rea de Verificaci�n Ciudadana<br />";
			break;
			
			case 5:
			echo "Presi�n de Electores para Reapertura del Centro de Votaci�n cuando finaliz� el Proceso<br />";
			break;
			
			case 6:
			echo "Centro de Acopio para Contingencia Sin Inventario<br />";
			break;

			case 7:
			echo "Mala Transmisi�n de la Contingencia<br />";
			break;
			
			case 8:
			echo "Falla El�ctrica en el Centro de Votaci�n<br />";
			break;

			}
	}
	
	if($consulta['politico']!=0){
		echo "PROSELITISMO POL�TICO: <br />";
		switch($consulta['politico']){
			
			case 1:
			echo "Proselitismo Pol�tico<br />";
			break;
			}
	}
	
	if($consulta['elector']!=0){
		echo "PROBLEMAS CON EL ELECTOR: <br />";
		switch($consulta['elector']){

			case 1:
			echo "El Elector da�a el Material Electoral<br />";
			break;
			
			case 2:
			echo "Enfrentamiento entre Electores<br />";
			break;
			
			case 3:
			echo "Error en Selecci�n al Votar<br />";
			break;
			
			case 4:
			echo "Elector Da�a Comprobante de Votaci�n<br />";
			break;
			
			case 5:
			echo "Elector se niega a Introducir comprobante en la Caja de Resguardo<br />";
			break;

			case 6:
			echo "El Elector se niega a pasar por SAI<br />";
			break;
			
			case 7:
			echo "El Elector quiere votar m�s de una vez<br />";
			break;
			
			case 8:
			echo "Elector manifiesta que votaron por este<br />";
			break;
			
			case 9:
			echo "Enfrentamiento entre Electores y Autoridad P�blica<br />";
			break;

			case 10:
			echo "Asistencia al Elector No Requerida<br />";
			break;
			}
	}
?>
    </td>
    <td>
		<textarea name="descripcion" cols="45" rows="15" class="textarea" disabled="disabled" ><?php echo $row['descripcion_contingencia']; ?>
            </textarea>
        </td>
   	</tr>
</table>
<table width="1000" align="center" border="1">
    <tr>
	<?php 
		$consultaUsu=mysql_query("select nombre_usuario from usuario where id_usuario=$row[id_usuario]");
		$filaU=mysql_fetch_array($consultaUsu);
		$consultaCoord=mysql_fetch_array(mysql_query("select nombre_usuario from usuario where id_usuario=$row[id_coordinador]"));
	?>
       	<td>Registrado por:<br /> <?php echo $filaU[0] ?></td>
       	<td>Coordinado por:<br />
        
	<?php if($row['id_coordinador']!=0){
		  echo $consultaCoord[0]; ?> </td>
	<?php
	if ($row['resultadoC']==0){
		echo "<td>Contingente asignado 1<br />".$row['nombre_contingente']." de ".$row['oficina_procedencia']."</td>";
		echo "<td>Contingente asignado 2<br />".$row['nombre_contingente2']." de ".$row['oficina_procedencia2']."</td>";
		if($row['nombre_contingente3']!='Sin asignar'){
		echo "<td>Contingente asignado 3<br />".$row['nombre_contingente3']." de ".$row['oficina_procedencia3']."</td>";
		}
		if($row['nombre_contingente4']!='Sin asignar'){
		echo "<td>Contingente asignado 4<br />".$row['nombre_contingente4']." de ".$row['oficina_procedencia4']."</td>";
		}
	}else if($row['resultadoC']==1){
		echo "<tr><td colspan=2>Solucionado por el Coordinador</td></tr>";
	}
	}else{ echo "Sin Coordinar";}
	 ?>
    </tr>
    <tr>
    	<td>Resultado:</td>
        <td><textarea cols="55" rows="5" class="textarea" disabled="disabled"><?php echo $row['resultado']; ?></textarea></td>
         </tr>
     <tr>
        <td><input type="button" class="button" value="Regresar" onclick="atras()" /></td>
        <td><input type="button" class="button" value="Cerrar Contingencia" onclick="javascript:location.href='cerrarContingencia.php?id_contingencia=<?php echo $id_contingencia; ?>';"/></td>
    </tr>
</table>

	<?php
			}	
		}
?>	
	
<a href="menu_administrador.php">Ir al Men�</a>
</body>
</html>