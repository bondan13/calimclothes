<h3>Profile</h3>
<?php if (Yii::app()->user->hasFlash('save')) { ?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?php echo Yii::app()->user->getFlash('save'); ?>
</div>
<?php } ?>

<?php $this->renderPartial('_formUpdateAdmin', array('model'=>$model)); ?>