<?php 
    Yii::app()->clientScript->registerScript('cilckarea', '
                    $(document).on("click",".view",function() {
                      window.location = $(this).find("a").attr("href"); 
                      return false;
                    });

    ', CClientScript::POS_READY);

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
        //'page_size'=>16,
        'template'=>'{summary}{items}<hr><div align="center">{pager}</div>',
)); ?>
