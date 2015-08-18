<?php
require_once 'fpdf/fpdf.php';
$datas = array();
$i=1;

foreach ($barang as $data){

    //$partdata = array();
    $total = $data->s_stok + $data->m_stok + $data->l_stok + $data->xl_stok + $data->allsize_stok;
    $partdata = array($i,$data->nama,$data->s_stok, $data->m_stok, $data->l_stok, $data->xl_stok, $data->allsize_stok,$total);

    array_push($datas,$partdata);
    $i++;
}


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,5,$judul,0,1,'C');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,10,date('d M Y H:i:s'),0,1,'C');

$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(139,69,13);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(222,184,135);
foreach ($header as $kolom){
    $pdf->Cell($kolom['length'],5,$kolom['label'],1,0,$kolom['align'],true);
}
$pdf->Ln();

$pdf->SetFillColor(245,222,179);
$pdf->SetTextColor(0);
$pdf->SetFont('');
$fill = false; 
foreach ($datas as $e){
    $i = 0;
    
    foreach ($e as $value) {
        
        $pdf->Cell($header[$i]['length'],5,$value,1,0,'C',$fill);
        $i++;
    }
    
    $fill = !$fill;
    $pdf->Ln();
}
$pdf->Ln();

$pdf->Output();
?>

