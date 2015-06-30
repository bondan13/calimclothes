<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div class="row clearfix">
    
    <div class="col-lg-3">
        <?php if (!Yii::app()->user->isGuest) { ?>
         <div class="sidebar">
            <h4 class="widget-title">
                <?php echo strtoupper(Yii::app()->user->getState('nama',null)); ?>
            </h4>
             
            <a href="<?php echo Yii::app()->createUrl('site/logout'); ?>">LOG OUT</a>
            <br />
            <br />
        </div>
        <?php } ?>
        <div class="sidebar">
            <h4 class="widget-title">
                Product Categories
            </h4>
            <ul class="product-categories">
                <?php
                    $dataProvider = new CActiveDataProvider('Kategori');
                    $dataProvider->pagination->pageSize = 12;
                    $this->widget('zii.widgets.CListView', array(
                    'dataProvider'=>$dataProvider,
                    'itemView'=>'application.views.kategori._view',
                    //'page_size'=>16,
                    'template'=>'{items}',
                )); ?>
            </ul>
        </div>
        <div class="sidebar" style="color:#515151;">
        <h4 class="widget-title">Hubungi Kami</h4>
        <small>
            Moose Believer
            <br />
            Distribution Center & Store
            Jl Perdana Blok I/11, Jaksel
            Indonesia
            <br /><br />
            Online Store<br />
            Phone: 087888027573<br />
            Whatsapp: 087771419430<br />
            Blackberry: 79D7F738<br />
            <br />
            order@mooseblvr.com
        </small>
        </div>
        
    </div>
    
    <div class="col-lg-9">
	<?php echo $content; ?>
    </div>
</div>

<?php $this->endContent(); ?>