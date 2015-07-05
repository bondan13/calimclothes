<?php
/* @var $this TransaksiController */
/* @var $data Transaksi */
?>
<div class="transaksiall">
    <a href="<?php echo Yii::app()->createUrl('transaksi/invoice',array('id'=>$data->invoice_id)); ?>"></a>
	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_id')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->barang->nama); ?></b>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jumlah')); ?>:</b>
	<?php echo CHtml::encode($data->jumlah); ?>


	<b>Harga</b>
	<?php echo CHtml::encode($data->totalHarga()); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status()); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_bayar')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_bayar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_kirim')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_kirim); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resi')); ?>:</b>
	<?php echo CHtml::encode($data->resi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('size')); ?>:</b>
	<?php echo CHtml::encode($data->size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keterangan')); ?>:</b>
	<?php echo CHtml::encode($data->keterangan); ?>
	<br />

	*/ ?>
</div>
<hr>