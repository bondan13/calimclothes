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
                'actions' => array('index', 'view', 'create', 'update', 'delete', 'admin', 'order'),
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
            array('id'=>$id),
            array(
                'condition'=>'user_id=:user_id', 
                'params'=>array(':user_id'=>Yii::app()->user->id)
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
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Transaksi');
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
            if ($barang === null)
                {throw new CHttpException(404, 'The requested page does not exist.');}
            
                
            if ($model->jumlahitem <1) Yii::app()->user->setFlash('error', 'Minimal pembelian 1');
            
            if ($model->ukuran=='s'){
                if ($model->jumlahitem <= $barang->s_stok){
                    $model->jumlah = $model->jumlahitem;
                    $barang->s_stok = ($barang->s_stok - $model->jumlahitem) ;
                }
                else{
                    Yii::app()->user->setFlash('error', 'Size S hanya tersedia '.$barang->s_stok);
                }
            }
            
            if ($model->ukuran=='m'){
                if ($model->jumlahitem <= $barang->m_stok){
                    $model->jumlah =$model->jumlahitem;
                    $barang->m_stok = ($barang->m_stok - $model->jumlahitem) ;
                }
                else{
                    Yii::app()->user->setFlash('error', 'Size M hanya tersedia '.$barang->m_stok);
                }
            }
            if ($model->ukuran=='l'){
                if ($model->jumlahitem <= $barang->l_stok){
                    $model->jumlah =$model->jumlahitem;
                    $barang->l_stok = ($barang->l_stok - $model->jumlahitem) ;
                }
                else{
                    Yii::app()->user->setFlash('error', 'Size L hanya tersedia '.$barang->l_stok);
                }
            }
            if ($model->ukuran=='xl'){
                if ($model->jumlahitem <= $barang->xl_stok){
                    $model->jumlah =$model->jumlahitem;
                    $barang->xl_stok = ($barang->xl_stok - $model->jumlahitem) ;
                }
                else{
                    Yii::app()->user->setFlash('error', 'Size XL hanya tersedia '.$barang->xl_stok);
                }
            }

            if ($model->ukuran=='az'){
                if ($model->jumlahitem <= $barang->allsize_stok){
                    $model->jumlah =$model->jumlahitem;
                    $barang->allsize_stok = ($barang->allsize_stok - $model->jumlahitem) ;
                }
                else{
                    Yii::app()->user->setFlash('error', 'All Size hanya tersedia '.$barang->allsize_stok);
                }
            }
            
            if(Yii::app()->user->hasFlash('error')){
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
            $transaksiBefore = Transaksi::model()->findByAttributes(array('user_id'=>$model->user_id),'status=0');
            if ($transaksiBefore === null){
               $model->invoice_id = 'T'.$model->id;
            }
            else {
                $model->invoice_id = 'T'.$transaksiBefore->id;
            }
            $model->save();
            
            $this->redirect(array('view', 'id' => $model->id));
        }
        else {
            $this->redirect(array('index'));}
    }

}
