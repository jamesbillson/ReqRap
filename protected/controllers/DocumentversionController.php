<?php

class DocumentversionController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
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
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view','download'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($id)
    {
        $model=new Documentversion;

         if(isset($_GET['id']) && $document = Document::model()->findByPk($_GET['id'])){
            
         if(isset($_POST['Documentversion']))
            {
                $model->attributes=$_POST['Documentversion'];
                $model->document_id = $document->id;
                $uploadFile = CUploadedFile::getInstance($model,'file');
                
                 if(isset($uploadFile)){
                $uniNameFile = Utils::uniqueFile($uploadFile->name);
                } ELSE {
                $uniNameFile = '';
                        }
                 $model->file = $uniNameFile;
                
                 if(strpos($model->date,'/') !== false) {
                 $date=explode("/",$model->date);   
                 $model->date = $date[2]."-".$date[0]."-".$date[1];   
                 } ELSE {
                 $model->date = '';   
                }
                 
                
               

                if($model->save()){
                    $uploadFile->saveAs(Yii::getPathOfAlias("webroot").'/uploads/'.$uniNameFile);
                    if ($_POST['Documentversion']['notify']='on') Follower::model()->sendNewDocumentNotification($model->document->project->id);
                    $this->redirect(array('/project/view','id'=>$model->document->project->id,'tab'=>'documents'));
                    }
            }

            $this->render('create',array(
                    'model'=>$model,
            ));
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Documentversion']))
        {
            $model->attributes=$_POST['Documentversion'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Documentversion');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Documentversion('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Documentversion']))
            $model->attributes=$_GET['Documentversion'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=Documentversion::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='documentversion-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDownload($id)
    {
        if(isset($_GET['id']) && $versions = Documentversion::model()->findByPk($id)){
                $file = Yii::getPathOfAlias("webroot").'/uploads/'.$versions->file;

                header("Pragma: public", true);
                header("Expires: 0"); // set expiration time
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");
                header("Content-Disposition: attachment; filename=".basename($file));
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: ".filesize($file));
                die(file_get_contents($file));
        }
    }
}
