<?php
/* @var $this BarangController */
/* @var $data Barang */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama')); ?>:</b>
	<?php echo CHtml::encode($data->nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deskripsi')); ?>:</b>
	<?php echo CHtml::encode($data->deskripsi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('harga')); ?>:</b>
	<?php echo CHtml::encode($data->harga); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('berat')); ?>:</b>
	<?php echo CHtml::encode($data->berat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('s_stok')); ?>:</b>
	<?php echo CHtml::encode($data->s_stok); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('m_stok')); ?>:</b>
	<?php echo CHtml::encode($data->m_stok); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('l_stok')); ?>:</b>
	<?php echo CHtml::encode($data->l_stok); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('xl_stok')); ?>:</b>
	<?php echo CHtml::encode($data->xl_stok); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('allsize_stok')); ?>:</b>
	<?php echo CHtml::encode($data->allsize_stok); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kategori_id')); ?>:</b>
	<?php echo CHtml::encode($data->kategori_id); ?>
	<br />

	*/ ?>

</div>