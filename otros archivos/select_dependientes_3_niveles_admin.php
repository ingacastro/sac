<?php
function generaSelect()
{
	include 'conexion.php';
	conectar();
	$consulta=mysql_query("SELECT distinct cod_estado, des_estado FROM select_1");
	desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='select1' id='select1' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Elige</option>";
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
<title>B�squeda de Centro de Votaci�n</title>
<link rel="stylesheet" type="text/css" href="select_dependientes_3_niveles.css">
<link rel="stylesheet" type="text/css" href="estilos.css">
<script type="text/javascript" src="select_dependientes_3_niveles.js"></script>
<script src="buscador_ajax_centro.js" language="javascript" type="text/javascript"></script>
</head>

<body>
	<table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#666666" bgcolor="#FFFFFF">
		<tr>
           	<th width="15%" height="117"><img src="cne.jpg" width="100" height="50" longdesc="http://www.cne.gob.ve" /></th>
    		<th width="60%" align="center" valign="middle">
               	<div align="center" class="style1">
      				<p><strong>CONSEJO NACIONAL ELECTORAL</strong><br />
					<strong> SALA DE ATENCI�N DE CONTINGENCIA</strong><br />
					<strong> ELECCIONES 2012-2013</strong></p>
    			</div>
        	</th>
   <?php		
	include ("login.php");
		if($loginCorrecto){
		echo "<th><p>Usuario:<h1>".$nombreUsuarioL."</h1>";
		
		echo "Tipo de Usuario: <h1>".$tipoUsuarioL."</h1></th></tr>";
	}else{
		echo "<th>Bienvenido, el sistema no te ha reconocido</th></tr>";
	}
	?>
		</tr>
    </table>
	<form action="buscar_por_parroquia.php" method="post" name="buscar_por_parroquia">
    	<table width="70%" border="0" align="center" cellpadding="3" cellspacing="3" bordercolor="#666666" bgcolor="#FFFFFF">
            <tr>
                <td width="33%" align="center">ESTADO<br /></td>
                <td width="33%" align="center">MUNICIPIO<br /></td>
                <td width="33%" align="center">PARROQUIA<br /></td>
            </tr>
            <tr>
                <td><?php generaSelect(); ?></td>
                <td><select disabled="disabled" name="select2" id="select2">
                		<option value="0" name="municipio">Selecciona opci&oacute;n...</option>
                    </select>
                </td>    
                <td><select disabled="disabled" name="select3" id="select3">
                        <option value="0">Selecciona opci&oacute;n...</option>
                    </select>
                </td>
                <td>
                	<input type="submit" value="Buscar" onClick="cargarContenido(this.value)" />
                </td>
       </form>
                 <table width="70%" border="0" align="center" cellpadding="3" cellspacing="3" bordercolor="#666666" bgcolor="#FFFFFF">
                <tr>
                    <td align="center">C&Oacute;DIGO DEL CENTRO<br /><td><!--<td><select id="codigo" size=10></select></td>-->
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
		
<a href="menu_operador.php">Ir a Men�</a>
</body>
</html>