<?php

class BarangController extends Controller {

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
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete', 'kategori', 'cari', 'updategambar','stock'),
                'users' => array('*'),
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
        $this->layout = '//layouts/column1';
        $model = $this->loadModel($id);
        if($model->status == 1){
            $this->render('view', array(
            'model' => $model,
            ));            
        }
        else if (Yii::app()->user->getState('level')=='admin'){
            $this->render('view', array(
            'model' => $model,
            ));
        }
        else {
            $this->redirect(array('/'));
            Yii::app()->end();
        }  
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Barang;
        $model->setScenario('create');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Barang'])) {
            $model->attributes = $_POST['Barang'];
            $model->gambar = CUploadedFile::getInstance($model, 'gambar');
            if ($model->validate()) {
                $model->save();
                $model->gambar->saveAs(Yii::app()->basePath . '/../images/' . $model->getPrimaryKey() . '.jpg');
                $image = Yii::app()->image->load(Yii::app()->basePath . '/../images/' . $model->getPrimaryKey() . '.jpg');
                $image = new Image('images/' . $model->getPrimaryKey() . '.jpg');
                $t = $image->width / 1.2;
                $l = $image->width;
                if (($image->height * 1.2) < $image->width) {
                    $t = $image->height;
                    $l = $image->height * 1.2;
                }
                $image->crop($l, $t);
                $image->resize(432, 360);
                $image->save(Yii::app()->basePath . '/../images/' . $model->getPrimaryKey() . 's.jpg');

                $this->redirect(array('view', 'id' => $model->id));
            }
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

        if (isset($_POST['Barang'])) {
            $model->attributes = $_POST['Barang'];

            if ($model->validate()) {
                $model->save();
                $this->redirect(array('update', 'id' => $model->id));
            }
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
        $criteria = new CDbCriteria;
        $criteria->compare('status',1);
        $dataProvider = new CActiveDataProvider('Barang');
        $dataProvider->criteria = $criteria;
        $dataProvider->pagination->pageSize = 12;
        $dataProvider->sort->defaultOrder = 'id DESC';
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Barang('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Barang']))
            $model->attributes = $_GET['Barang'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Barang the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Barang::model()->with('kategori')->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Barang $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'barang-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionKategori($id) {
        $criteria = new CDbCriteria;
        $criteria->compare('kategori_id', $id);
        $dataProvider = new CActiveDataProvider('Barang');
        $dataProvider->criteria = $criteria;
        $dataProvider->pagination->pageSize = 12;
        $dataProvider->sort->defaultOrder = 'id DESC';
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionCari($key) {
        $criteria = new CDbCriteria;
        $criteria->compare('status',1);
        $criteria->addCondition('nama LIKE "%' . $key . '%"');
        $dataProvider = new CActiveDataProvider('Barang');
        $dataProvider->criteria = $criteria;
        $dataProvider->pagination->pageSize = 12;
        $dataProvider->sort->defaultOrder = 'id DESC';
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionUpdateGambar($id) {
        $model = $this->loadModel($id);
        if (isset($_POST['Barang']['gambar'])) {
            $model->gambar = CUploadedFile::getInstance($model, 'gambar');
            if ($model->validate()) {
                $model->gambar->saveAs(Yii::app()->basePath . '/../images/' . $model->getPrimaryKey() . '.jpg');
                $image = Yii::app()->image->load(Yii::app()->basePath . '/../images/' . $model->getPrimaryKey() . '.jpg');
                $image = new Image('images/' . $model->getPrimaryKey() . '.jpg');
                $t = $image->width / 1.2;
                $l = $image->width;
                if (($image->height * 1.2) < $image->width) {
                    $t = $image->height;
                    $l = $image->height * 1.2;
                }
                $image->crop($l, $t);
                $image->resize(432, 360);
                $image->save(Yii::app()->basePath . '/../images/' . $model->getPrimaryKey() . 's.jpg');
            }
        }

        $this->redirect(array('update', 'id' => $model->id));
    }

    public function actionStock(){
        if(Yii::app()->user->getState('level')!='admin'){
            $this->redirect(array('/'));
            Yii::app()->end();
        }
        $judul = 'Laporan Stok Barang';
            $header = array (
                array('label'=>'NO','length'=>'10','align'=>'C'),
                array('label'=>'Nama','length'=>'60','align'=>'C'),
                array('label'=>'Size S','length'=>'20','align'=>'C'),
                array('label'=>'Size M','length'=>'20','align'=>'C'),
                array('label'=>'Size L','length'=>'20','align'=>'C'),
                array('label'=>'Size XL','length'=>'20','align'=>'C'),
                array('label'=>'All Size','length'=>'20','align'=>'C'),
                array('label'=>'Total','length'=>'20','align'=>'C'),
            );
        $barang = Barang::model()->findAll();
        $this->renderPartial('/transaksi/_laporanstock', array(
            'barang' => $barang,
            'judul' =>$judul,
            'header' =>$header,
        ));
    }
}
