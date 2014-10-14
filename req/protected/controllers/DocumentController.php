<?php

class DocumentController extends Controller
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
                'actions'=>array('index','view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('remove','create','update','projectview'),
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
        if(isset($_GET['id']) && $document = Document::model()->findByPk($_GET['id']))
        {
            $model=new Documentversion('searchDocument()');
            $model->unsetAttributes();  // clear any default values
            
            if(isset($_GET['Documentversion']))
                $model->attributes=$_GET['Documentversion'];

            $this->render('view',compact('model','id','document'));
        }
    }

        
    public function actionProjectView($id)
    {
        
        $data= Document::model()->findAll('foreign_key='.$id.' and type=1');
        $this->render('projectdocs',compact('id','data'));
    }
        
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($id)
    {
 
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if(isset($_GET['id'])){
            $model = new Document;
            $version = new Documentversion;
            $project = Project::model()->findByPk($_GET['id']);
            
            if(isset($_POST['Document']) && isset($_POST['Documentversion']) && isset($_POST['Documenttype']))
            {
                $model->attributes = $_POST['Document'];
                $model->foreign_key = $_POST['Document']['foreign_key'];
                if(isset($_POST['Documenttype'])){
                    $model->documentType = new Documenttype;
                    $model->documentType->attributes = $_POST['Documenttype'];
                    if($model->documentType->save())
                        $doctype_id = $model->documentType->id;
                }
                if(isset($doctype_id))
                    $model->document_type = $doctype_id;
                
                if($model->save()){

                    $version->attributes = $_POST['Documentversion'];
                    $uploadFile = CUploadedFile::getInstance($version,'file');
                    if (!isset($uploadFile->name)) 
                        throw new CHttpException(500 ,'File name shouldn\'t empty ');
                    $uniNameFile = Utils::uniqueFile($uploadFile->name);
                    
                    $version->file = $uniNameFile;

                    $version->document_id = $model->id;
                    $version->version = '1.0';

                    if ($version->date == '') 
                        throw new CHttpException('Date should not be empty ');

                    $date=explode("/",$version->date);
                    $version->date = $date[2]."-".$date[0]."-".$date[1];
                    
                    if($version->save()){
                        $uploadFile->saveAs(Yii::getPathOfAlias("webroot").'/uploads/'.$uniNameFile);
                        $this->redirect(UrlHelper::getPrefixLink('/project/view/?id='.$project->id.'&tab=documents'));
                        return;
                    }
                }
            }
            $this->render('create',compact('model','project','version'));
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

        if(isset($_POST['Document']))
        {
            $model->attributes=$_POST['Document'];
            if($model->save())
                $this->redirect(array('/req/view','id'=>$model->id));
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

     public function actionRemove($id,$project)
    {
        $this->loadModel($id)->delete();
        $this->redirect(UrlHelper::getPrefixLink('/project/view/?id='.$project.'&tab=documents'));
    }
    
    
    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Document');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Document('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Document']))
            $model->attributes=$_GET['Document'];

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
        $model=Document::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='document-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
