<h3>Login</h3>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
        'action' => Yii::app()->createUrl('/site/login'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>


	<div class="row">
            <?php echo $form->labelEx($model, 'hp'); ?>
            <?php echo $form->textField($model, 'hp', array('size' => 12, 'maxlength' => 12, 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'hp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php
                echo CHtml::tag('button', array(
                    'name' => 'btnSubmit',
                    'type' => 'submit',
                    'class' => 'btn btn-success'
                        ), '<i class="glyphicon glyphicon-new-window"></i> Login'
                );

                echo CHtml::tag('a', array(
                    'name' => 'Register',
                    'href' => Yii::app()->createUrl('user/create'),
                    'class' => 'btn btn-default navbar-right'
                        ), '<i class="glyphicon glyphicon-new-window"></i> Register'
                );
                ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
