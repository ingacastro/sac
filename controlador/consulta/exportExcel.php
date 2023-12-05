<?php
include '../../PHPExcel-1.8/Classes/PHPExcel.php';
include '../../PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php';

$objPHPExcel = new PHPExcel();
$objDrawing= new PHPExcel_Worksheet_MemoryDrawing();
$objPHPExcel->setActiveSheetIndex(0);

$logo=imagecreatefromjpeg('../../imagen/cne.jpeg');
$objDrawing->setName('cne');
$objDrawing->setDescription('logo cne');
$objDrawing->setImageResource($logo);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(50);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'CONSEJO NACIONAL ELECTORAL');
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'SALA DE ATENCIÓN DE CONTINGENCIA');
$objPHPExcel->getActiveSheet()->setCellValue('B3', 'ELECCIONES REGIONALES Y MUNICIPALES 2021 ');
$objPHPExcel->getActiveSheet()->setCellValue('B4', '21 DE NOVIEMBRE');

$objPHPExcel->getActiveSheet()->setTitle("REPORTE REGIONAL SAC9DIC18");

$ctaObjCons=0;
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);

$fila=7;
$objPHPExcel->getActiveSheet()->setCellValue('A11', 'ESTADO');

while($rwCnCt=$rsCnCt->fetch(PDO::FETCH_BOTH)){
    $rsCat=consCnCt($db, $rwCnCt['cod_estado']);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setName('Arial');
    $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setSize(12);
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $rwCnCt['des_estado']);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $rwCnCt['cant']);
    $fila++;
    $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setName('Arial');
    $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setSize(11);
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, 'CATEGORÍA');
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, 'CANTIDAD');
    $fila++;

    while($rwCat=$rsCat->fetch(PDO::FETCH_BOTH)){
        $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setName('Arial');
        $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setSize(10);
        $cat=consCatD($db, $rwCat['cod_cat']);
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, utf8_encode($cat->desc));
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, utf8_encode($rwCat['cant']));
        $fila++;
    }
    $fila++;
}

while($rwCnRDS=$rsCnRDS->fetch(PDO::FETCH_BOTH)){
    $rsCatRDS=consCnCtRDS($db, $rwCnRDS['telefono_contacto']);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setName('Arial');
    $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setSize(12);
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, utf8_encode($rwCnRDS['telefono_contacto']));
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $rwCnRDS['cant']);
    $fila++;
    $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setName('Arial');
    $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setSize(11);
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, 'CATEGORÍA');
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, 'CANTIDAD');
    $fila++;
    
    while($rwCatRDS=$rsCatRDS->fetch(PDO::FETCH_BOTH)){
        $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setName('Arial');
        $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setSize(10);
        $catRDS=consCatD($db, $rwCatRDS['cod_cat']);
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, utf8_encode($catRDS->desc));
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, utf8_encode($rwCatRDS['cant']));
        $fila++;
    }
    $fila++;
}

$objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, 'REPORTE POR RIS');
$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $cantRIS->rowCount());
$fila++;

$objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setSize(11);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, 'CATEGORÍA');
$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, 'CANTIDAD');
$fila++;
$rsCatRIS=consCnCtRIS($db);
while($rwCnRIS=$rsCnRIS->fetch(PDO::FETCH_BOTH)){
    while($rwCatRIS=$rsCatRIS->fetch(PDO::FETCH_BOTH)){
        $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setName('Arial');
        $objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setSize(10);
        $catRIS=consCatD($db, $rwCatRIS['cod_cat']);
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, utf8_encode($catRIS->desc));
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, utf8_encode($rwCatRIS['cant']));
        $fila++;
    }
    $fila++;
}

    $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, 'REPORTE POR INTERVALO DE HORA');
    $fila++;
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, 'INTERVALO');
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, 'CANTIDAD');
    $fila++;
    while($rwH=$rsRH->fetch(PDO::FETCH_BOTH)){
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $rwH['hora']);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $rwH['cant']);
        $fila++;
    }

$fecha=date("d-m-Y");
$objPHPExcel->setActiveSheetIndex(0);
ob_clean();
ob_start();
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename='.$fecha.'.xlsx');
header("Cache-Control: max-age=0");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
ob_end_flush();