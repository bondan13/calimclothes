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
        <div style="float: right;">
            <b>Harga</b>
        </div>
    </div>
</div>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataprovider,
    'itemView' => '_invoice',
    //'page_size'=>16,
    'template' => '{items}',
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
        <div style="float: right;">
            <b><?php echo $totalharga; ?></b>
        </div>
    </div>
</div>
<hr>
<div class="row clearfix">
    <div class="col-lg-8">
        <b>Biaya Kirim</b>
    </div>
    <div class="col-lg-2">
        <b><?php echo ceil($totalberat); ?> Kg </b><sup><?php echo $wilayah->tarif_reg; ?>/kg</sup>
    </div>
    <div class="col-lg-2">
        <div style="float: right;">
            <b><?php echo $totalongkir; ?></b>
        </div>
    </div>
</div>
<hr>
<div class="row clearfix">
    <div class="col-lg-8">
    </div>
    <div class="col-lg-4">
        <b>  Total Harga </b>
        <div style="float: right;">
            <b> <?php echo $total; ?></b>
        </div>
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
        <?php if ($invoice->status == 1 || $invoice->status == 2) { ?><sub>&nbsp;<?php echo $invoice->tanggal_bayar; ?></sub> 
        <?php } else if ($invoice->status == 4 || $invoice->status == 5) { ?>
            <sub>&nbsp;<?php echo $invoice->tanggal_kirim; ?></sub>
        <?php } ?>
        <br />
        <code><?php echo $invoice->status(); ?></code><br />

        <?php if ($invoice->status == 4 || $invoice->status == 5) { ?>
            <sub>&nbsp;Nomor resi pengiriman</sub><br>
            <code><?php echo $invoice->resi; ?></code>
        <?php } ?>
    </div>
    <div class="col-lg-3">
        Transfer ke no rek BNI 020 9101 741<br>
        A/N Irzhan Dwi Anggoro
        <br /><br />
        <?php if (($invoice->status == 0 || $invoice->status == 3) && Yii::app()->user->getState('level') != 'admin') { ?>
            <form method="POST">
                <input type="hidden" name="invoice_id" value="<?php echo $invoice->invoice_id; ?>">
                <?php echo CHtml::submitButton('Konfirmasi Pembayaran', array('class' => 'btn btn-success btn-sm', 'confirm' => 'Apakah anda yakin sudah melakukan pembayaran untuk pesanan ini?')); ?>
            </form>
        <?php } ?>
    </div>
    <div class="col-lg-3">
        <?php if (Yii::app()->user->getState('level') == 'admin') { ?>
            <b>ADMIN PANEL</b><br/>
            <form method="POST" action="<?php echo Yii::app()->createUrl('/transaksi/adminupd'); ?>">
                <input type="hidden" name="invoice_id" value="<?php echo $invoice->invoice_id; ?>">
                Status <br>
                <select class="form-control" name="status"> 
                    <option value="0" <?php echo ($invoice->status == 0) ? 'selected' : ''; ?> >Pesan</option>
                    <option value="1" <?php echo ($invoice->status == 1) ? 'selected' : ''; ?> >Konfirmasi Pembayaran</option>
                    <option value="2" <?php echo ($invoice->status == 2) ? 'selected' : ''; ?> >Pembayaran Berhasil</option>
                    <option value="3" <?php echo ($invoice->status == 3) ? 'selected' : ''; ?> >Pembayaran Gagal</option>
                    <option value="4" <?php echo ($invoice->status == 4) ? 'selected' : ''; ?> >Pengiriman</option>
                    <option value="5" <?php echo ($invoice->status == 5) ? 'selected' : ''; ?> >Sukses (Transaksi Selesai)</option>
                </select>

                Nomor resi<br>
                <input type="text" name="resi" class="form-control" maxlength="45" value="<?php echo $invoice->resi; ?>"></input>
                <br>
                <?php echo CHtml::submitButton('Update', array('class' => 'btn btn-success btn-sm', 'confirm' => 'Update Data?')); ?>
            </form>
        <?php } ?>
    </div>
</div>

