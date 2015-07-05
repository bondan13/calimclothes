<?php
/* @var $this BarangController */
/* @var $data Barang */
?>

<div class="view">
    <a href="<?php echo Yii::app()->createUrl('barang/view',array('id'=>$data->id)); ?>">
        <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/'.$data->id.'s.jpg', CHtml::encode($data->nama), array('width'=>'174')); ?>
    </a>
    <br />
    <div class="titlebox">
        <h3 class="judul"><?php echo CHtml::encode($data->namaSubstr()); ?></h3>
    </div>
    <div class="harga"><?php echo CHtml::encode($data->hargaRupiah()); ?></div>
    <?php //echo $data->kategori->nama; 
    ?>
</div>