<?php
include '../../modelo/config.php';
include '../login.php';
$link = conectar();
	
if(trim($_POST['usuario']) != "" && trim($_POST['contrasena']) != ""){
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $sql = "select * from usuario where usuario = '$usuario'";
    $result = $link->query($sql);
    if($row=$result->fetch(PDO::FETCH_ASSOC)){

        if($row['contrasena'] == $contrasena && ($row['cod_usuario'] == 1 || $row['cod_usuario'] == 6)){
            echo utf8_decode("¡Ingreso Exitoso, será redirigido a la página principal!");
            echo "<script language=javascript>";
            echo "location.href='../menu/menu_operador.php';";
            echo "</script>";
        }elseif($row['contrasena'] == $contrasena && $row['cod_usuario'] == 2){
            echo utf8_decode("¡Ingreso Exitoso, será redirigido a la página principal!");
            echo "<script language=javascript>";
            echo "location.href='../menu/menu_coordinador.php';";
            echo "</script>";
        }elseif($row['contrasena'] == $contrasena && ($row['cod_usuario'] == 3 || $row['cod_usuario'] == 5)){
            echo utf8_decode("¡Ingreso Exitoso, será redirigido a la página principal!");
            echo "<script language=javascript>";
            echo "location.href='../menu/menu_administrador.php';";
            echo "</script>";
        }elseif($row['contrasena'] == $contrasena && $row['cod_usuario'] == 4){
            echo utf8_decode("¡Ingreso Exitoso, será redirigido a la página principal!");
            echo "<script language=javascript>";
            echo "location.href='../menu/menu_secretario.php';";
            echo "</script>";
        }else{
            echo "Contrasena incorrecta";
            echo "<a href='../../index.php'>Volver</a>";
            session_destroy();
        }
    }else{
        echo "Usuario no existente en la base de datos";
    }
}else{
    echo "Debe especificar un usuario y contraseña";
}
?>
