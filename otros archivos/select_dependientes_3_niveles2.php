<?php
function generaSelect()
{
	include 'conexion.php';
	conectar();
	$consulta=mysql_query("SELECT distinct cod_estado, des_estado FROM select_1");
	desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='select1' id='select1' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Seleccione Estado</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'name='estado'>".$registro[1]."</option>";
	}
	echo "</select>";
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Búsqueda de Centro de Votación</title>
<link rel="stylesheet" type="text/css" href="select_dependientes_3_niveles.css">
<link rel="stylesheet" type="text/css" href="estilos.css">
<script type="text/javascript" src="select_dependientes_3_niveles.js"></script>
<script src="buscador_ajax_centro.js" language="javascript" type="text/javascript"></script>
</head>

<body>
	<table>
		<tr>
        	<th width="15%" height="117"><img src="cne.jpg" width="100" height="50" longdesc="http://www.cne.gob.ve" /></th>
    		<th width="60%" align="center" valign="middle">
                <h1>      
                CONSEJO NACIONAL ELECTORAL<br />
                SALA DE ATENCIÓN DE CONTINGENCIA<br />
                ELECCIONES PRESIDENCIALES<br />
                7 DE OCTUBRE DE 2012<br />
                </h1>
        	</th>
   <?php		
	include ("login.php");
		if($loginCorrecto){
		echo "<th><h1>Usuario:<br />".$nombreUsuarioL."</h1>";
		echo "<h1>Tipo de Usuario:<br/> ".$tipoUsuarioL."</h1></th></tr>";
	}else{
		echo "<th>Bienvenido, el sistema no te ha reconocido</th></tr>";
	}
	?>
		</tr>
        <tr>
            <td>ESTADO</td>
            <td>MUNICIPIO</td>
            <td>PARROQUIA</td>
        </tr>
        <tr>
         <form action="buscar_por_parroquia.php" method="post" name="buscar_por_parroquia">
            <td><?php generaSelect(); ?></td>
            <td><select disabled="disabled" name="select2" id="select2">
                    <option value="0" name="municipio">Selecciona Municipio...</option>
                </select>
            </td>    
            <td><select disabled="disabled" name="select3" id="select3">
                    <option value="0">Selecciona Parroquia</option>
                </select>
            </td>
            <td>
                <input type="submit" value="Buscar" onClick="cargarContenido(this.value)" />
            </form>
            </td>
        	
      	</tr>
		<tr>
        	<td align="center">CÓDIGO DEL CENTRO<br /><td><!--<td><select id="codigo" size=10></select></td>-->
		</tr>
	</table>
            <table width="70%" border="0" align="center" cellpadding="3" cellspacing="3" bordercolor="#666666" bgcolor="#FFFFFF">
                <tr>
                    <td align="center">CENTRO DE VOTACI&Oacute;N<br /><input type="text" name="centro_de_votacion" id="centro_de_votacion" class="input" size="100" maxlength="100" onkeypress="Buscar();"  /></td>
                </tr>
            </table>
            <table width="71%" border="0" align="center" cellpadding="3" cellspacing="3" bordercolor="#666666" bgcolor="#FFFFFF">
                <tr>
                    <td><div class="resultados" id="resultados" align="center"></div></td>
                </tr>
            </table>
		
<a href="menu_operador.php">Ir a Menú</a>
</body>
</html>