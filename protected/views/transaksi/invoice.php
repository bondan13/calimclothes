<h3>
INVOICE <?php echo $invoice->invoice_id; ?>
</h3>
<hr>
<div class="row clearfix">
    <div class="col-lg-8">
        <b>Barang</b>
    </div>
    <div class="col-lg-1">
        <b>Berat</b>
    </div>
    <div class="col-lg-1">
        <b>Jumlah</b>
    </div>
        <div class="col-lg-2">
            <b>Harga</b>
    </div>
</div>
<?php
    $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataprovider,
            'itemView'=>'_invoice',
            //'page_size'=>16,
            'template'=>'{items}',
    )); 
?>
<hr>
<div class="row clearfix">
    <div class="col-lg-8">
    </div>
    <div class="col-lg-1">
        <b><?php echo $totalberat; ?> Kg</b>
    </div>
    <div class="col-lg-1">
        <b><?php echo $totalitem; ?></b>
    </div>
        <div class="col-lg-2">
            <b><?php echo $totalharga; ?></b>
    </div>
</div>
<hr>
<div class="row clearfix">
    <div class="col-lg-8">
        <b>Biaya Kirim</b>
    </div>
    <div class="col-lg-2">
        <b><?php echo ceil($totalberat); ?> Kg </b><small><?php echo $wilayah->tarif_reg; ?>/kg</small>
    </div>
        <div class="col-lg-2">
            <b><?php echo $totalongkir; ?></b>
    </div>
</div>
<hr>
<div class="row clearfix">
    <div class="col-lg-8">
    </div>
    <div class="col-lg-4">
        <b>Total Harga <?php echo $total; ?></b>
    </div>
    <hr >
    <div class="col-lg-3">
    Tujuan Pengiriman <br>
    <b><?php echo $user->nama; ?></b><br>
    <?php echo $user->alamat; ?><br>
    Kecamatan <?php echo $wilayah->kecamatan; ?>,<br>
    <?php echo $wilayah->kota_kabupaten; ?><br>
    Telp : <?php echo $user->hp; ?>
    </div>
    <div class="col-lg-3">
        Status Pemesanan<br>
        <code><?php echo $invoice->status(); ?></code>
    </div>
    <div class="col-lg-3">
        Transfer ke no rek BNI 2132312321<br>
        AN Calim Clothes
        <br /><br />
        <?php if($invoice->status == 0) { ?>
        <form method="POST">
            <input type="hidden" name="invoice_id" value="<?php echo $invoice->invoice_id; ?>">
            <?php echo CHtml::submitButton('Konfirmasi Pembayaran', array('class' => 'btn btn-success btn-sm', 'confirm' => 'Apakah anda yakin sudah melakukan pembayaran untuk pesanan ini?')); ?>
        </form>
        <?php } ?>
    </div>
</div>

