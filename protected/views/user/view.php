<h1><?php echo $model->nama; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'level',
        'hp',
        'nama',
        'alamat',
        array(
            'label' => 'Kota / Kabupaten',
            'value' => $model->wilayah->kota_kabupaten,
        ),
        array(
            'label' => 'Kecamatan',
            'value' => $model->wilayah->kecamatan,
        ), 
        array(
            'label' => 'Total transaksi',
            'value' => $model->alltransaksi.' Transaksi pembelian',
        ),
    ),
));
?>
