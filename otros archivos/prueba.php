<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>Documento sin título</title>
</head>

<body>
<?php
$host = "localhost";
$user = "root";
$contrasena = "";
$db = "sac";

function conectar(){
 try{
    $link = new PDO('mysql:host=localhost; port=3306; dbname=sac', 'root', '');
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

function extraer($q){
        $query = mysql_query("select * from tabla_mesa where nombre like '%$q%'");
    if(mysql_num_rows($query)==0){
        echo 'No existe el centro de votación';	
    }else{
        while ($row = mysql_fetch_array($query)){
            echo '<a href=buscar_por_centro.php?codigo='.$row['codigo'].'>'.utf8_encode($row['nombre']).'  '.$row['des_parroquia'].'</a><br>';
        }
    }
   
}

function ExtraerParr($e, $m, $p, $r){
    $query = mysql_query("select * from tabla_mesa where cod_estado='$e' and cod_municipio='$m' and cod_parroquia='$p' and nombre like '%$r%'");
   if(mysql_num_rows($query)==0){
        echo 'No existe el centro de votación';
    }else{
        while ($row = mysql_fetch_array($query)){
            echo '<a href=buscar_por_centro.php?codigo='.$row['codigo'].'>'.utf8_encode($row['nombre']).'</a><br>';
        }
    }
    
}
		
function InsertarContingencia ($a, $b, $c, $d, $e, $f, $g, $h, $i){
//function InsertarContingencia (){
    $query = "insert into contingencia (descripcion_contingencia, hora_llamada, nombre_solicitante, cedula_solicitante, telefono_contacto, ocupacion_solicitante, id_usuario_registro, codigo_centro, hora_registro)"
        . " values ('$a', '$b', '$c', '$d', '$e', '$f', $g, $h, '$i')";
    echo $query."<br/>";
    /*
    $qId="select max(id_contingencia) from contingencia";
    $db=conectar();
    $rsId=$db->query($qId);
    $rwId=$rsId->fetch(PDO::FETCH_BOTH);
    echo $rwId[0];
    */
    /*if(mysql_query($query)){
        echo "<h1>Contingencia Registrada</h1>";
    }else{
        echo "¡No se registró!"	;
    }
     * 
     */
}
		
function consultarContingenciaI($id_usuario, $codigo, $cod_estado, $cod_municipio, $cod_parroquia){
    $query=mysql_query("select * from contingencia where id_usuario=$id_usuario and codigo=$codigo and cod_estado=$cod_estado and cod_municipio=$cod_municipio and cod_parroquia=$cod_parroquia");
    $row=mysql_fetch_array($query);
    return $row;
}

		


    //mysql_connect("localhost", "root", "");
    //mysql_select_db("sala_de_contingencia");
}

function desconectar(){
    mysql_close();
}
	
function ActualizarCoordinador($a, $b, $c){
    $query = "update contingencia set id_coordinador=$a, hora_coordinador='$b' where id_contingencia=$c";
    mysql_query($query);
}
	
function ActualizarHoraCoordinador($a, $b){
    $query= "update contingencia set hora_coordinador='$a' where id_contingencia=$b";
    //echo "Actualizando a las ".$a;
    mysql_query($query);
}

function CerrarContingencia($a){
        $query= "update contingencia set contingencia_cerrada=1 where id_contingencia=$a";
        mysql_query($query);
}
	
function InsertarResultado($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k, $l, $m, $n){
        $query = "update contingencia set resultado='$a', sair=$c, acreditar=$d, maquinar=$e, materialr=$f, miembror=$g, conator=$h, centrovotacionr=$i, politicor=$j, electorr=$k, membranar=$l, id_resultado=$m, hora_resultado='$n' where id_contingencia=$b";
        if(mysql_query($query)){
        echo "Resultado Añadido<br />";
        }else{
        echo "no resultado";
        }
}
	
function InsertarResultadoC($a, $b, $c){
$query = "update contingencia set resultado='$a', resultadoC=1, id_resultado=$c where id_contingencia=$b";
if(mysql_query($query)){
echo "Resultado Añadido<br />";
}else{
echo "no resultado";
}
	}
	
    function ConsultarResultado ($a){
        $query = "select resultado from contingencia where id_contingencia = $a";
        $a=mysql_fetch_array(mysql_query($query));
        return $a[0];
    }
		
?>

</body>
</html>