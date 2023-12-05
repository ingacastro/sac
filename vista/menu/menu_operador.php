<body class=" skin-blue ">
<?php
    $img='../../vista/cne.jpg';
    $img2='../../imagen/LOGO20MAYO.png';
require '../../plantilla/encabezado.php';
?>
<section class="content">
  <div class="box box-info">
    <div class="box-body">
<table align="center" width="auto">
<tr>
    <td colspan="2"><h2>Seleccione la opción que desea ejecutar:</h2></td>
</tr>
<tr>
    <td align="center">
        <input type="button" class="btn btn-primary btn-flat" onclick="javascript:location.href='../registro/busqueda_centro.php';" value="Registrar Contingencia" />
    </td>
    <td align="center">
        <input type="button" class="btn btn-primary btn-flat" onclick="javascript:location.href='../registro/consContOp.php?id_usuario=<?php echo $_SESSION['idUsuarioL']?>';" value="Contingencias registradas" />
    </td>
</tr>
</table>
    </div>
  </div>
</section>
</body>