<?php
function ActualizarHoraCoordinador($a, $b){
    $query= "update contingencia set hora_coordinador='$a' where id_contingencia=$b";
    mysql_query($query);
}

function ActualizarCoordinador($a, $b, $c){
    $db=conectar();
    $query = "update contingencia set id_coordinador=$a, hora_coordinador='$b' where id_contingencia=$c";
    $db->query($query);
}

function CerrarContingencia($a){
    $query= "update contingencia set contingencia_cerrada=1 where id_contingencia=$a";
    mysql_query($query);
}

function conectar(){
    try{
       $link = new PDO('mysql:host=localhost; port=3307; dbname=sac', 'root', '');
       return $link;
    }catch (PDOException $e){
       die('Error de Conexión: '.$e->getMessage());
    }

    if (!@mysql_connect($host, $user, $contrasena)){
       echo 'Se produjo un error al intentar conectar la base de datos';
    }else{
       if (!@mysql_select_db($db)){
           echo 'No existe la base de datos';
       }
    }
}


?>