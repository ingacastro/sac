<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ingresar Resultado</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
    <link rel="stylesheet"  href="../../vista/bower_components/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../vista/bower_components/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../vista/bower_components/Ionicons/css/ionicons.min.css" />
    <link rel="stylesheet" href="../../vista/dist/css/AdminLTE.min.css" />
    <link rel="stylesheet" href="../../vista/dist/css/skins/_all-skins.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" />
</head>
<body class="bg-gray-light">
<?php
$img='../../vista/cne.jpg';
$img2='../../imagen/LOGO20MAYO.png';
require '../../plantilla/encabezado.php';
?>
    <div class="box-body">
        <div class="box-header">
<table align="center">
    <tr>
        <td align="center">  
<?php
if(isset($catg) && $catg!=0){
    for($i=0; $i<count($catg); $i++){
        echo utf8_encode($catg[$i]->desc)."<br/>";
    }
}
?>
        </td>
        <td align="center">
<?php
if(isset($subCatg) && $subCatg!=0){
    for($j=0; $j<count($subCatg); $j++){
        echo utf8_encode($subCatg[$j]->desub)."<br/>";
    }
}else{
    $subCatg=0;
}
?>
        </td>
    </tr>
    <tr>
        <td align="center">Descripcion: <?php echo $_POST['res']; ?></td>
    </tr> 
    <tr>
        <td align="center" colspan="2">
<?php
if($tipoUsu =='Secretaria(o)'){
    echo "<a href=../menu/menu_secretario.php>Regresar al Menú</a>";
}else if($tipoUsu =='Coordinador' || $tipoUsuarioL='Administrador' ){
    echo "<a href=../menu/menu_coordinador.php>Regresar al Menú</a>";
}
?>
        </td>
    </tr>
</table>
        </div>
        </div>
</body>
</html>