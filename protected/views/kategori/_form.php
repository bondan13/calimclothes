<?php
/* @var $this KategoriController */
/* @var $model Kategori */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kategori-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nama'); ?>
		<?php echo $form->textField($model,'nama',array('size'=>45,'maxlength'=>45, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'nama'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->