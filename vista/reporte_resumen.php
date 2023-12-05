<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<link rel="stylesheet" href="estilos.css" />
<title>Imprimir</title>
</head>
<body>
<?php
include '../fpdf/fpdf.php';
class PDF extends FPDF{
function Header(){
    global $id;
    $prim='CONSEJO NACIONAL ELECTORAL';
    $tit='SALA DE ATENCIÓN DE CONTINGENCIAS';
    $ter='ELECCIONES REGIONALES';
    $cua='15 DE OCTUBRE DE 2017';
    $this->Image('../imagen/cne.jpeg',10,8,33);
    $this->SetFont('Arial','B',10);
    $this->Cell(180,4, utf8_decode($prim),0,1,'C');
    $this->Cell(180,4, utf8_decode($tit),0,1,'C');
    $this->Cell(180,4, utf8_decode($ter),0,1,'C');
    $this->Cell(180,4, utf8_decode($cua),0,0,'C');
    $this->SetFont('Arial','B',24);
    $this->Cell(5,5, $id,0,1,'C', '', 'consContCrdAdm.php?id='.$id);
    $this->Ln(5);
}
    
function Footer(){
    $this->SetY(-10);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,5,'PLANTA BAJA, SALA DE REUNIONES. 339.9489, 808.8754, 808.9730 y 377.0119',0,0,'C');
}
    
function resumen($db, $ttlCtg, $ttlST, $ttlSAsig, $rsCnCt, $rsH){
    $this->Cell(20);
    $this->SetFont('Arial','B',9);
    $this->Cell(150, 4, 'RESUMEN', 0, 1, 'C');
    $this->Ln(7);
    $this->Cell(60, 4, 'TOTAL CONTINGENCIAS', 0, 0, 'C');
    $this->Cell(60, 4, utf8_decode('SOLUCIÓN TELEFÓNICA'), 0, 0, 'C');
    $this->Cell(60, 4, utf8_decode('SOLUCIÓN POR CONTINGENTE'), 0, 1, 'C');
    $this->SetFont('Arial','',9);
    $this->Cell(60, 4, $ttlCtg, 0, 0, 'C');
    $this->Cell(60, 4, $ttlST, 0, 0, 'C');
    $this->Cell(60, 4, $ttlSAsig, 0, 1, 'C');
    $this->Ln(4);
    $this->SetFont('Arial','B',9);
    $this->Cell(20);
    $this->Cell(150, 4, utf8_decode('CONTINGENCIAS POR CATEGORÍAS'), 0, 1, 'C');
    $this->Ln();
    $this->SetFont('Arial','',9);
    $this->Cell(30);
    $this->Cell(60, 4, utf8_decode('CATEGORÍA'), 0, 0, 'C');
    $this->Cell(60, 4, utf8_decode('CANTIDAD'), 0, 1, 'C');
    $c=0;
$d=0;
while($rwCnCt=$rsCnCt->fetch(PDO::FETCH_BOTH)){
    $qCat="select * from cont_cat where cod_cat=$rwCnCt[cod_cat] and cod_sub=$rwCnCt[cod_sub]";
    $rsCat=$db->query($qCat);
    $rwCat=$rsCat->fetch(PDO::FETCH_BOTH);
    $qSub="select * from subcategoria where cat=$rwCnCt[cod_cat] and sub=$rwCnCt[cod_sub]";
    $rsSub=$db->query($qSub);
    $rwSub=$rsSub->fetch(PDO::FETCH_BOTH);
    $c=$rwSub['cat'];
    if($c!=$d){
    $this->Cell(30);
    $this->Cell(60, 4, $rwSub['des'], 0, 1, 'C');
    $d=$rwSub['cat'];
    }

    $this->Cell(30);
    $this->Cell(60, 4, $rwSub['desub'], 0, 0, 'C');
    $this->Cell(60, 4, $rwCnCt['cant'], 0, 1, 'C');
}
    $this->Ln(4);
    $this->SetFont('Arial','B',9);
    $this->Cell(20);
    $this->Cell(150, 4, utf8_decode('CONTINGENCIAS POR HORA'), 0, 1, 'C');
    $this->Ln();
    $this->SetFont('Arial','',9);
    $this->Cell(30);
    $this->Cell(60, 4, utf8_decode('HORA'), 0, 0, 'C');
    $this->Cell(60, 4, utf8_decode('CANTIDAD'), 0, 1, 'C');
    $this->SetFont('Arial','',10);
    while($rwH=$rsH->fetch(PDO::FETCH_BOTH)){
            $this->Cell(30);
    $this->Cell(60, 4, $rwH['hora'], 0, 0, 'C');
    $this->Cell(60, 4, $rwH['cant'], 0, 1, 'C');
    }
    $this->Cell(60);

    $this->SetFont('Arial','',9);

    $this->SetFont('Arial','B',9);
    $this->Cell(60);

    $this->SetFont('Arial','',9);
    $this->Cell(20);

    $this->Cell(60);
    $this->SetFont('Arial','B',10);
    $this->Cell(50, 7, 'CONTINGENCIA', 0, 1, 'C');
    $this->SetFont('Arial','',9);

    $this->Cell(80);
    $this->SetFont('Arial','B',9);
     $this->SetFont('Arial','',9);

    $this->SetFont('Arial','B',9);
    $this->Cell(60);
    $this->SetFont('Arial','',9);
    $this->Cell(40);

    }
}

$db=conectar();
ob_clean();
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->resumen($db, $ttlCtg, $ttlST, $ttlSAsig, $rsCnCt, $rsH);
$pdf->Output();
