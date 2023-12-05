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
   		<td align="center"><input type="button" value="Regresar" onclick="atras()" /></td>
   	</tr>
</table>
<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#666666" bgcolor="#FFFFFF">		
	<tr>
   		<th width="15%" height="117"><img src="cne.jpg" width="100" height="100" longdesc="http://www.cne.gob.ve" /></th>
       	<th width="60%" align="center" valign="middle">
            <div align="center" class="style1">
            <p><strong>CONSEJO NACIONAL ELECTORAL</strong><br />
            <strong> SALA DE ATENCIÓN DE CONTINGENCIA</strong><br />
            <strong> ELECCIONES REGIONALES</strong>
            <strong> 15 DE OCTUBRE DE 2017</strong></p>
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
</table>

<?php
	$id_contingencia = $_GET['id_contingencia'];
	
	function consultarContingenciaID($id_contingencia){
		$query=mysql_query("select * from contingencia where id_contingencia = $id_contingencia");
		while ($row=mysql_fetch_array($query)){
		$queryU = mysql_query("select * from tabla_mesa where cod_estado=$row[cod_estado] and cod_municipio=$row[cod_municipio] and  cod_parroquia=$row[cod_parroquia]");
		$rowU=mysql_fetch_array($queryU);
?>
<table width="" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#666666" bgcolor="#FFFFFF">
    <tr>
        <td width="33%" align="center">ESTADO <?php echo "<h3>".$rowU['des_estado']."</h3>"; ?></td>
        <td width="33%" align="center">MUNICIPIO<?php echo "<h3>".$rowU['des_municipio']."</h3>"; ?></td>
        <td width="33%" align="center">PARROQUIA<?php echo "<h3>".$rowU['des_parroquia']."</h3>"; ?></td>
    </tr>
</table>
<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#666666" bgcolor="#FFFFFF">
    <tr>
        <td align="center">CÓDIGO DEL CENTRO<br /><?php echo "<h3>".$row['codigo']."</h3>"; ?></td>
        <td align="center">CENTRO DE VOTACIÓN<br /><?php echo "<h3>".$rowU['nombre']."</h3>"; ?></td>
        <td align="center">DIRECCIÓN DEL CENTRO<?php echo "<h3>".$rowU['direccion']."</h3>"; ?></td>
    </tr>
</table>
<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#666666" bgcolor="#FFFFFF">
    <tr>
        <td>INFORMACIÓN DE LA CONTINGENCIA</td>
    </tr>
</table>
<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#666666" bgcolor="#FFFFFF">
    <tr>
        <td>Nombre del solicitante: <?php echo "<h3>".$row['nombre_del_solicitante']."</h3>" ?></td>
        <td>Cédula:<?php echo "<h3>".$row['cedula_solicitante']."</h3>" ?></td>
    </tr>
    <tr>
        <td>Teléfono:<?php echo "<h3>".$row['telefono_contacto']."</h3>" ?></td>
        <td>Ocupación:<?php echo "<h1>".$row['ocupacion_solicitante']."</h1>" ?></td>
    </tr>
</table>
<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#666666" bgcolor="#FFFFFF">
    <tr>
        <td colspan="2" scope="col">ERRORES O FALLAS QUE REPORTA</td>
        <td width="" scope="col">DESCRIPCIÓN DE LA SITUACIÓN</td>
    </tr>
    <tr>
        <td>
        <div align="center">
        <ul id="ul">
            <li>Sist. Aut. de Votos (SAV)</li>
            <li>Máquinas de Votación</li>
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
<?php
	if($row['sav']==1)	{	
    	echo "<li><input name=sav type=checkbox id=sav value=sav checked=checked disabled=disabled /></li>";
    }else{
        "<li><input name='sav' type='checkbox' id='sav' value='sav' disabled=disabled /></li>";
    }
        
    if($row['maquina']==1){ 
        echo "<li><input name=maquina type=checkbox id=maquina value=maquina checked=checked disabled=disabled /></li>";
    }else{
        echo "<li><input name=maquina type=checkbox id=maquina value=maquina disabled=disabled /></li>";
    }
        
    if($row['material']==1){
        echo "<li><input name=material type=checkbox id=material value=material checked=checked disabled=disabled /></li>";
    }else{
        echo "<li><input name=material type=checkbox id=material value=material disabled=disabled /></li>";
    }
        
    if($row['elector']==1){
        echo "<li><input name=elector type=checkbox id=elector value=elector checked=checked disabled=disabled /></li>";
    }else{
        echo "<li><input name=elector type=checkbox id=elector value=elector disabled=disabled /></li>";
    }
        
	if($row['miembro']==1){
		echo "<li><input name=miembro type=checkbox id=miembro value=miembro checked=checked disabled=disabled /></li>";
	}else{
		echo "<li><input name=miembro type=checkbox id=miembro value=miembro disabled=disabled /></li>";
	}

	if($row['conato']==1){
		echo "<li><input name=conato type=checkbox id=conato value=conato checked=checked disabled=disabled /></li>";
	}else{
		echo "<li><input name=conato type=checkbox id=conato value=conato disabled=disabled /></li>";
	}

	if($row['cerrado']==1){
		echo "<li><input name=cerrado type=checkbox id=cerrado value=cerrado checked=checked disabled=disabled /></li>";
	}else{
		echo "<li><input name=cerrado type=checkbox id=cerrado value=cerrado disabled=disabled /></li>";
	}
	
	if($row['otro']==1) {
		echo "<li><input name=otro type=checkbox id=otro value=otro checked=checked disabled=disabled /></li>";
	}else{
		echo "<li><input name=cerrado type=checkbox id=cerrado value=cerrado disabled=disabled /></li>";
	}
	
?>
		</ul>
        </td>
        <td>
            <textarea name="descripcion" cols="45" rows="15" class="textarea" disabled="disabled" ><?php echo $row['descripcion_contingencia']; ?></textarea>
<?php
        }
}

    //Inicia el procedimiento de asignar el contingente
    $consulta = mysql_query("select * from contingencia where id_contingencia = $id_contingencia");
    $fila = mysql_fetch_array($consulta);
    
        $consultaCoord = mysql_query("select * from usuario where id_usuario = $fila[id_coordinador]");
        $filaCoord = mysql_fetch_array($consultaCoord);
        
    if ($fila['id_coordinador']==0){
        ActualizarCoordinador($idUsuarioL, $id_contingencia);
        consultarContingenciaID($id_contingencia);
    }else if($fila['id_coordinador']==$idUsuarioL){
        consultarContingenciaID($id_contingencia);
    }
?>		
        </td>
    </tr>
</table>
<?php
    if($fila['nombre_contingente']=='Sin asignar' && $fila['oficina_procedencia']=='Sin asignar'){
?>
<table width="70%" border="0" align="center" bordercolor="#666666" bgcolor="#FFFFFF">
    <tr><td>Seleccione a los funcionarios que desea asignar para esta contingencia</td></tr>
</table>
<table width="70%" border="0" align="center" bordercolor="#666666" bgcolor="#FFFFFF">
    <tr>
        <td>Nombre del Funcionario</td>
        <td>Oficina de Procedencia</td>
    </tr>
   	
    <form action="asignar_contingente.php?id_contingencia=<?php echo $id_contingencia ?>" method="post" name="asignar_contingente">
    
	<?php
		$queryO="select * from contingente";
		$resultado=mysql_query($queryO);
		$resultadoA=mysql_query($queryO);
		$resultadoB=mysql_query($queryO);
		$resultadoC=mysql_query($queryO);
        
            echo "<tr>";
				echo "<td >";
					echo "<input type=text size=50 name=nombre_contingente />";
				echo "</td>";
				echo "<td>";
			
			echo "<select name='select1'>";
		
		
		while ($rowO=mysql_fetch_array($resultado)){
			echo "<option value='$rowO[oficina]'>".$rowO['oficina']."</option>";
        }
		echo "</td>";
		echo "</tr>";
			echo "</select>";
			
		    echo "<tr>";
				echo "<td >";
					echo "<input type=text size=50 name=nombre_contingente2 />";
				echo "</td>";
				echo "<td>";
			
			echo "<select name='select2'>";
		
		
		while ($rowA=mysql_fetch_array($resultadoA)){
			echo "<option value='$rowA[oficina]'>".$rowA['oficina']."</option>";
        }
		echo "</td>";
		echo "</tr>";
			echo "</select>";
		
		            echo "<tr>";
				echo "<td >";
					echo "<input type=text size=50 name=nombre_contingente3 />";
				echo "</td>";
				echo "<td>";
			
			echo "<select name='select3'>";
		
		while ($rowB=mysql_fetch_array($resultadoB)){
			echo "<option value='$rowB[oficina]'>".$rowB['oficina']."</option>";
        }
		echo "</td>";
		echo "</tr>";
			echo "</select>";
			
		            echo "<tr>";
				echo "<td >";
					echo "<input type=text size=50 name=nombre_contingente4 />";
				echo "</td>";
				echo "<td>";
			
			echo "<select name='select4'>";
		
		while ($rowC=mysql_fetch_array($resultadoC)){
			echo "<option value='$rowC[oficina]'>".$rowC['oficina']."</option>";
        }
		echo "</td>";
		
		echo "</tr>";
			echo "</select>";			
			
      ?>
      
     </table>
     <table width="70%" border="0" align="center" bordercolor="#666666" bgcolor="#FFFFFF">
     <tr>
        <td align="center"><input type="submit" value="Asignar" name="enviar" /></td>
     </tr>
     </table>
   	</form>
    
    <?php
    }else{
        //echo "¡Ya está asignado, se espera resultado!<br />";

		$consultaCont="select * from contingencia where id_contingencia=$id_contingencia";
		
		$resultadoCont=mysql_query($consultaCont);
		echo "<table>";
		echo "<tr>";
			echo "<td>";
				echo "Los funcionarios asignados para esta contingencia son:";
			echo "</td>";
		echo "</tr>";
		echo "<tr>";
		while ($filaCont=mysql_fetch_array($resultadoCont)){
				echo "<td>";
				echo $filaCont['nombre_contingente'];
				echo "</td>";
				echo "<td>";
				echo $filaCont['oficina_procedencia'];
				echo "</td>";
				echo "<td>";
				echo $filaCont['nombre_contingente2'];
				echo "</td>";
				echo "<td>";
				echo $filaCont['oficina_procedencia2'];
				echo "</td>";	
				echo "<td>";
				echo $filaCont['nombre_contingente3'];
				echo "</td>";
				echo "<td>";
				echo $filaCont['oficina_procedencia3'];
				echo "</td>";	
				echo "<td>";
				echo $filaCont['nombre_contingente4'];
				echo "</td>";
				echo "<td>";
				echo $filaCont['oficina_procedencia4'];
				echo "</td>";	
		}
		echo "</tr>";
		echo "</table>";
	}
    ?>
</table>
<a href="javascript:window.print()">Imprimir esta página</a> 
<a href="menu_coordinador.php">Ir al Menú</a>
</body>
</html>