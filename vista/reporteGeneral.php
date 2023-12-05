<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>Totales</title>
<link rel="stylesheet" type="text/css" href="../css/estilos.css"></link>
</head>
<body>
    <table
	<tr>
    	<td colspan="2"><h1>REPORTE GENERAL</h1></td>
    </tr>
    <tr>
        <td colspan="2"><h3>Total Contingencias<br /><?php echo $ttlCtg ?></h3> </td>
    </tr>
    <tr>
        <td><h3>Sin coordinar<br /><?php echo $ttlSC ?></h3></td>
    	<td ><h3>En análisis<br /><?php echo $ttlAna?></h3></td>
    </tr>
    <tr>
       	<td colspan="2"><h3>Asignadas en proceso<br /><?php echo $ttlAsig  ?></h3></td>
    </tr>
    <tr>
      	<td ><h3>Solución Telefónica<br /><?php echo $ttlST  ?></h3></td>
       	<td ><h3>Solucionadas bajo Contingente:<br /><?php echo $ttlSAsig; ?></h3></td>
    </tr>
</table>
</body>
</html>