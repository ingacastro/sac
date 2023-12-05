<?php
$loginCorrecto = false;
$idUsuarioL;
$usuarioL;
$nombreUsuarioL;
$tipoUsuarioL;
$link=conectar();
session_start();
if(isset($_POST['usuario']) && isset($_POST['contrasena'])){
    $sql = "select * from usuario where usuario = '$_POST[usuario]' and contrasena = '$_POST[contrasena]'";
    $result = $link->query($sql);
      if ($row=$result->fetch(PDO::FETCH_ASSOC)){
        $_SESSION['idUsuarioL'] = $row['id_usuario'];
        $_SESSION['usuarioL'] = $row['usuario'];
        $_SESSION['nombreUsuarioL'] = $row['nombre_usuario'];
        $_SESSION['cod_usuarioL']=$row['cod_usuario'];
        $_SESSION['tipoUsuarioL'] = $row['tipo_usuario'];
        $loginCorrecto = true;
        $idUsuarioL = $_SESSION['idUsuarioL'];
        $usuarioL = $_SESSION['usuarioL'];
        $nombreUsuarioL = $_SESSION['nombreUsuarioL'];
        $cod_usuarioL=$_SESSION['cod_usuarioL'];
        $tipoUsuarioL = $_SESSION['tipoUsuarioL'];
    }
}
?>