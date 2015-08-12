<?php
require_once 'fpdf/fpdf.php';
$datas = array();
$i=1;
$t=0;
foreach ($transaksi as $data){

    //$partdata = array();
    $subtotal = $data['jumlah']*$data['barang']['harga'];
    $rupiahsubtotal =  'Rp. '.number_format($subtotal,0,',','.');
    $partdata = array($i,$data['user']['nama'],$data['invoice_id'],Yii::app()->dateFormatter->format("dd-MM-y",strtotime($data['tanggal'])),$data['barang']['nama'],$data['jumlah'],  'Rp. '.number_format($data['barang']['harga'],0,',','.'),$rupiahsubtotal);

    array_push($datas,$partdata);
    $i++;
    $t = $t+$subtotal;
}
$total = 'Rp. '.number_format($t,0,',','.');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,5,$judul,0,1,'C');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,10,'Periode '.$date['tanggal1'].' s/d '.$date['tanggal2'],0,1,'C');

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


//foreach ($transaksi as $data){
//    $this->renderPartial('_report',array('data'=>$data->attributes,'date'=>$date, 'pdf'=>$pdf));
//}
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,'Total = '.$total.',-',0,1,'R');
$pdf->Ln();
$pdf->Output();

//Yii::import("application.extensions.fpdf.SGOPlusCurl");
//var_dump($date['Report']['date_start']);
//var_dump($date['Report']['date_end']);
//var_dump($date['tanggal1']);
//var_dump($date['tanggal2']);
//
//$this->widget('zii.widgets.CListView', array(
//	'dataProvider'=>$dataProvider,
//	'itemView'=>'_report',
//        'viewData' => array( 'date' => $date),
//)); ?>

