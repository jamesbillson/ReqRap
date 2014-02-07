<?php

class ObjectController extends Controller
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
			//'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('create','update','delete'),
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
     public function actionView($id) // Note that this is actor_id not id
	{
             	$versions=Version::model()->getVersions($id,6);
                $model=$this->loadModel($versions[0]['id']);
                $this->render('view',array('model'=>$model,
			'versions'=>$versions
        	));
	}
        
        
        
	  public function actionCreate($id)
	{
	$project_id=$id;
                $model=new Object;

		if(isset($_POST['Object']))
		{
                   $model->attributes=$_POST['Object'];
                   $model->object_id=Version::model()->getNextID($project_id,6);
                   $model->number=Object::model()->getNextNumber($project_id);
                
                    
                    if($model->save())
                    {
                     $version=Version::model()->getNextNumber($project_id,6,1,$model->primaryKey,$model->object_id);   
                     $this->redirect(array('/project/view/tab/objects/id/'.$id));
		    }
                        
                }
               
                $this->render('create',array(
			'model'=>$model,'project_id'=>$project_id,
		));
	}


        
        
        	public function actionUpdate($id)
	{
                $model=$this->loadModel($id);
                $new= new Object;

            
		if(isset($_POST['Object']))
		{
                        
			 $new->attributes=$_POST['Object'];
                         $new->project_id=$model->project_id;
                         $new->object_id=$model->object_id;
                         $new->number=$model->number;
                      
			if($new->save())
                        {
			$version=Version::model()->getNextNumber($model->project_id, 6, 2,$new->primaryKey,$model->object_id);
                        $this->redirect(array('/project/view/tab/objects/id/'.$model->project_id));
                        }        
		}

		$this->render('update',array(
			'model'=>$model,'id'=>$model->project_id
		));
	}
        
        
	

      
public function actionDelete($id)
	{
		
            $model=$this->loadModel($id);
            
            $version=Version::model()->getNextNumber($model->project_id,6,3,$id,$model->object_id); 
            
            $model->save();
            $this->redirect(array('/project/view/tab/objects/id/'.$model->project_id));
            
            }


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Object');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Object('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Object']))
			$model->attributes=$_GET['Object'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Object the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Object::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Object $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='object-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
