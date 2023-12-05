<?php
session_start();
include '../../modelo/config.php';
include '../../modelo/consultas.php';
$img='../../vista/cne.jpg';
$img2='../../imagen/LOGO20MAYO.png';
require '../../plantilla/encabezado.php';
include '../../clases/categoria.php';
$db=conectar();
?>
<table align="center">
    <tr>
        <td align="center" colspan="2"><input type="button" name="" value="Regresar" onclick="atras()" class="button" /></td>
    </tr>
</table>
<?php
foreach ($_GET as $key => $value){
switch($key){
    case 'ord':
    switch($value){
        case 1:
        $res=reporteH($db);
        require '../../vista/consulta/ordenado.php';
        break;

        case 2:
            $cod=consCen($db);
            $edo=$mun=$par=0;
                for($i=0; $i<count($cod['codigo']); $i++){
                $centro=consCentro($db, $cod['codigo'][$i]);
                $estado=$centro['cod_estado'];
                $municipio=$centro['cod_municipio'];
                $parroquia=$centro['cod_parroquia'];
                require '../../vista/consulta/ordenado.php';
            }
        break;

        case 4:
            $res=consCen($db);
            require '../../vista/consulta/ordenado.php';
        break;
        }
        break;
        
    case 'mos':
        switch($value){
        case 1:
        case 4:
            require '../../controlador/coord/consContAdmin.php';
        break;
    
        case 2:
            $rsCnCt= consCnEdo($db);
            $rsCnRDS=consCnRDS($db);
            $cantMetro=cantMetro($db);
            $cantNac=cantNac($db);
            $cantRDS=cantRDS($db);
            $cantRIS=cantRIS($db);
            $rsCnRIS=consCnRIS($db);
            require '../../vista/consulta/consCnCt.php';
        break;
    
        case 3:
            $rsCnCt= consCnEdo($db);
            $rsCnRDS=consCnRDS($db);
            $cantRIS=cantRIS($db);
            $rsCnRIS=consCnRIS($db);
            $rsRH= reporteH($db);
            require '../../controlador/consulta/exportExcel.php';
        break;
        
        case 5:
            require '../../controlador/consulta/resumen.php';
        break;
    
        case 6:
            require '../controlador/resumen.php';
        break;
        }
    break;
    }
}
?>
