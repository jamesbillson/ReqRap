<?php

class ActorController extends Controller
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
				'actions'=>array('create','update','delete','rollback','history'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
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
	
	
        public function actionView($id) // Note that this is actor_id not id
	{
             	$versions=Version::model()->getVersions($id,4);
                $model=$this->loadModel($versions[0]['id']);
                $this->render('view',array('model'=>$model,
			'versions'=>$versions
        	));
	}
        
       	        public function actionHistory($id) // Note that this is form_id
	{
             	$versions=Version::model()->getVersions($id,4,'form_id');
                $model=$this->loadModel($versions[0]['id']);
                $this->render('history',array('model'=>$model,
			'versions'=>$versions
        	));
	} 
        
	  public function actionCreate($id)
	{
	
                $model=new Actor;

		if(isset($_POST['Actor']))
		{
                   $model->attributes=$_POST['Actor'];
                   $model->number=Actor::model()->getNextNumber($id);
                   $model->actor_id=Version::model()->getNextID(4);
                   $model->inherits=-1;
                    
                    if($model->save())
                    {
                     $version=Version::model()->getNextNumber($id,4,1,$model->primaryKey,$model->actor_id);   
                     $this->redirect(array('/project/view/tab/actors/id/'.$id));
		    }
                        
                }
               
                $this->render('create',array(
			'model'=>$model,'id'=>$id,
		));
	}


        
        
        	public function actionUpdate($id)
	{
                $model=$this->loadModel($id);
                $new= new Actor;

            
		if(isset($_POST['Actor']))
		{
                        
			 $new->attributes=$_POST['Actor'];
                         $new->project_id=$model->project_id;
                         $new->actor_id=$model->actor_id;
                          $new->number=$model->number;
                         $new->inherits=$model->inherits;
			if($new->save())
                        {
			$version=Version::model()->getNextNumber($model->project_id, 4, 2,$new->primaryKey,$model->actor_id);
                        $this->redirect(array('/project/view/tab/actors/id/'.$model->project_id));
                        }        
		}

		$this->render('update',array(
			'model'=>$model,'id'=>$model->project_id
		));
	}
        
        
	

      
public function actionDelete($id)
	{
		
            $model=$this->loadModel($id);
            $version=Version::model()->getNextNumber($model->project_id,4,3,$id,$model->actor_id);  
            $model->save();
            $this->redirect(array('/project/view/tab/actors/id/'.$model->project_id));
            
            }

	
            
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Actor');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


        
	public function actionAdmin()
	{
		$model=new Actor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Actor']))
			$model->attributes=$_GET['Actor'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


        
	public function loadModel($id)
	{
		$model=Actor::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Actor $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='actor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
