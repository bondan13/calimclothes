<div class="row clearfix">
    <div class="col-lg-8">
        <a href="<?php echo Yii::app()->createUrl('barang/view', array('id' => $data->barang->id)); ?>"><?php echo strtoupper($data->barang->nama); ?></a>
    </div>
    <div class="col-lg-1">
        <?php echo CHtml::encode($data->berat); ?>
    </div>
    <div class="col-lg-1">
        <?php echo CHtml::encode($data->jumlah); ?>
    </div>
    <div class="col-lg-2">
        <div style="float: right;">
        <?php echo CHtml::encode($data->totalHarga()); ?>
        <?php if($data->status == 0) { ?>
            <a href="<?php echo Yii::app()->createUrl('transaksi/deletea/',array('id'=>$data->id)); ?>" ><i class="glyphicon glyphicon-trash"></i></a>
        <?php } ?>
        </div>
    </div>
</div>


