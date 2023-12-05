<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cerrar Contingencia</title>
</head>

<body>
<?php
include ('config.php');
$id_contingencia=$_GET['id'];

cerrarContingencia($id_contingencia);
echo "Contingencia Cerrada<br />";
echo "<a href=menu_secretario.php>Ir al Menú</a>"

?>
</body>
</html>