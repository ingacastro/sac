<?php
function conectar(){
    try{
       $link = new PDO('mysql:host=localhost; port=3306; dbname=sac', 'root', '');
       return $link;
   }catch (PDOException $e){
       die('Error de Conexión: '.$e->getMessage());
   }
}

function desconectar()
{
    $link=null;
    //mysql_close();
}
?>