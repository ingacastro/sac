<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <title>Consultas</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
        <link rel="stylesheet"  href="../../vista/bower_components/bootstrap/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../vista/bower_components/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="../../vista/bower_components/Ionicons/css/ionicons.min.css" />
        <link rel="stylesheet" href="../../vista/dist/css/AdminLTE.min.css" />
        <link rel="stylesheet" href="../../vista/dist/css/skins/_all-skins.min.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" />
        <script src="../../js/buscador_ajax_centro.js" language="javascript" type="text/javascript"></script>
    </head>
<body class="skin-green">
<table align="center">
<?php
foreach ($_GET as $key => $value){
switch($key){
    case 'ord':
    switch($value){
        case 1:
?>
    <tr>
        <td style=font-size:16px align="center">Hora</td>
        <td style=font-size:16px align="center">Cantidad</td>
            
<?php        
    while($row=$res->fetch(PDO::FETCH_BOTH)){
?>
    <tr>
        <td style="font-size:16px">
        <a href="detalle.php?hora=<?php echo $row['hora'] ?>"><?php echo $row['hora'] ?></a>
        </td>
        <td style="font-size:16px"><?php echo $row['cant']; ?></td>
    </tr>
<?php
    }
    break;
        
    case 2:
    if($edo!=$estado){
?>
    <tr>
        <td colspan="2" align="center">Estado<br><?php echo $centro['des_estado']; ?></td>
    </tr>
<?php
    $edo=$estado;
}

if($edo==$estado && $mun!=$municipio){
?>
    <tr>
        <td  align="center" colspan="2">Municipio<br><?php echo $centro['des_municipio']; ?></td>
    </tr>
<?php
        $mun=$municipio;
    }

    if($edo==$estado && $mun==$municipio && $par!=$parroquia){
?>
    <tr>
      <td style=font-size:16px>Parroquia</td>
      <td style=font-size:16px>Cantidad</td>
    </tr>
    <tr>
      <td style=font-size:16px><?php echo $centro['des_parroquia']; ?></td>
      <td style=font-size:16px><?php ?></td>
    </tr>
<?php
        $par=$parroquia;
    }
        break;
        case 4:
?>
            <tr>
            <td style=font-size:16px>
            Centro de Votación
            </td>
            <td style=font-size:16px>
            Cantidad
            </td>
<?php
        for($i=0; $i<count($res['codigo']); $i++){
?>
            <tr class=modo1>
                <td style=font-size:16px>
<?php
            $resCV= consTM2($db,$res['codigo'][$i]);
            $rowCV=$resCV->fetch(PDO::FETCH_BOTH);
            echo utf8_encode($rowCV['nombre']);
?>
                </td>
                <td style=font-size:16px>
                <a href=detalle.php?cv=<?php echo $res['codigo'][$i] ?>><?php    echo $res['cantidad'][$i];     ?>
                </a>
                </td>
           </tr>
<?php
        }
        break;
    }
    break;

    case 'mos':
    switch($value){
        
    }
    break;
}
}
?>
    </table>
    </body>
</html>
