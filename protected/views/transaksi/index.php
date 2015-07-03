<h3>Pembelian</h3>

<?php 
    Yii::app()->clientScript->registerScript('transaksiall', '
                    $(document).on("click",".transaksiall",function() {
                      window.location = $(this).find("a").attr("href"); 
                      return false;
                    });

    ', CClientScript::POS_READY);
    
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
