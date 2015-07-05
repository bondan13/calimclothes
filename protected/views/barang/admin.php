<div class="row clearfix">
    <div class="col-lg-6">
    <h3>Barang</h3>
    </div>
    <div class="col-lg-6">
        <div class="navbar navbar-right">
            <?php echo CHtml::link('Tambah Barang Baru <i class="glyphicon glyphicon-plus-sign"></i>','create',array('class'=>'btn btn-success')); ?>
        </div>
    </div>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'barang-grid',
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
            'name' => 'gambar',
            'type' => 'html',
            'value' => 'CHtml::image(Yii::app()->request->baseUrl . "/images/".$data->id."s.jpg", CHtml::encode($data->nama), array("width"=>"100"))',
            'htmlOptions' => array(
                'style' => 'width: 100px;'
            )
        ),
        array(
            'name' => 'nama',
            'value' => '$data->nama',
            'filter' => CHtml::activeTextField($model, 'nama'),
            'sortable' => true,
            'htmlOptions' => array(
                'style' => 'width: 500px;'
            )
        ),
        'harga',
        /*
          'm_stok',
          'l_stok',
          'xl_stok',
          'allsize_stok',
          'kategori_id',
         */
        array
            (
            'class' => 'CButtonColumn',
            'template' => '{view}&nbsp;&nbsp;&nbsp;{edit}',
            'buttons' => array
                (
                'view' => array
                    (
                    'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'View')),
                    'label' => '<i class="glyphicon glyphicon-eye-open"></i>',
                    'imageUrl' => false,
                    'url' => 'Yii::app()->createUrl("barang/view", array("id"=>$data->id))',
                ),
                'edit' => array
                    (
                    'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Edit')),
                    'label' => '<i class="glyphicon glyphicon-edit"></i>',
                    'imageUrl' => false,
                    'url' => 'Yii::app()->createUrl("barang/update", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
));
?>
