<?php
date_default_timezone_set('America/La_Paz');
include ('../../modelo/config.php');
include '../../modelo/consultas.php';

$id_contingencia= $_GET['id'];
$db=conectar();
echo "<input type=hidden name=estados value=$_POST[estados]>";
$vpn=$_POST['vpn'];
$rwvpn=consVPN($db, $vpn);
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
    $rowFunc=consFunc($db, $_POST['estados']);
    $rowOfic=consCont($db, $_POST['paises']);
    $rowFunc2=consFunc($db, $_POST['estados2']);
    $rowOfic2=consCont($db, $ofic2);
    $rowFunc3=consFunc($db, $_POST['estados3']);
    $rowOfic3=consCont($db, $ofic3);
    asignaCont($id_contingencia, $db, $func1, $vpn);
    asignaCont($id_contingencia, $db, $func2, $vpn);
    asignaCont($id_contingencia, $db, $func3, $vpn);
    require '../../vista/coord/asignarCont.php';
}else{
    echo "<script>
        alert('No seleccionó a nadie');
        history.back(-1);
    </script>";
}
?>