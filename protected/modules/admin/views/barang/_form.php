<?php
/* @var $this BarangController */
/* @var $model Barang */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'barang-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nama'); ?>
		<?php echo $form->textField($model,'nama',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nama'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deskripsi'); ?>
		<?php echo $form->textArea($model,'deskripsi',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'deskripsi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'harga'); ?>
		<?php echo $form->textField($model,'harga',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'harga'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'berat'); ?>
		<?php echo $form->textField($model,'berat'); ?>
		<?php echo $form->error($model,'berat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_stok'); ?>
		<?php echo $form->textField($model,'s_stok'); ?>
		<?php echo $form->error($model,'s_stok'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'m_stok'); ?>
		<?php echo $form->textField($model,'m_stok'); ?>
		<?php echo $form->error($model,'m_stok'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'l_stok'); ?>
		<?php echo $form->textField($model,'l_stok'); ?>
		<?php echo $form->error($model,'l_stok'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'xl_stok'); ?>
		<?php echo $form->textField($model,'xl_stok'); ?>
		<?php echo $form->error($model,'xl_stok'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'allsize_stok'); ?>
		<?php echo $form->textField($model,'allsize_stok'); ?>
		<?php echo $form->error($model,'allsize_stok'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kategori_id'); ?>
		<?php echo $form->textField($model,'kategori_id'); ?>
		<?php echo $form->error($model,'kategori_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->