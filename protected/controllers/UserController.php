<?php

class UserController extends Controller {

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
                'actions' => array('index', 'admin', 'view', 'create', 'update', 'suggestCity','suggestIdWilayah', 'setSelectedKota', 'profile'),
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
        $model = new User;
        $model->setScenario('create');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->nama = strtoupper($_POST['User']['nama']);
            $model->level='user';
            if ($model->validate()) {
                $model->save();
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
        if (Yii::app()->user->getState('level') != 'admin'){
            $this->redirect(array('/'));
        }
        
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('updateadmin', array(
            'model' => $model,
        ));
    }
    public function actionAdmin() {
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }
    public function actionProfile($id) {
        if ($id != Yii::app()->user->id){
            $this->redirect(array('profile', 'id' => Yii::app()->user->id));
        }
        
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save()){
                Yii::app()->user->setFlash('save', 'Update Sukses');
                $this->redirect(array('profile', 'id' => $model->id));
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
        $dataProvider = new CActiveDataProvider('User');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionSuggestCity() {  
        $criteria = new CDbCriteria;  
        $criteria->compare('kota_kabupaten', CHtml::encode($_GET['term']), true);  
        $criteria->distinct=true; 
        $criteria->select = 'kota_kabupaten';
        $criteria->limit = 15;  
        $data = JneTangerang::model()->findAll($criteria);  
        $arr = array();  
  
        foreach ($data as $item) {  
  
            $arr[] = array(  
                'id' => $item->kota_kabupaten,  
                'value' => $item->kota_kabupaten,  
                'label' => $item->kota_kabupaten,   
            );  
        }  
  
        echo CJSON::encode($arr);  
    } 

    public function actionSuggestIdWilayah(){  
        $criteria = new CDbCriteria;  
        $criteria->compare('kecamatan', CHtml::encode($_GET['term']), true);  
        $criteria->compare('kota_kabupaten', Yii::app()->user->getState('sempak'), true);  
        $criteria->limit = 15;  
        $data = JneTangerang::model()->findAll($criteria);  
  
        $arr = array();  
  
        foreach ($data as $item) {  
  
            $arr[] = array(  
                'id' => $item->id,  
                'value' => $item->kecamatan,  
                'label' => $item->kecamatan,  
            );  
        }  
  
        echo CJSON::encode($arr);  
    }

    public function actionSetSelectedKota()
    {
        if (isset($_GET['selected'])){
            Yii::app()->user->setState('sempak',CHtml::encode($_GET['selected']));
            }
    }

}
