<h3><?php echo $model->nama; ?></h3>
<div class="col-lg-6">
    <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/'.$model->id.'s.jpg', CHtml::encode($model->nama), array('width' => '100%')); ?>
    <?php $this->renderPartial('_formimage', array('model'=>$model)); ?>
</div>

<?php $this->renderPartial('_formUpdate', array('model'=>$model)); ?>