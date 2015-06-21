<?php
/* @var $this BarangController */
/* @var $model Barang */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama'); ?>
		<?php echo $form->textField($model,'nama',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deskripsi'); ?>
		<?php echo $form->textArea($model,'deskripsi',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'harga'); ?>
		<?php echo $form->textField($model,'harga',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'berat'); ?>
		<?php echo $form->textField($model,'berat'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'s_stok'); ?>
		<?php echo $form->textField($model,'s_stok'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'m_stok'); ?>
		<?php echo $form->textField($model,'m_stok'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'l_stok'); ?>
		<?php echo $form->textField($model,'l_stok'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'xl_stok'); ?>
		<?php echo $form->textField($model,'xl_stok'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'allsize_stok'); ?>
		<?php echo $form->textField($model,'allsize_stok'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kategori_id'); ?>
		<?php echo $form->textField($model,'kategori_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->