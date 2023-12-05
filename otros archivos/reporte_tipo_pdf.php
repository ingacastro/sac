<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
// Reporte de Tipo de Proyecto

$id_tipo_proyecto=$_GET['tp'];

include ("../conf/conexion.php");
$result = mysql_query ("SELECT
tbproyecto.*,
tbcc.nombre_cc
FROM
tbproyecto
INNER JOIN tbcc ON tbcc.id_cc = tbproyecto.id_consejo_comunal

WHERE
tbproyecto.pro_tipo= '$id_tipo_proyecto'");                                             
ob_end_clean();
require_once('../conf/pdf/config/lang/eng.php');
require_once('../conf/pdf/tcpdf.php');
$fecha=date("Y-m-d");
class MIPDF_EXTENDIDA extends TCPDF 
{       
        //Encabezado
        public function Header() 
        {

        }
        // Pi� de P�gina        
        public function Footer() 
        {
                 $this->SetY(-15);
                // Set font
                $this->SetFont('helvetica', 'B', 8);
                // Page number
                $this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        } 
}       

$pdf = new MIPDF_EXTENDIDA('L', 'mm', 'LETTER', true, 'UTF-8', false);  
$pdf->SetHeaderMargin(20);      
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(20);
$pdf->SetTopMargin(20);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);        
$pdf->AddPage();
                
$pdf->Image('../img/cintillo.jpg', 10, 10, 260); 
$pdf->Cell(0,25, utf8_encode('Proyectos por Tipo de Proyecto'), 0, 0, 'C');
$pdf->SetFillColor(220,220,220);
$pdf->SetTextColor(0,0,0);
$pdf->SetDrawColor(0,0,0);
$pdf->SetFont('times','B',8);
$pdf->SetY(30);
$pdf->SetX(5);
$pdf->Ln(8);
$pdf->Cell(8,6,'ID',1,0,'C',1);
$pdf->Cell(100,6,'PROYECTO',1,0,'C',1);
$pdf->Cell(40,6,'TIPO DE PROYECTO',1,0,'C',1);
$pdf->Cell(15,6,'MONTO',1,0,'C',1);
$pdf->Cell(50,6,'CONSEJO COMUNAL',1,0,'C',1);
$pdf->Cell(45,6,'UBICACION',1,0,'C',1);

$pdf->Ln(8);
$pdf->SetFont('times','',8);
$contador=1;
$lineas=1;
while ($registro = mysql_fetch_array($result))
{
        $pdf->MultiCell(8, 5, $registro['id_proyecto'], 0, 'C', 0, 0, '', '', true, 0, false, true, 5, 'T');
        $pdf->MultiCell(100, 5, utf8_encode($registro['pro_nombre']), 0, 'c', 0, 0, '', '', true, 0, false, true, 80, 'T');
        $pdf->MultiCell(40, 5, utf8_encode($registro['pro_tipo']), 0, 'C', 0, 0, '', '', true, 0, false, true, 10, 'T');
        $pdf->MultiCell(15, 5, utf8_encode($registro['pro_monto']), 0, 'C', 0, 0, '', '', true, 0, false, true, 10, 'T');
        $pdf->MultiCell(50, 5, utf8_encode($registro['nombre_cc']), 0, 'C', 0, 0, '', '', true, 0, false, true, 10, 'T');
        $pdf->MultiCell(45, 5, utf8_encode($registro['pro_ubicacion']), 0, 'C', 0, 0, '', '', true, 0, false, true, 10, 'T');
        $pdf->Ln(5);
        if(($contador==26) AND ($filas>1))
        {
                $pdf->AddPage();
                $pdf->SetFillColor(220,220,220);
                $pdf->SetTextColor(0,0,0);
                $pdf->SetDrawColor(0,0,0);
                $pdf->SetFont('times','B',8);
                $pdf->SetY(30);
                $pdf->SetX(5);
                $pdf->Ln(8);
                $pdf->Cell(8,6,'ID',1,0,'C',1);
                $pdf->Cell(100,6,'PROYECTO',1,0,'C',1);
                $pdf->Cell(40,6,'TIPO DE PROYECTO',1,0,'C',1);
                $pdf->Cell(15,6,'MONTO',1,0,'C',1);
                $pdf->Cell(50,6,'CONSEJO COMUNAL',1,0,'C',1);
                $pdf->Cell(45,6,'UBICACION',1,0,'C',1);
                $pdf->Ln(8);
                $pdf->SetFont('times','',8);
                $contador=1;
        }else{  
                $contador++;
                $filas--;
        }
        $lineas ++;
}
$pdf->Output('reporte.pdf', 'I');
?>
</body>
</html>
