<?php
    Yii::app()->clientScript->registerScript('cilckarea', '
                    $(document).on("click",".view",function() {
                      window.location = $(this).find("a").attr("href"); 
                      return false;
                    });

    ', CClientScript::POS_READY);
?>
<div class="row clearfix">
    <div class="col-lg-4">
        <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/default-image-items.jpg', CHtml::encode($model->nama), array('width' => '100%')); ?>
    </div>
    <div class="col-lg-8">
        <h1 id="title">
            <?php echo $model->nama; ?>
        </h1>
        <div class="hargadetail">
            <?php echo $model->hargaRupiah(); ?>
            <br /><br />
            <?php if (Yii::app()->user->hasFlash('error')){ ?>
            <span class="label label-danger"><?php echo Yii::app()->user->getFlash('error'); ?></span>
            <?php } ?>
        </div>
        
        <div class="row clearfix">
            
            <form method="POST" action="<?php echo Yii::app()->createUrl('transaksi/order'); ?>">
            <input type="hidden" name="Transaksi[barang_id]" class="form-control" value="<?php echo $model->id; ?>">
            <div class="col-lg-4">
                <small>Select Size</small>
                <?php
                echo CHtml::dropDownList('Transaksi[ukuran]', 'F', array('s' => 'S --- (stok ' . $model->s_stok . ')',
                    'm' => 'M --- (stok ' . $model->m_stok . ')',
                    'l' => 'L --- (stok ' . $model->l_stok . ')',
                    'xl' => 'XL --- (stok ' . $model->xl_stok . ')',
                    'az' => 'All Size --- (stok ' . $model->allsize_stok . ')',
                        ), array('class' => 'form-control'));
                ?>
            </div>
            <div class="col-lg-4">
                <small>Quantity</small>
                <input type="text" name="Transaksi[jumlahitem]" class="form-control">
            </div>
            <div class="col-lg-4">
                <small></small><br>
                <button type="submit" class="btn btn-success btn-block"><i class="glyphicon glyphicon-shopping-cart"></i> Add To Cart</button>
            </div>
            </form>
        </div>
        <hr>
        <i class="glyphicon glyphicon-comment"></i>  <b>Description</b>
        <br />
        <div class="deskripsi">
            <?php echo $model->deskripsi; ?>
        </div>
        <br />
    </div>
</div>
<br /><br />
<div class="sidebar">
    <h4 class="widget-title">
        Produk Terbaru
    </h4>
    <div style="padding-left: 50px; border-bottom: 2px solid #F15A23; height: 250px;">
        <?php
        $dataProvider = new CActiveDataProvider('Barang');
        $dataProvider->pagination->pageSize = 5;
        $dataProvider->sort->defaultOrder = 'id DESC';
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_view',
            //'page_size'=>16,
            'template'=>'{items}',
        )); ?>
    </div>
</div>