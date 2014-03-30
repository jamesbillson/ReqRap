<?php

class ObjectpropertyController extends Controller
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
				'actions'=>array('create','update','delete','history'),
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
	    public function actionView($id) // Note that this is formproperty_id
	{
             	$versions = Version::model()->getVersions($id,7);
                $model=$this->loadModel($versions[0]['id']);
                $this->render('view',array('model'=>$model,
			'versions'=>$versions
        	));
	}

	     public function actionHistory($id) // Note that this is form_id
	{
             	$versions=Version::model()->getVersions($id,7);
                $model=$this->loadModel($versions[0]['id']);
                $this->render('history',array('model'=>$model,
			'versions'=>$versions
        	));
	}
	
                 public function actionCreate($id)
	{
	    $release=Yii::App()->session['release'];
            $project=Yii::App()->session['project'];
                $object=Object::model()->findbyPK($id);
                $object_id=$object->object_id;
                $model=new Objectproperty;

		if(isset($_POST['Objectproperty']))
		{
                    
		        
                    $model->attributes=$_POST['Objectproperty'];
                    $model->number=Objectproperty::model()->getNextNumber($object_id);
                    $model->objectproperty_id=Version::model()->getNextID(7);
                    $model->project_id=$project;
                    $model->release_id=$release;
                    
                    if($model->save())
                    {
                     $version=Version::model()->getNextNumber($project,7,1,$model->primaryKey,$model->objectproperty_id);   
                     $this->redirect(array('/object/view/id/'.$model->object_id));
		    }
                        
                }
               
                $this->render('create',array(
			'model'=>$model,'object_id'=>$object_id,
		));
	}
        
        
   public function actionUpdate($id)
	{
            
           $release=Yii::App()->session['release'];
            $project=Yii::App()->session['project'];
            
            $model=$this->loadModel($id);
                $new= new Objectproperty;

		if(isset($_POST['Objectproperty']))
		{
                  	 $new->attributes=$_POST['Objectproperty'];
                         $new->number=$model->number;
                         $new->objectproperty_id=$model->objectproperty_id;
                         $new->project_id=$project;
                         $new->release_id=$release;
                         
                         
			if($new->save())
                        {
			$version=Version::model()->getNextNumber($project, 7, 2,$new->primaryKey,$new->objectproperty_id);
                        $this->redirect(array('/object/view/id/'.$model->object_id));
                        }        
		}

		$this->render('update',array(
			'model'=>$model,'object_id'=>$model->object_id
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
 public function actionDelete($id)
	{
		
            $model=$this->loadModel($id);
            $version=Version::model()->getNextNumber($model->object->project_id,7,3,$id,$model->objectproperty_id);  
	    //$model->active=0;
            $model->save();
            $this->redirect(array('/object/view/id/'.$model->object_id));
            
            }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Objectproperty');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Objectproperty('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Objectproperty']))
			$model->attributes=$_GET['Objectproperty'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Objectproperty the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Objectproperty::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Objectproperty $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='objectproperty-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
