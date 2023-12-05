<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lista de Centros</title>
</head>
<body>
<?php
include('config.php');
$municipio=$_POST['municipio'];
if($municipio='Libertador'){
$edo=1;
$muni=1;
$resultado = mysql_query("select * from tabla_mesa where cod_estado=$edo and cod_municipio=$muni order by electores limit 10");
while ($row=mysql_fetch_array($resultado)){
	echo "<table>";
		echo "<tr>";
			echo "<td>$row[des_parroquia]</td>";
			echo "<td>$row[nombre]</td>";
			echo "<td>$row[direccion]</td>";
			echo "<td>$row[electores]</td>";
		echo "</tr>";
	echo "</table>";
	
	}
}elseif($_POST['municipio']='Chacao'){
$edo=13;
$muni=18;
$parr=1;
$resultado2 = mysql_query("select * from tabla_mesa where cod_estado=$edo and cod_municipio=$muni and cod_parroquia=1 order by electores limit 10");
while ($row2=mysql_fetch_array($resultado2)){
	echo "<table>";
		echo "<tr>";
			echo "<td>$row2[des_parroquia]</td>";
			echo "<td>$row2[nombre]</td>";
			echo "<td>$row2[direccion]</td>";
			echo "<td>$row2[electores]</td>";
		echo "</tr>";
	echo "</table>";
	
	}
	
	}
?>
</body>
</html>