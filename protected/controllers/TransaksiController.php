<?php

class TransaksiController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'create', 'update', 'deletea', 'admin', 'order', 'invoice', 'adminupd', 'report', 'laporan'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {

        $model = Transaksi::model()->findByAttributes(
                array('id' => $id), array(
            'condition' => 'user_id=:user_id',
            'params' => array(':user_id' => Yii::app()->user->id)
                )
        );
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Transaksi;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Transaksi'])) {
            $model->attributes = $_POST['Transaksi'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Transaksi'])) {
            $model->attributes = $_POST['Transaksi'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDeletea($id) {
        $model = $this->loadModel($id);
        $invoice = $model->invoice_id;
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        $this->redirect(array('transaksi/invoice', 'id' => $invoice));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $criteria = new CDbCriteria;
        $criteria->compare('user_id', Yii::app()->user->id);
        $dataProvider = new CActiveDataProvider('Transaksi');
        $dataProvider->criteria = $criteria;
        $dataProvider->sort->defaultOrder = 'id DESC';
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Transaksi('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Transaksi']))
            $model->attributes = $_GET['Transaksi'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Transaksi the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Transaksi::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Transaksi $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'transaksi-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionOrder() {
        $model = new Transaksi;
        $model->setScenario('order');
        if (isset($_POST['Transaksi'])) {
            $model->jumlahitem = $_POST['Transaksi']['jumlahitem'];
            $model->ukuran = $_POST['Transaksi']['ukuran'];
            $model->barang_id = $_POST['Transaksi']['barang_id'];

            $barang = Barang::model()->findByPk($model->barang_id);
            if ($barang === null) {
                throw new CHttpException(404, 'The requested page does not exist.');
            }


            if ($model->jumlahitem < 1)
                Yii::app()->user->setFlash('error', 'Minimal pembelian 1');

            if ($model->ukuran == 's') {
                if ($model->jumlahitem <= $barang->s_stok) {
                    $model->jumlah = $model->jumlahitem;
                    $barang->s_stok = ($barang->s_stok - $model->jumlahitem);
                } else {
                    Yii::app()->user->setFlash('error', 'Size S hanya tersedia ' . $barang->s_stok);
                }
            }

            if ($model->ukuran == 'm') {
                if ($model->jumlahitem <= $barang->m_stok) {
                    $model->jumlah = $model->jumlahitem;
                    $barang->m_stok = ($barang->m_stok - $model->jumlahitem);
                } else {
                    Yii::app()->user->setFlash('error', 'Size M hanya tersedia ' . $barang->m_stok);
                }
            }
            if ($model->ukuran == 'l') {
                if ($model->jumlahitem <= $barang->l_stok) {
                    $model->jumlah = $model->jumlahitem;
                    $barang->l_stok = ($barang->l_stok - $model->jumlahitem);
                } else {
                    Yii::app()->user->setFlash('error', 'Size L hanya tersedia ' . $barang->l_stok);
                }
            }
            if ($model->ukuran == 'xl') {
                if ($model->jumlahitem <= $barang->xl_stok) {
                    $model->jumlah = $model->jumlahitem;
                    $barang->xl_stok = ($barang->xl_stok - $model->jumlahitem);
                } else {
                    Yii::app()->user->setFlash('error', 'Size XL hanya tersedia ' . $barang->xl_stok);
                }
            }

            if ($model->ukuran == 'az') {
                if ($model->jumlahitem <= $barang->allsize_stok) {
                    $model->jumlah = $model->jumlahitem;
                    $barang->allsize_stok = ($barang->allsize_stok - $model->jumlahitem);
                } else {
                    Yii::app()->user->setFlash('error', 'All Size hanya tersedia ' . $barang->allsize_stok);
                }
            }

            if (Yii::app()->user->hasFlash('error')) {
                $this->redirect(array('barang/view', 'id' => $barang->id));
                Yii::app()->end();
            }

            $barang->save();
            $model->berat = $model->jumlahitem * $barang->berat;
            $model->total_harga = $model->jumlahitem * $barang->harga;
            $model->size = strtoupper($model->ukuran);
            $model->user_id = Yii::app()->user->id;
            $model->tanggal = new CDbExpression('NOW()');
            $model->status = 0;
            $model->save();
            $transaksiBefore = Transaksi::model()->findByAttributes(array('user_id' => $model->user_id), 't.status=0');
            if ($transaksiBefore === null) {
                $model->invoice_id = 'T' . $model->id;
            } else {
                $model->invoice_id = 'T' . $transaksiBefore->id;
            }
            $model->save();

            $this->redirect(array('/transaksi'));
        } else {
            $this->redirect(array('index'));
        }
    }

    public function actionInvoice($id) {
        $invoice = Transaksi::model()->findByAttributes(
                array('invoice_id' => $id)
        );
        if ($invoice === null) {
            $this->redirect(array('/'));
            Yii::app()->end();
        }

        if ($invoice->user_id != Yii::app()->user->id && Yii::app()->user->getState('level') != 'admin') {
            $this->redirect(array('/'));
            Yii::app()->end();
        }

        if (isset($_POST['invoice_id'])) {
            $tanggalsekarang = new CDbExpression('NOW()');
            Yii::app()->db->createCommand()->update(
                    'transaksi', array('status' => 1, 'tanggal_bayar' => $tanggalsekarang), 'invoice_id = :id', array(':id' => $invoice->invoice_id)
            );
            $this->redirect(array('transaksi/invoice', 'id' => $invoice->invoice_id));
        }

        $criteria = new CDbCriteria();
        $criteria->compare('invoice_id', $id);
        $criteria->compare('user_id', $invoice->user_id);

        $criteria1 = new CDbCriteria();
        $criteria1->compare('invoice_id', $id);
        $criteria1->compare('user_id', $invoice->user_id);
        $criteria1->select = 'sum(jumlah) AS jumlahCount';

        $this->layout = '//layouts/column1';
        $model = new CActiveDataProvider('Transaksi');
        $model->criteria = $criteria;
        $model->pagination = false;

        $command = Yii::app()->db->createCommand();
        $command->select('SUM(jumlah) AS sum');
        $command->from('transaksi');
        $command->where('invoice_id=:id', array(':id' => $id));

        $command1 = Yii::app()->db->createCommand();
        $command1->select('SUM(total_harga) AS sum');
        $command1->from('transaksi');
        $command1->where('invoice_id=:id', array(':id' => $id));
        $totalharga = $this->hargaRupiah($command1->queryScalar());

        $command2 = Yii::app()->db->createCommand();
        $command2->select('SUM(berat) AS sum');
        $command2->from('transaksi');
        $command2->where('invoice_id=:id', array(':id' => $id));
        $berat = $command2->queryScalar();

        $user = User::model()->findByPk($invoice->user_id);
        $ongkir = JneTangerang::model()->findByPk($user->wilayah_id);
        $totalongkir = ceil($berat) * $ongkir->tarif_reg;

        $total = $command1->queryScalar() + $totalongkir;


        $this->render('invoice', array(
            'invoice' => $invoice, 'dataprovider' => $model,
            'totalitem' => $command->queryScalar(),
            'totalharga' => $totalharga,
            'totalberat' => number_format($berat,1),
            'totalongkir' => $this->hargaRupiah($totalongkir),
            'total' => $this->hargaRupiah($total),
            'user' => $user,
            'wilayah' => $ongkir,
        ));
    }

    private function hargaRupiah($harga) {
        $harga = number_format($harga, 0, ',', '.');
        return 'Rp ' . $harga;
    }

    public function actionAdminupd() {
        if (Yii::app()->user->getState('level') != 'admin') {
            $this->redirect(array('/'));
            Yii::app()->end();
        }
        $invoice = Transaksi::model()->findByAttributes(
                array('invoice_id' => $_POST['invoice_id'])
        );
        if ($invoice === null)
            { throw new CHttpException(404, 'The requested page does not exist.');}
        
        $tanggalsekarang = new CDbExpression('NOW()');
        if ($_POST['status']==0){
            Yii::app()->db->createCommand()->update(
                    'transaksi', array('status' => 0,'tanggal_bayar' => $tanggalsekarang), 'invoice_id = :id', array(':id' => $invoice->invoice_id)
            );
        }
        if ($_POST['status']==1){
            Yii::app()->db->createCommand()->update(
                    'transaksi', array('status' => 1, 'tanggal_bayar' => $tanggalsekarang), 'invoice_id = :id', array(':id' => $invoice->invoice_id)
            );
        }
        if ($_POST['status']==2){
            Yii::app()->db->createCommand()->update(
                    'transaksi', array('status' => 2,'tanggal_bayar' => $tanggalsekarang), 'invoice_id = :id', array(':id' => $invoice->invoice_id)
            );
        }
        
        if ($_POST['status']==3){
            Yii::app()->db->createCommand()->update(
                    'transaksi', array('status' => 3, 'tanggal_bayar' => ''), 'invoice_id = :id', array(':id' => $invoice->invoice_id)
            );
        }
        if ($_POST['status'] == 4 || $_POST['status'] == 5){
            Yii::app()->db->createCommand()->update(
                    'transaksi', array('status' => $_POST['status'], 'tanggal_kirim' => $tanggalsekarang), 'invoice_id = :id', array(':id' => $invoice->invoice_id)
            );
        }
        
        if (isset($_POST['resi'])){
            Yii::app()->db->createCommand()->update(
                    'transaksi', array('resi' => $_POST['resi']), 'invoice_id = :id', array(':id' => $invoice->invoice_id)
            );
        }
        $this->redirect(array('transaksi/invoice', 'id' => $invoice->invoice_id));
    }
    
    public function actionReport(){
        if(Yii::app()->user->getState('level')!='admin'){
            $this->redirect(array('/'));
            Yii::app()->end();
        }
        if (isset($_POST['Report']['date_start']) && isset($_POST['Report']['date_end']) && $_POST['Report']['date_start']!='' && $_POST['Report']['date_end']!=''){
            $criteria = new CDbCriteria();
            $criteria->addBetweenCondition('tanggal',$_POST['Report']['date_start'],$_POST['Report']['date_end']);
            $criteria->compare('status', 5);
            $criteria->distinct = true ;
            $criteria->group = 'barang_id';
            $transaksi = Transaksi::model()->findAll($criteria);
            $judul = 'Laporan Penjualan';
            $header = array (
                array('label'=>'ID','length'=>'10','align'=>'C'),
                array('label'=>'Nama','length'=>'110','align'=>'C'),
                array('label'=>'S','length'=>'10','align'=>'C'),
                array('label'=>'M','length'=>'10','align'=>'C'),
                array('label'=>'L','length'=>'10','align'=>'C'),
                array('label'=>'XL','length'=>'10','align'=>'C'),
                array('label'=>'All Size','length'=>'15','align'=>'C'),
                 array('label'=>'Total','length'=>'15','align'=>'C'),
            );
            if($transaksi){
                $dataProvider = new CActiveDataProvider('Transaksi');
                $dataProvider->criteria = $criteria;
                $dataProvider->sort->defaultOrder = 'id DESC';
                $this->renderPartial('laporanpenjualan', array(
                    'dataProvider' => $dataProvider,
                    'date' => $_POST,
                    'transaksi'=>$transaksi,
                    'judul'=>$judul,
                    'header'=>$header,
                ));
            }
            else{
                Yii::app()->user->setFlash('gagal', "Transaksi tidak ditemukan");
                $this->render('report');
            }           
        }
        else{
            $this->render('report');
        }
    }
    
    public function actionLaporan(){
        if(Yii::app()->user->getState('level')!='admin'){
            $this->redirect(array('/'));
            Yii::app()->end();
        }
        
        if (isset($_POST['Report']['date_start']) && isset($_POST['Report']['date_end']) && $_POST['Report']['date_start']!='' && $_POST['Report']['date_end']!=''){
            $criteria = new CDbCriteria();
            $criteria->addBetweenCondition('t.tanggal',$_POST['Report']['date_start'],$_POST['Report']['date_end']);
            $criteria->compare('t.status', 5);
            $criteria->with = array('user','barang');
            $transaksi = Transaksi::model()->findAll($criteria);
            $judul = 'Laporan Penjualan';
            $header = array (
                array('label'=>'NO','length'=>'10','align'=>'C'),
                array('label'=>'Nama','length'=>'30','align'=>'C'),
                array('label'=>'Invoice ID','length'=>'20','align'=>'C'),
                array('label'=>'Tgl Transaksi','length'=>'23','align'=>'C'),
                array('label'=>'Nama Barang','length'=>'50','align'=>'C'),
                array('label'=>'QTY','length'=>'10','align'=>'C'),
                array('label'=>'Harga Satuan','length'=>'25','align'=>'C'),
                array('label'=>'Sub Total','length'=>'25','align'=>'C'),
            );
            
            if($transaksi){
                $this->renderPartial('_laporanpenjualan', array(
                    'date' => $_POST,
                    'transaksi'=>$transaksi,
                    'judul'=>$judul,
                    'header'=>$header,
                ));
            }
            else{
                Yii::app()->user->setFlash('gagal', "Transaksi tidak ditemukan");
                $this->render('laporan');
            }           
        }
        
        $this->render('laporan');
        
    }

}
