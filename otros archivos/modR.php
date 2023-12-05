<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php
include('config.php');
$id=$_POST['id'];
$resultado=$_POST['resultado'];
$query="update contingencia set resultado='$resultado' where id_contingencia=$id";
if(mysql_query($query)){
	echo "<script>
		alert('Resultado modificado');
		history.back(-1);
	</script>";
}else{
	echo "Sin modificar";
}
?>
</body>
</html>