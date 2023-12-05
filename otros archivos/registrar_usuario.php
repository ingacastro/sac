<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro de usuarios</title>
</head>

<body>
<form action="registrar_usuario.php" method="post">
    <table width="70%" border="0" align="center" cellpadding="3" cellspacing="3" bordercolor="#666666" bgcolor="#FFFFFF">
			<tr>
            	<th width="18%" height="117"><img src="cne.jpg" width="100" height="100" longdesc="http://www.cne.gob.ve" /></th>
    			<th width="74%" align="center" valign="middle">
                	<div align="center" class="style1">
      					<p><strong>CONSEJO NACIONAL ELECTORAL</strong></p>
						<p><strong> SALA DE ATENCIÓN DE CONTINGENCIA</strong></p>
						<p><strong> ELECCIONES 2012-2013</strong></p>
    				</div>
          		</th>
			</tr>
  			<tr>
  
<?php
	$link= mysql_connect("localhost", "root", "");
	mysql_select_db("sala_de_contingencia", $link);
		function quitar($mensaje){
			$mensaje = str_replace("<", "<", $mensaje);
			$mensaje = str_replace(">", ">", $mensaje);
			$mensaje = str_replace("\'", "'", $mensaje);
			$mensaje = str_replace('\"', '"', $mensaje);
			$mensaje = str_replace("\\\\", "\\", $mensaje);
			return $mensaje;
		}
		
		if (trim($_POST['usuario']) != "" && trim($_POST['nombre_usuario']) != ""){
			$sql = "select id_usuario from usuario where usuario = '".quitar($_POST['usuario'])."'";
			$result = mysql_query($sql);
			if ($row=mysql_fetch_array($result)){
				echo "<td>&nbsp;</td>";
				echo "<td><div align=center>Error, usuario ya escogido</div></td>";
				echo "<td>&nbsp;</td>";
			}else{
			
			$sql = "insert into usuario (usuario, contrasena, nombre_usuario, tipo_usuario) values ('$_POST[usuario]', '$_POST[contrasena]', '$_POST[nombre_usuario]', '$_POST[tipo_de_usuario]')";
			
				/*$sql = "insert into usuario (usuario, contrasena, nombre_usuario, tipo_usuario) values (".quitar($_POST['usuario']).", ".quitar($_POST['contrasena']).", ".quitar($_POST['nombre_usuario']).", ".quitar($_POST['tipo_de_usuario']).")";
				mysql_query($sql);*/
			
			mysql_query($sql);
?>
			<td>&nbsp;</td>
            <td><div align="center">¡Registro Exitoso!</div></td>
			<td>&nbsp;</td>
<?php
			}
			mysql_free_result($result);
		}else{
			echo "<td>&nbsp;</td>";
			echo "<td><div align=center>¡Debe llenar todos los campos!</div></td>";
			echo "<td>&nbsp;</td>";
		}
		mysql_close();

?>
    </FORM>
    </tr>
    <tr>
    	<td><div align="center"><a href="index.html">Volver al Menú</a></div></td>
    </tr>
</table>
	
</body>
</html>