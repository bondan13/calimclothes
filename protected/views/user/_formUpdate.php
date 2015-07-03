<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        //'enableClientValidation'=>true,
)); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'nama'); ?>
        <?php echo $form->textField($model, 'nama', array('size' => 32, 'maxlength' => 32, 'class' => 'form-control')); ?>
        <?php echo $form->hiddenField($model, 'wilayah_id', array('size' => 8, 'maxlength' => 8)); ?>
        <?php echo $form->error($model, 'nama'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'alamat'); ?>
        <?php echo $form->textArea($model, 'alamat', array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'alamat'); ?>
    </div>
       <div class="row">
        <?php echo $form->labelEx($model, 'kota');
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'value' => $model->wilayah->kota_kabupaten, //Sumber dari tabel Relasi Kota 
            'name'=>'kota',
            'id' => '01',
            'source' => $this->createUrl('user/suggestcity'), // url untuk mengambil daftar city  
            // additional javascript options for the autocomplete plugin  
            'options' => array(
                'minLength' => '1', // min character untuk memulai pencarian  
                'showAnim' => 'fold',
                'select' => 'js:function( event, ui ) {
                    $("#01")
                            .val(ui.item.value);
                            $("#02")
                              .val("");
                            $("#02").removeAttr("disabled");
                            $.ajax({
                                    type:"GET",
                                    url:"'.Yii::app()->createUrl('user/setselectedkota').'",
                                    data: {selected:ui.item.value},
                                    success:function(data) {}
                              });
                            return false;
                    }',
            ),
            'htmlOptions' => array(
                'class' => 'form-control',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'kota'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'kecamatan'); ?>
        <?php
           $this->widget('zii.widgets.jui.CJuiAutoComplete', array(  
           'value' => $model->wilayah->kecamatan, //Sumber dari tabel Relasi Kota 
           'name'=>'kabupaten',
           'id'=>'02',	
           'source'=>$this->createUrl('user/suggestIdWilayah'), // url untuk mengambil daftar city  
           // additional javascript options for the autocomplete plugin  
           'options'=>array(  
               'minLength'=>'1', // min character untuk memulai pencarian  
                                   'showAnim'=>'fold',
                                   'select'=>'js:function( event, ui ) {
                                                    $("#User_wilayah_id")
                                                     .val(ui.item.id);
                                                    $("#02")
                                                     .val(ui.item.value);
                                                     return false;
                                                    }',
           ),  
                           'htmlOptions'=>array(
                                   'class'=>'form-control',
                                   
                           ),
           )); 
        ?>
        <?php echo $form->error($model, 'kecamatan'); ?>
        
        <?php echo $form->error($model, 'wilayah_id'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'hp'); ?>
        <?php echo $form->textField($model, 'hp', array('size' => 12, 'maxlength' => 12, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'hp'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Save', array('class'=>'btn btn-success')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->