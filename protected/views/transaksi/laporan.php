<div class="col-lg-6">

<center><h3><i class="glyphicon glyphicon-book"></i> Laporan Penjualan</h3>

    <form method="POST">
        <input id="Report_datestart" type="hidden" name="Report[date_start]">
        <input id="Report_dateend" type="hidden" name="Report[date_end]">
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'tanggal1',
            'value' => '',
            //'model'=>$model,
            //'attribute'=>'tanggal',
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'clip',
                'altFormat' => 'yy-mm-dd',
                'altField' => '#Report_datestart', //id hidden form = Formulir_tanggal
                'dateFormat' => 'd MM yy',
                //'showButtonPanel'=>true,
                'changeMonth' => true,
                'changeYear' => true,
            //'yearRange'=>'-80:-16',
            //'todayBtn'=>true,
            //'disabled'=>true,
            ),
            'htmlOptions' => array(
                //'class' => 'form-control',
                'placeholder'=>'  Tanggal'
            ),
        ));
        ?>
        <sup>s/d</sup>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'tanggal2',
            'value' => '',
            //'model'=>$model,
            //'attribute'=>'tanggal',
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'clip',
                'altFormat' => 'yy-mm-dd',
                'altField' => '#Report_dateend', //id hidden form = Formulir_tanggal
                'dateFormat' => 'd MM yy',
                //'showButtonPanel'=>true,
                'changeMonth' => true,
                'changeYear' => true,
            //'yearRange'=>'-80:-16',
            //'todayBtn'=>true,
            //'disabled'=>true,
            ),
            'htmlOptions' => array(
                //'class' => 'form-control',
                'placeholder'=>'  Tanggal'
                
            ),
        ));

        foreach(Yii::app()->user->getFlashes() as $key => $message) {
            echo '<div class="flash-' . $key . '">' . $message . "</div>";
        }
        ?>
        <br /><br />
        <input type="submit" value="Lihat Laporan" class="btn btn-success btn-sm">
    </form>

</center>
</div>
<div class="col-lg-6">

<center><h3><i class="glyphicon glyphicon-book"></i> Laporan Stok Barang</h3>
    <?php echo date("d M Y H:i:s"); ?>
        <br />
    <br />
    <a href="<?php echo Yii::app()->createUrl('/barang/stock'); ?>" class="btn btn-success btn-sm">Lihat Laporan</a>

</center>
</div>
