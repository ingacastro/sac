<head>
    <meta charset="UTF-8">
</head>
<script type="text/javascript" src="../../js/acciones.js"></script>
<input type="button" name="" value="Generar .xls" onclick="location.href='../consulta/ordenado.php?mos=3'" class="button" />
<table class=tablaR width="100%">
    <tr>
        <td style=font-size:18px>REPORTE POR ESTADO Y CATEGORÍA</td>
        <td style=font-size:18px ><?php echo $cantNac->rowCount()+$cantMetro->rowCount() ?></td>
    </tr>
    <tr>
        <td style=font-size:18px>CATEGORÍA</td>
        <td style=font-size:18px>CANTIDAD</td>
    </tr>
<?php

while($rwCnCt=$rsCnCt->fetch(PDO::FETCH_BOTH)){
    $rsCat=consCnCt($db, $rwCnCt['cod_estado']);

    echo "<tr>";
    echo "<td style=font-size:16px>".utf8_encode($rwCnCt['des_estado'])."</td>";
    echo "<td style=font-size:16px>$rwCnCt[cant]</td>";
    echo "</tr>";
    while($rwCat=$rsCat->fetch(PDO::FETCH_BOTH)){
        $cat=consCatD($db, $rwCat['cod_cat']);
        echo "<tr>";
        echo "<td style=font-size:12px>".utf8_encode($cat->desc)."</td>";
        echo "<td style=font-size:12px>".utf8_encode($rwCat['cant'])."</td>";
        echo "</tr>";
    }
}
?>
    <tr>
        <td style=font-size:18px>REPORTE POR RED SOCIAL</td>
        <td style=font-size:18px ><?php echo $cantRDS->rowCount() ?></td>
    </tr>
    <tr>
        <td style=font-size:18px>CATEGORÍA</td>
        <td style=font-size:18px>CANTIDAD</td>
    </tr>    
<?php
while($rwCnRDS=$rsCnRDS->fetch(PDO::FETCH_BOTH)){
    $rsCatRDS=consCnCtRDS($db, $rwCnRDS['telefono_contacto']);
    echo "<tr>";
    echo "<td style=font-size:16px>".utf8_encode($rwCnRDS['telefono_contacto'])."</td>";
    echo "<td style=font-size:16px>$rwCnRDS[cant]</td>";
    echo "</tr>";

    while($rwCatRDS=$rsCatRDS->fetch(PDO::FETCH_BOTH)){
        $catRDS=consCatD($db, $rwCatRDS['cod_cat']);
        echo "<tr>";
        echo "<td style=font-size:12px>".utf8_encode($catRDS->desc)."</td>";
        echo "<td style=font-size:12px>".utf8_encode($rwCatRDS['cant'])."</td>";
        echo "</tr>";
    }
}
?>
    <tr>
        <td style=font-size:18px>REPORTE POR RIS</td>
        <td style=font-size:18px><?php echo $cantRIS->rowCount() ?></td>
    </tr>
        <tr>
        <td style=font-size:18px>CATEGORÍA</td>
        <td style=font-size:18px>CANTIDAD</td>
    </tr> 
<?php  
 $rsCatRIS=consCnCtRIS($db);
while($rwCnRIS=$rsCnRIS->fetch(PDO::FETCH_BOTH)){
    while($rwCatRIS=$rsCatRIS->fetch(PDO::FETCH_BOTH)){
        $catRIS=consCatD($db, $rwCatRIS['cod_cat']);
        echo "<tr>";
        echo "<td style=font-size:12px>".utf8_encode($catRIS->desc)."</td>";
        echo "<td style=font-size:12px>".utf8_encode($rwCatRIS['cant'])."</td>";
        echo "</tr>";
    }
}
?>
</table>