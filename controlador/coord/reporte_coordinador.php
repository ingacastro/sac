<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<link rel="stylesheet" href="estilos.css" />
<title>Imprimir</title>
</head>
<body>
<?php
$id=$_GET['id'];
include('../../modelo/config.php');
include('../../modelo/consultas.php');
include '../../clases/categoria.php';
include '../../clases/subcategoria.php';
include '../../fpdf/fpdf.php';
class PDF extends FPDF{
function Header(){
    global $id;
    $prim='CONSEJO NACIONAL ELECTORAL';
    $tit='SALA DE ATENCIÓN DE CONTINGENCIAS';
    $ter='ELECCIONES REGIONALES Y MUNICIPALES 2021';
    $cua='21 DE NOVIEMBRE';
    $this->Image('../../imagen/cne.jpeg',10,8,33);
    $this->SetFont('Arial','B',10);
    $this->Cell(180,4, utf8_decode($prim),0,1,'C');
    //$this->Cell(180,4, utf8_decode('COORDINACIÓN DE OFICINAS REGIONALES'),0,1,'C');
    $this->Cell(180,4, utf8_decode($tit),0,1,'C');
    $this->Cell(180,4, utf8_decode($ter),0,1,'C');
    $this->Cell(180,4, utf8_decode($cua),0,0,'C');
    $this->Image('../../imagen/LOGO20MAYO.png',155,8,33);
    $this->SetFont('Arial','B',24);
    $this->Cell(5,5, $id,0,1,'C', '', '../consulta/consContCoord.php?id='.$id);
    $this->Ln(5);
}
    
function Footer(){
    $this->SetY(-10);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,5,'SALA DE ATENCION DE CONTINGENCIAS',0,0,'C');
}

function cont($id, $db){
    $rwCont=consCtgR($db, $id);
    $rwCV=consTM($db, $rwCont['codigo_centro']);
    $rwCrd=consUsu($db, $rwCont['id_coordinador']);
    $this->Cell(20);
    $this->SetFont('Arial','B',9);
    $this->Cell(50, 4, 'ESTADO', 0, 0, 'C');
    $this->Cell(50, 4, 'MUNICIPIO', 0, 0, 'C');
    $this->Cell(50, 4, 'PARROQUIA', 0, 1, 'C');
    $this->Cell(20);
    $this->SetFont('Arial','',9);
    $this->Cell(50, 4, $rwCV['des_estado'], 0, 0, 'C');
    $this->Cell(50, 4, $rwCV['des_municipio'], 0, 0, 'C');
    $this->Cell(50, 4, $rwCV['des_parroquia'], 0, 1, 'C');
    $this->Cell(10);
    $this->SetFont('Arial','B',9);
    $this->Cell(40, 5, utf8_decode('CÓDIGO DEL CENTRO'), 0, 0, 'C');
    $this->Cell(20);
    $this->Cell(50, 5, utf8_decode('CENTRO DE VOTACIÓN'), 0, 1, 'C');
    $this->Cell(10);
    $this->SetFont('Arial','',10);
    $this->Cell(40, 5, $rwCont['codigo_centro'], 0, 0, 'C');
    $this->Cell(50, 5, $rwCV['nombre'], 0, 1, 'L');
    $this->SetFont('Arial','B',9);
    $this->Cell(60);
    $this->Cell(50, 5, utf8_decode('DIRECCIÓN'), 0, 1, 'C');
    $this->SetFont('Arial','',9);
    $this->MultiCell(180, 4, $rwCV['direccion'],  0, 'C', false);
    $this->SetFont('Arial','B',9);
    $this->Cell(60);
    $this->Cell(50, 5, utf8_decode('COORDINADOR'), 0, 1, 'C');
    $this->SetFont('Arial','',9);
    $this->Cell(20);
    $this->Cell(30, 5, $rwCrd['nombre_usuario']);
    $this->Cell(30, 5, $rwCrd['telefono']);
    $this->Cell(20, 5, date("g:i a", strtotime($rwCont['hora_coordinador'])), 0, 1, 'C');
    $this->Cell(60);
    $this->SetFont('Arial','B',10);
    $this->Cell(50, 7, 'CONTINGENCIA', 0, 1, 'C');
    $this->SetFont('Arial','',9);
    $cat=cont_cat($id);
if($cat[0]['cat']==0){
    $this->Cell(80, 5,"OTROS", 0, 1, 'C');
}else{
    $x=0;
    $y=0;
    for($i=0; $i<count($cat); $i++){
        $db=conectar();
        $c=$cat[$i]['cat'];
        $s=$cat[$i]['sub'];
        $rwCat=consCatD($db, $c);
        $rwSub=consSubD($db, $s);
        $this->Cell(80, 5,$rwSub->desub, 0, 1, 'C');
    }
}
    $this->Cell(80);
    $this->SetFont('Arial','B',9);
    $this->Cell(30, 5, utf8_decode('DESCRIPCIÓN'), 0, 1, 'C');
    $this->SetFont('Arial','',9);
    $descCont=str_replace("\n", "; ", utf8_encode($rwCont['descripcion_contingencia']));
    $this->MultiCell(190, 4, utf8_decode($descCont), 1, 'C', false);

    $qAsCon="select * from asignacioncont where id_contingencia=$id";
    $rsAC=$db->query($qAsCon);
    if($rsAC->rowCount()>=1){
        $this->SetFont('Arial','B',9);
        $this->Cell(60);
        $this->Cell(50, 5, utf8_decode('ASIGNACIÓN'), 0, 1, 'C');
        $this->Cell(15);
        $this->Cell(30, 5, 'FUNCIONARIO', 0, 0, 'C');
        $this->Cell(15);
        $this->Cell(30, 5, 'OFICINA', 0, 0, 'C');
        $this->Cell(15);
        $this->Cell(30, 5, utf8_decode('TELÉFONO'), 0, 0, 'C');
        $this->Cell(15);
        $this->Cell(20, 5, 'VPN', 0, 1, 'C');

    while($rwAC=$rsAC->fetch(PDO::FETCH_BOTH)){
        $qFunc="select * from funcionario where ID=$rwAC[id_funcionario]";
        $rsF=$db->query($qFunc);
        $rwF=$rsF->fetch(PDO::FETCH_BOTH);
        $qO="select * from contingente where id=$rwF[relacion]";
        $rsO=$db->query($qO);
        $rwO=$rsO->fetch(PDO::FETCH_BOTH);
        $qvpn="select * from vpn where idvpn=$rwAC[idvpn]";
        $rsvpn=$db->query($qvpn);
        $rwvpn=$rsvpn->fetch(PDO::FETCH_BOTH);
        $this->SetFont('Arial','',8);
        $this->Cell(15);
        $this->Cell(30, 4, $rwF['opcion'], 0, 0, 'C');
        $this->Cell(15);
        $this->Cell(30, 4, $rwO['opcion'], 0, 0, 'C');
        $this->Cell(15);
        $this->Cell(30, 4, $rwF['celular'], 0, 0, 'C');
        $this->Cell(15);
        $this->Cell(20, 4, $rwvpn['vpn'], 0, 1, 'C');
    }

    }else{
        $this->Cell(60);
        $this->Cell(30, 5, 'SIN FUNCIONARIO(S) ASIGNADO(S)', 0, 0, 'C');
        $this->Ln();
    }
    $this->SetFont('Arial','B',9);
    $this->Cell(60);
    $this->Cell(50, 5, 'RESULTADOS', 0, 1, 'C');
    $this->SetFont('Arial','',9);
    $this->Cell(40);
    $rsRes=consSRes($db, $id);
    
    if($rsRes->rowCount()>0){
        $catRes=cont_catRes($db, $id);
        $x=0;
        for($i=0; $i<count($catRes); $i++){
            $c=$catRes[$i]['cat'];
            $s=$catRes[$i]['sub'];
            $rwCat=consCatD($db, $c);
            $rwSub=consSubD($db, $s);
            if($c!=$x){
                $this->Cell(70, 5, $rwCat->desc, 0, 1, 'L');
                $x=$c;
            }
            $this->Cell(70, 5, $rwCat->desc, 0, 1, 'L');
        }
    }else{
        $this->Cell(30, 5, 'Marque la(s) contingencia(s) encontradas en el centro', 0, 1, 'L');
        $qCtRs="select * from subcategoria";
        $rsCtRs=$db->query($qCtRs);
        $ctaCtRs=$rsCtRs->rowCount();
        $m=0;
        $n=0;
        for($k=0; $k<$ctaCtRs; $k++){
            $l=$k+1;
            $qSbRs="select * from subcategoria where idsubcat=$l";
            $rsSbRs=$db->query($qSbRs);
            $rwSbR=$rsSbRs->fetch(PDO::FETCH_BOTH);
            $this->SetFont('Arial','',8);
            if(strlen($rwSbR['desubabv'])>50){
                $this->Cell(5, 5, '', 1,0,'C');
                $this->Cell(70, 5, $rwSbR['desubabv'], 0, 1, 'L');
                $m=0;
            }else if(strlen($rwSbR['desubabv'])<=50 && strlen($rwSbR['desubabv'])>40){
                $this->Cell(5, 5, '', 1,0,'C');
                $this->Cell(60, 5, $rwSbR['desubabv'], 0, 1, 'L');
                $m=0;
            }else if(strlen($rwSbR['desubabv'])<=40 && $m==2){
                $this->Cell(5, 5, '', 1,0,'C');
                $this->Cell(50, 5, $rwSbR['desubabv'], 0, 1, 'L');
                $m++;
            }else if($m<3){
                $this->Cell(5, 5, '', 1,0,'C');
                $this->Cell(50, 5, $rwSbR['desubabv'], 0, 0, 'L');
                $this->Cell(4);
                $m++;
        }
    }
        $this->Ln();
        $this->SetFont('Arial','B',9);
        $this->Cell(10);
        $this->Cell(10, 4, 'NOTA: ', 0, 0, 'C');
        $this->SetFont('Arial','',9);
        $this->Cell(140, 4, utf8_decode('Una vez identificadas las contingencias encontradas; debe describir la situación y solución dada.-'), 0, 1, 'C');
        }
    }
}

$db=conectar();
ob_clean();
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->cont($id, $db);
$pdf->Output();

?>
