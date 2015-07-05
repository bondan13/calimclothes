<?php
/* @var $this BarangController */
/* @var $model Barang */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'barang-form',
            'action'=>Yii::app()->createUrl('barang/updategambar',array('id'=>$model->id)),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
    ?>
    
    <div class="row">
        <?php echo $form->fileField($model, 'gambar', array('class'=>'btn btn-default btn-sm')); ?>
        <?php echo CHtml::submitButton('Update Gambar', array('class'=>'btn btn-success btn-sm')); ?>
    </div>


<?php $this->endWidget(); ?>

</div><!-- form -->