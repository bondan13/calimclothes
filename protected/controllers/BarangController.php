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
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete'),
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
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
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
            $model->gambar=CUploadedFile::getInstance($model,'gambar');
            if ($model->validate()){
                    $model->save();
                    $model->gambar->saveAs(Yii::app()->basePath.'/../images/'.$model->getPrimaryKey().'.jpg'); 
                    $image = Yii::app()->image->load(Yii::app()->basePath.'/../images/'.$model->getPrimaryKey().'.jpg');
                    $image = new Image('images/'.$model->getPrimaryKey().'.jpg');
                    $t = $image->width / 1.2;
                    $l = $image->width;
                    if (($image->height * 1.2) < $image->width) {
                        $t = $image->height;
                        $l = $image->height * 1.2;
                    }
                    $image->crop($l, $t);
                    $image->resize(216, 180);
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
        $dataProvider = new CActiveDataProvider('Barang');
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
        $model = Barang::model()->findByPk($id);
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

}
