<?php
    $this->pageTitle=Yii::app()->name;
?>
<?php echo CHtml::link('Create User',array('user/create'), array('class'=>'btn btn-success')); ?>
<br /><br />
<?php echo CHtml::link('Create Barang',array('barang/create'), array('class'=>'btn btn-success')); ?>
<br /><br />
<?php echo CHtml::link('Create Kategori',array('kategori/create'), array('class'=>'btn btn-success')); ?>
