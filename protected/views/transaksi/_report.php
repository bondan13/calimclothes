<?php 

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
$criteriaAllSize->compare('size', 'AllSize');
$criteriaAllSize->select = 'sum(jumlah) AS countAllSize';

$itemS = Transaksi::model()->findAll($criteriaS);
$itemM = Transaksi::model()->findAll($criteriaM);
$itemL = Transaksi::model()->findAll($criteriaL);
$itemXL = Transaksi::model()->findAll($criteriaXL);
$itemAllSize = Transaksi::model()->findAll($criteriaAllSize);

echo @$itemS[0]->countS;
echo '<br /';
echo @$itemM[0]->countM;
echo '<br /';
echo @$itemL[0]->countL;
echo '<br /';
echo @$itemXL[0]->countXL;
echo '<br /';
echo @$itemAllSize[0]->countAllSize;
echo '<br /';



