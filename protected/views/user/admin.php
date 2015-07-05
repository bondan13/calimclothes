
<h1>User</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'user-grid',
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
        'hp',
        'nama',
        array(
            'name' => 'Level',
            'value' => '$data->level',
            'filter' => CHtml::activeTextField($model, 'level'),
            'sortable' => true,
            'htmlOptions' => array(
                'style' => 'width: 100px;'
            )
        ),
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
                    'url' => 'Yii::app()->createUrl("user/view", array("id"=>$data->id))',
                ),
                'edit' => array
                    (
                    'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Edit')),
                    'label' => '<i class="glyphicon glyphicon-edit"></i>',
                    'imageUrl' => false,
                    'url' => 'Yii::app()->createUrl("user/update", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
));
?>
