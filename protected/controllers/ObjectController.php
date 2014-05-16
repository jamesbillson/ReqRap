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
				'actions'=>array('create','update','delete','history','convert'),
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
        
             public function actionHistory($id) // Note that this is form_id
	{
             	$versions=Version::model()->getVersions($id,6);
                $model=$this->loadModel($versions[0]['id']);
                $this->render('history',array('model'=>$model,
			'versions'=>$versions
        	));
	}
        
	  public function actionCreate()
	{
            $project=Yii::app()->session['project'];
                $model=new Object;

		if(isset($_POST['Object']))
		{
                   $model->attributes=$_POST['Object'];
                   $model->object_id=Version::model()->getNextID(6);
                   $model->release_id=Release::model()->currentRelease($project);
                   $model->number=Object::model()->getNextNumber($project);
                
                    
                    if($model->save())
                    {
                     $version=Version::model()->getNextNumber($project,6,1,$model->primaryKey,$model->object_id);   
                     $this->redirect(array('/project/view/tab/objects/id/'.$project));
		    }
                        
                }
               
                $this->render('create',array(
			'model'=>$model,'project_id'=>$project,
		));
	}

        
        	  public function actionConvert($id)
	{
            $project=Yii::app()->session['project'];
            $release=Yii::app()->session['release'];
            $form=new Form;
            
            $object=$this->loadVersion($id);
       
            $form->project_id=$project;
            $form->release_id=$release;
            $form->number=Form::model()->getNextNumber();
            $form->form_id=Version::model()->getNextID(2);
            $form->name=$object->name.' Form';        
                    
                    if($form->save())
                    {
                     $version=Version::model()->getNextNumber($project,2,1,$form->primaryKey,$form->form_id);   
                    
		    }
            
            
            
		
            $objectproperties=Version::model()->getChildObjects($id,7);
            
          
            foreach($objectproperties as $objectproperty){
                //get the object property and save as an form property.
                
                
                  $model=new Formproperty;
                       
                    $model->project_id= $project;
                    $model->release_id=$release;
                    $model->number=$objectproperty['number'];
                    $model->formproperty_id=Version::model()->getNextID(3);
                    $model->form_id=$form->form_id;
                    $model->name=$objectproperty['name'];
                    $model->description= $objectproperty['description'];
                    $model->type = '';
                    $model->valid = '';
                    $model->required = 0;
                    
                    if($model->save())
                    {
                     $version=Version::model()->getNextNumber($project,3,1,$model->primaryKey,$model->formproperty_id);   
                    }
                
                
                
            }
            
              
                 
                  
                $this->redirect(array('/project/view/tab/forms'));        
            
	}

        
        
        	public function actionUpdate($id)
	{
                $model=$this->loadModel($id);
                $new= new Object;
            $release=Yii::App()->session['release'];
            $project=Yii::App()->session['project'];
            
		if(isset($_POST['Object']))
		{
                        
			 $new->attributes=$_POST['Object'];
                         $new->project_id=$project;
                         $new->release_id=$release;
                         $new->object_id=$model->object_id;
                         $new->number=$model->number;
                      
			if($new->save())
                        {
			$version=Version::model()->getNextNumber($project, 6, 2,$new->primaryKey,$model->object_id);
                        $this->redirect(array('/project/view/tab/objects/id/'.$model->project_id));
                        }        
		}

		$this->render('update',array(
			'model'=>$model,'project_id'=>$project
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
        public function loadVersion($id)
	{
		$model=Object::model()->findByPk(Version::model()->getVersion($id,6));
		if($model===null)
			throw new CHttpException(404,'The requested version does not exist.');
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
