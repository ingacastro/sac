<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<link rel="stylesheet" href="estilos.css" />
<title>Asignar Contingente</title>
</head>
<script src="select_dependientes2.js" language="javascript" type="text/javascript"></script>
<body>
<?php
include ('config.php');
include ("login.php");
function generaPaises(){
    conectar();
    $consulta=mysql_query("SELECT id, opcion FROM contingente");
    desconectar();

    // Voy imprimiendo el primer select compuesto por los paises
    echo "<select name='paises' id='paises' onChange='cargaContenido(this.id)'>";
    echo "<option value='0'>Elige</option>";
    while($registro=mysql_fetch_row($consulta))
    {
            echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
    }
    echo "</select>";
}
?>
<table>
    <tr>
        <td>
    <?php require './plantilla/encabezado.php'; ?>        
        </td>
        <td>
    	<?php
	if($loginCorrecto){
            echo "<th>Usuario:<h1>".$nombreUsuarioL."</h1>";
            echo "Tipo de Usuario: <h1>".$tipoUsuarioL;"</h1></th></tr>";
	}else{
            echo "<th>Bienvenido, el sistema no te ha reconocido</th></tr>";
	}
	?>
        </td>
    </tr>
</table>
<table>
	
<?php
   date_default_timezone_set('America/Caracas');
   $hora_asignacion=date("H:i:s");
    echo "<tr><td colspan=3>El(Los) Funcionario(s) responsable(s) asignado a las ".date("g:i a", strtotime($hora_asignacion))." para la contingencia N° $_GET[id_contingencia] son: </td></tr>";
?>
    <tr>
    	<td>Funcionario</td>
       	<td>Oficina</td>
      	<td>Celular</td>
    </tr>
<?php
    function asignaCont($id_contingencia, $db, $id_funcionario){
        if($id_funcionario!=0){
        $horaAsig=date("H:i");
        $sql="insert into asignacioncont (id_contingencia, id_funcionario, hora_asignacion) "
        . "values ($id_contingencia, $id_funcionario, '$horaAsig')";
        //echo $sql;
        $db->query($sql);
        $cantidad="select * from contingente where id=$_POST[paises]";
        $res=$db->query($cantidad);
        $resultado=$res->fetch(PDO::FETCH_BOTH);
        $cont=$resultado['cantidad'];
        $cont++;
        $db->query("update contingente set cantidad=$cont where id=$_POST[paises]");
        }
    }

    if(isset($_POST['estados'])){
        if($_POST['estados2']==0){
            $ofic2=0;
        }else{
            $ofic2=$_POST['paises'];
        }
        if($_POST['estados3']==0){
            $ofic3=0;
        }else{
            $ofic3=$_POST['paises'];
        }
        $func1=$_POST['estados'];
        $func2=$_POST['estados2'];
        $func3=$_POST['estados3'];
    //$sql = "update contingencia set funcionario=$_POST[estados], funcionario2=$_POST[estados2], funcionario3=$_POST[estados3], oficina=$_POST[paises], oficina2=$ofic2, oficina3=$ofic3, hora_asignacion='$hora_asignacion' where id_contingencia = $_GET[id_contingencia]";
    $id_contingencia= $_GET['id_contingencia'];
    $db=conectar();

    echo "<input type=hidden name=estados value=$_POST[estados]>";
    echo "<tr>";
        echo "<td>";
            $queryFunc=$db->query("select * from funcionario where id=$_POST[estados]");
            $rowFunc=$queryFunc->fetch(PDO::FETCH_BOTH);
            echo $rowFunc['opcion']."<br/>";
            
            asignaCont($id_contingencia, $db, $func1);
        echo "</td>";
        echo "<td>";
            $queryOfic=$db->query("select * from contingente where id=$_POST[paises]");
            $rowOfic=$queryOfic->fetch(PDO::FETCH_BOTH);
            echo $rowOfic['opcion'];
        echo "</td>";
        echo "<td>$rowFunc[celular]</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>";
            $queryFunc=$db->query("select * from funcionario where id=$_POST[estados2]");
            $rowFunc=$queryFunc->fetch(PDO::FETCH_BOTH);
            echo $rowFunc['opcion']."<br/>";
            asignaCont($id_contingencia, $db, $func2);
        echo "</td>";
        echo "<td>";
            $queryOfic=$db->query("select * from contingente where id=$ofic2");
            $rowOfic=$queryOfic->fetch(PDO::FETCH_BOTH);
            echo $rowOfic['opcion'];
        echo "</td>";
        echo "<td>$rowFunc[celular]</td>";
    echo "</tr>";
    echo "<tr>";
        echo "<td>";
            $queryFunc=$db->query("select * from funcionario where id=$_POST[estados3]");
            $rowFunc=$queryFunc->fetch(PDO::FETCH_BOTH);
            echo $rowFunc['opcion']."<br/>";
            asignaCont($id_contingencia, $db, $func3);
        echo "</td>";
        echo "<td>";
            $queryOfic=$db->query("select * from contingente where id=$ofic3");
            $rowOfic=$queryOfic->fetch(PDO::FETCH_BOTH);
            echo $rowOfic['opcion']."<br/>";
        echo "</td>";
    echo "<td>$rowFunc[celular]</td>";
    echo "</tr>";

    }else{
        echo "<script>
            alert('No seleccionó a nadie');
            history.back(-1);
        </script>";
    }
	
?>
</table>
<table>
    <tr>
        <td>
        <input type="button" class="button" onclick="javascript:location.href='menu_coordinador.php';" value="Ir a Menú" />
        <input type="button" class="button" onclick="javascript:location.href='reporte_coordinador.php?id=<?php echo $_GET['id_contingencia'] ?>';" value="Imprimir" />
        <input type="button" value="Regresar" onclick="javascript:history.back(-1)" class="button" />
        </td>
    </tr>
</table>
</body>
</html>