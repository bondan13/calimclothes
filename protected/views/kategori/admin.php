<div class="row clearfix">
    <div class="col-lg-6">
    <h3>Katagori</h3>
    </div>
    <div class="col-lg-6">
        <div class="navbar navbar-right">
            <?php echo CHtml::link('Tambah Katagori Baru <i class="glyphicon glyphicon-plus-sign"></i>','create',array('class'=>'btn btn-success')); ?>
        </div>
    </div>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'kategori-grid',
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
            'name' => 'nama',
            'value' => '$data->nama',
            'filter' => CHtml::activeTextField($model, 'nama'),
            'sortable' => true,
            'htmlOptions' => array(
                'style' => 'width: 730px;'
            )
        ),
        array
            (
            'class' => 'CButtonColumn',
            'template' => '{edit}',
            'buttons' => array
                (
                'edit' => array
                    (
                    'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Edit')),
                    'label' => '<i class="glyphicon glyphicon-edit"></i>',
                    'imageUrl' => false,
                    'url' => 'Yii::app()->createUrl("kategori/update", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
));
?>
