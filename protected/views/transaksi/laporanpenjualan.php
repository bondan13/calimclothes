<?php
require_once 'fpdf/fpdf.php';
$datas = array();
foreach ($transaksi as $data){
    $partdata = array();
    $criteriaS = new CDbCriteria(); 
    $criteriaS->compare('barang_id', $data['barang_id']);
    $criteriaS->addBetweenCondition('tanggal',$date['Report']['date_start'],$date['Report']['date_end']);
    $criteriaS->compare('status', 5);
    $criteriaS->compare('size', 'S');
    $criteriaS->select = 'sum(jumlah) AS countS';

    $criteriaM = new CDbCriteria(); 
    $criteriaM->compare('barang_id', $data['barang_id']);
    $criteriaM->addBetweenCondition('tanggal',$date['Report']['date_start'],$date['Report']['date_end']);
    $criteriaM->compare('status', 5);
    $criteriaM->compare('size', 'M');
    $criteriaM->select = 'sum(jumlah) AS countM';

    $criteriaL = new CDbCriteria(); 
    $criteriaL->compare('barang_id', $data['barang_id']);
    $criteriaL->addBetweenCondition('tanggal',$date['Report']['date_start'],$date['Report']['date_end']);
    $criteriaL->compare('status', 5);
    $criteriaL->compare('size', 'L');
    $criteriaL->select = 'sum(jumlah) AS countL';

    $criteriaXL = new CDbCriteria(); 
    $criteriaXL->compare('barang_id', $data['barang_id']);
    $criteriaXL->addBetweenCondition('tanggal',$date['Report']['date_start'],$date['Report']['date_end']);
    $criteriaXL->compare('status', 5);
    $criteriaXL->compare('size', 'XL');
    $criteriaXL->select = 'sum(jumlah) AS countXL';

    $criteriaAllSize = new CDbCriteria(); 
    $criteriaAllSize->compare('barang_id', $data['barang_id']);
    $criteriaAllSize->addBetweenCondition('tanggal',$date['Report']['date_start'],$date['Report']['date_end']);
    $criteriaAllSize->compare('status', 5);
    $criteriaAllSize->compare('size', 'AZ');
    $criteriaAllSize->select = 'sum(jumlah) AS countAllSize';

    $itemS = Transaksi::model()->findAll($criteriaS);
    $itemM = Transaksi::model()->findAll($criteriaM);
    $itemL = Transaksi::model()->findAll($criteriaL);
    $itemXL = Transaksi::model()->findAll($criteriaXL);
    $itemAllSize = Transaksi::model()->findAll($criteriaAllSize);
    $barangnama = Barang::model()->findByPk($data['barang_id']);
    $total = $itemS[0]['countS']+$itemM[0]['countM']+$itemL[0]['countL']+$itemXL[0]['countXL']+$itemAllSize[0]['countAllSize'];
    $partdata = array($data['barang_id'],$barangnama->nama,$itemS[0]['countS'],$itemM[0]['countM'],$itemL[0]['countL'],$itemXL[0]['countXL'],$itemAllSize[0]['countAllSize'],$total);

    array_push($datas,$partdata);
}

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

