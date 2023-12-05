<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ingresar Resultado</title>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
<link rel="stylesheet"  href="../../vista/bower_components/bootstrap/dist/css/bootstrap.min.css"/>
<link rel="stylesheet" href="../../vista/bower_components/font-awesome/css/font-awesome.min.css"/>
<link rel="stylesheet" href="../../vista/bower_components/Ionicons/css/ionicons.min.css"/>
<link rel="stylesheet" href="../../vista/dist/css/AdminLTE.min.css"/>
<link rel="stylesheet" href="../../vista/dist/css/skins/_all-skins.min.css"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" />

</head>
    <body>
<?php
$img='../../vista/cne.jpg';
$img2='../../imagen/LOGO20MAYO.png';
require '../../plantilla/encabezado.php';

if($resultado=='' && $_SESSION['cod_usuarioL']==2){
    echo "<script>
        alert('¡Debe ingresar un resultado!');
        window.location.href='agregarResultadoC.php?id_contingencia=$_GET[id_contingencia]';
    </script>";
}else if($resultado=='' && $_SESSION['cod_usuarioL']==4){
    echo "<script>
        alert('¡Debe ingresar un resultado!');
        window.location.href='consultarContingenciaSecret.php?id_contingencia=$_GET[id_contingencia]';
    </script>";
}else{
?>
    <table align="center">
        <tr>
            <td align="center">se ingresó resultado en la contingencia N° <?php $_GET['id_contingencia'] ?>, el  cual es </td>
        </tr>
        <tr>
            <td align="center"><?php echo utf8_encode($resultado) ?></td>
        </tr>
        <tr>
            <td align="center"><?php echo date("g:i a", strtotime($hora_resultado)); ?></td>
        </tr>
<?php 
    $q=insertResultC($db, $_GET['id_contingencia'], $_SESSION['idUsuarioL'], $resultado, 0, 0, $hora_resultado);
    if($q==1){

    }else{
        echo "no"."<br/>";
        echo $query."<br/>";
    }

    if($_SESSION['tipoUsuarioL'] =='Secretaria(o)'){
        echo "<tr><td align=center><a href=../menu/menu_secretario.php>Regresar al Menú</a></td></tr>";
    }else if($_SESSION['tipoUsuarioL'] =='Coordinador' || $_SESSION['tipoUsuarioL']='Administrador' ){
        echo "<tr><td align=center><a href=../menu/menu_coordinador.php>Regresar al Menú</a></td></tr>";
    }else if($_SESSION['tipoUsuarioL']=='Nacional'){
        echo "<tr><td align=center><a href=../menu/menu_operador.php>Regresar al Menú</a></td></tr>";
    }
}
?>
    </table>
</body>
</html>
