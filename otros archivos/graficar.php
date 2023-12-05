<?php
require_once 'phplot.php';
//los datos a graficar siempre van en un array de datos de la siguiente manera: array('etiqueta', valorX, valorY)
$datos = array(
    array('', 1800,   5), array('', 1810,   7), array('', 1820,  10),
    array('', 1830,  13), array('', 1840,  17), array('', 1850,  23),
    array('', 1860,  31), array('', 1870,  39), array('', 1880,  50),
    array('', 1890,  63), array('', 1900,  76), array('', 1910,  92),
    array('', 1920, 106), array('', 1930, 123), array('', 1940, 132),
    array('', 1950, 151), array('', 1960, 179), array('', 1970, 203),
    array('', 1980, 227), array('', 1990, 249), array('', 2000, 281),
);

$grafica = new PHPlot(800, 600);              //creamos el objeto de la clase PHPlot de 800px de ancho por 600px de alto
$grafica->SetImageBorderType('plain');      //le asignamos un borde a la grafica
$grafica->SetPlotType('lines');                  //el tipo de gráfica será de lineas
$grafica->SetDataType('data-data');         //lo que va a graficar seran datos en los ejes X y Y
$grafica->SetDataValues($datos);            //le asignamos el array de datos a la grafica
$grafica->SetTitle('Grafica de velocidades en el 2007');  //le asignamos un titulo a la grafica
$grafica->SetPlotAreaWorld(NULL, 0, NULL, NULL);        //Nos aseguramos que el eje Y inicie en 0, los demas ejes seran calculados automaticamente tomando en cuenta los maximos y minimos valores del array
$grafica->DrawGraph();                          //dibujamos nuestra grafica
?>