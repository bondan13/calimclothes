<h3>Transaksi</h3>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'transaksi-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'ID',
            'value' => '$data->id',
            'filter' => CHtml::activeTextField($model, 'id'),
            'sortable' => true,
            'htmlOptions' => array(
                'style' => 'width: 50px;'
            )
        ),
        array(
            'name' => 'Tanggal',
            'value'=>'Yii::app()->dateFormatter->format("y-MM-dd",strtotime($data->tanggal))',
            'filter' => CHtml::activeTextField($model, 'tanggal'),
            'sortable' => true,
            'htmlOptions' => array(
                'style' => 'width: 80px;'
            )
        ),
        array(
            'name' => 'Invoice',
            'value' => '$data->invoice_id',
            'filter' => CHtml::activeTextField($model, 'invoice_id'),
            'sortable' => true,
            'htmlOptions' => array(
                'style' => 'width: 50px;'
            )
        ),
        array(
            'name' => 'usernama',
            'value' => '$data->user->nama',
            'filter' => CHtml::activeTextField($model, 'usernama'),
            'sortable' => true,
        ),
        array(
            'name' => 'barangnama',
            'value' => '$data->barang->nama',
            'filter' => CHtml::activeTextField($model, 'barangnama'),
            'sortable' => true,
        ),
        array(
            'name' => 'Jumlah',
            'value' => '$data->jumlah',
            'filter' => CHtml::activeTextField($model, 'jumlah'),
            'sortable' => true,
            'htmlOptions' => array(
                'style' => 'width: 50px;'
            )
        ),
        array(
            'name' => 'status',
            'value' => '"(".$data->status.") ".$data->status()',
            'filter' => CHtml::activeTextField($model, 'status'),
            'sortable' => true,
            'htmlOptions' => array(
                'style' => 'width: 100px;'
            )
        ),
        /*
          'total_harga',
          'status',
          'tanggal_bayar',
          'tanggal_kirim',
          'tanggal',
          'resi',
          'size',
          'keterangan',
         */
        array
            (
            'class' => 'CButtonColumn',
            'template' => '{view}',
            'buttons' => array
                (
                'view' => array
                    (
                    'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'View')),
                    'label' => '<i class="glyphicon glyphicon-eye-open"></i>',
                    'imageUrl' => false,
                    'url' => 'Yii::app()->createUrl("transaksi/invoice", array("id"=>$data->invoice_id))',
                ),
            ),
        ),
    ),
));
?>
