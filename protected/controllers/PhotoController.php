<?php

class PhotoController extends Controller
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
            /*'postOnly + delete', // we only allow deletion via POST request*/
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
                'actions'=>array('create','update','ajaxSave','ajaxDelete','admin','upload'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('delete'),
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
		$versions=Version::model()->getVersions($photo_id,11,'id');
                $model=$this->loadModel($versions[0]['id']);
                $this->render('view',array('model'=>$model,
			'versions'=>$versions
        	));
	}

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionProjectCreate($project_id)
    {
           
        // Need to change this so the $iface_id is stored with the photo.
        // idea is you can upload a bunch of photos and then associate them.
        
        
        $versions=Version::model()->getVersions($iface_id,12,'iface_id');
            $iface=Iface::model()->loadModel($versions[0]['id']);
        
            $model=new Photo;
            
            if(isset($_POST['Photo']))
            {
                $model->attributes=$_POST['Photo'];
                $model->photo_id=Version::model()->getNextID(11);
                if($model->save())
                    $version=Version::model()->getNextNumber($project_id,11,1,$model->primaryKey,$model->photo_id);   
                     $this->redirect(array('/iface/view/id/'.$project));
            }

            $this->render('create',array(
                'model'=>$model,
            ));         
        }
    

          public function actionInterfaceCreate($interface_id)
    {
           
        // Need to change this so the $iface_id is stored with the photo.
        // idea is you can upload a bunch of photos and then associate them.
        
        
        $versions=Version::model()->getVersions($iface_id,12,'iface_id');
            $iface=Iface::model()->loadModel($versions[0]['id']);
        
            $model=new Photo;
            
            if(isset($_POST['Photo']))
            {
                $model->attributes=$_POST['Photo'];
                $model->photo_id=Version::model()->getNextID(11);
                if($model->save())
                    $version=Version::model()->getNextNumber($project_id,11,1,$model->primaryKey,$model->photo_id);   
                     $this->redirect(array('/iface/view/id/'.$project));
            }

            $this->render('create',array(
                'model'=>$model,
            ));         
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

        if(isset($_POST['Photo']))
        {
            $model->attributes=$_POST['Photo'];
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
        if(isset($id) && $model = $this->loadModel($id)){
            
            $_img = $model->file;

            if($model->delete()){
                Utils::deleteFile(Yii::getPathOfAlias("webroot").Yii::app()->params['differenceImg_folder'],$_img);
                Utils::deleteFile(Yii::getPathOfAlias("webroot").Yii::app()->params['differenceImg_folder'].'thumbs/',$_img);
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));            
        }

    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Photo');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Photo('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Photo']))
            $model->attributes=$_GET['Photo'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Photo the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Photo::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Photo $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='difference-images-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAjaxSave(){

        if(isset($_POST['Photo'])){
            $id = $_POST['Photo']['id'];
            if(isset($id) && $model=$this->loadModel($id)){
                $model->attributes = $_POST['Photo'];
                if($model->save(false))
                    return true;
            }
        }
        return false;
    }

    public function actionAjaxDelete(){
        if(isset($_GET['photo_id']) && $model = $this->loadModel($_GET['photo_id'])){
            $_img = $model->file;

            if($model->delete()){
                Utils::deleteFile(Yii::getPathOfAlias("webroot").Yii::app()->params['photo_folder'],$_img);
                return true;
            }
        }
        return false;
    }

    public function actionUpload($id)
    {
        if(isset($id) && Project::model()->findByPk($id)){
            
            header('Vary: Accept');
            if (isset($_SERVER['HTTP_ACCEPT']) && 
                (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false))
            {
                header('Content-type: application/json');
            } else {
                header('Content-type: text/plain');
            }
            $data = array();

            $photo = new Photo;
            $upload = CUploadedFile::getInstance($photo, 'file');
            
            if (isset($upload)){   

                //set path and filename
                $path = Yii::getPathOfAlias("webroot").Yii::app()->params['photo_folder'];
                if(!file_exists($path)){
                    if(mkdir($path, 0755, true)){
                       return false; 
                    }
                }

                $file_name = Utils::uniqueFile($upload->name);

                if($upload->saveAs($path.$file_name)){

                    $src = Yii::app()->easyImage->thumbSrcOf(
                                $path.$file_name, 
                                array('resize' => array('width' => 150, 'height' => 150)));
                    
                    //persist into database
                    $model = new Photo;
                    $model->project_id = Yii::App()->session['project'];
                    $model->release_id=Yii::App()->session['release'];
                    $model->user_id=Yii::App()->user->id;
                    
                    $model->file = $file_name;                    
                    
                    if($model->save()){
                        // return data to the fileuploader
                        $data[] = array(
                            'name' => $upload->name,
                            'type' => $upload->type,
                            'size' => $upload->size,
                            'url' => Yii::app()->params['photo_folder'].$model->file,
                            'thumbnail_url' => $src,
                            'delete_url' => Controller::createUrl('photo/ajaxDelete',array('photo_id' => $model->id, 'method' => 'uploader')),
                            'delete_type' => 'POST'
                        );
                    }
                } else {
                    $data[] = array('error' => 'Unable to save model after saving picture');
                }
            } else {
                if ($model->hasErrors('picture'))
                {
                    $data[] = array('error', $model->getErrors('picture'));
                } else {
                    throw new CHttpException(500, "Could not upload file ".     CHtml::errorSummary($model));
                }
            }
            // JQuery File Upload expects JSON data
            echo json_encode($data);
            return ;
        }        
    }
}
