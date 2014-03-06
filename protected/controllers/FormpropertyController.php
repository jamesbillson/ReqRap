<?php

class FormpropertyController extends Controller
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
				'actions'=>array('create','update','delete','rollback'),
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

	

	
        public function actionView($id) // Note that this is formproperty_id
	{
             	$versions = Version::model()->getVersions($id,3);
                $model=$this->loadModel($versions[0]['id']);
                $this->render('view',array('model'=>$model,
			'versions'=>$versions
        	));
	}
        
          public function actionCreate($id)
	{
	
                $model=new Formproperty;

		if(isset($_POST['Formproperty']))
		{
                    
		        
                    $model->attributes=$_POST['Formproperty'];
                    $model->number=Formproperty::model()->getNextNumber($id);
                    $model->formproperty_id=Version::model()->getNextID(3);
                    
                    if($model->save())
                    {
                   
                     $version=Version::model()->getNextNumber($model->form->project->id,3,1,$model->primaryKey,$model->formproperty_id);   
                     $this->redirect(array('/form/view/id/'.$model->form_id));
		    }
                        
                }
               
                $this->render('create',array(
			'model'=>$model,'form_id'=>$id,
		));
	}
        
        public function actionUpdate($id)
	{
            //  The id should be the formproperty_id rather than the id? 
            
            $model=$this->loadModel($id);
                $new= new Formproperty;

		if(isset($_POST['Formproperty']))
		{
                  	 $new->attributes=$_POST['Formproperty'];
                         $new->number=$model->number;
                         $new->form_id=$model->form_id;
                         $new->formproperty_id=$model->formproperty_id;
                         
			if($new->save())
                        {
			$version=Version::model()->getNextNumber($model->form->project_id, 3, 2,$new->primaryKey,$model->formproperty_id);
                        $this->redirect(array('/form/view/id/'.$model->form_id));
                        }        
		}

		$this->render('update',array(
			'model'=>$model,'form_id'=>$model->form_id
		));
	}


        
        public function actionDelete($id)
	{
		
            $model=$this->loadModel($id);
            $version=Version::model()->getNextNumber($model->form->project_id,3,3,$id,$model->formproperty_id);  
            $model->save();
            $this->redirect(array('/form/view/id/'.$model->form_id));
            
            }

        public function actionRollBack($id)
	{
	 $model=$this->loadModel($id);
         $formproperty=$model->formproperty_id;
         Formproperty::model()->rollback($model->formproperty_id, $id);
         $this->redirect(array('/formproperty/view/id/'.$formproperty));
        }
        
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Formproperty');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Formproperty('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Formproperty']))
			$model->attributes=$_GET['Formproperty'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Formproperty the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Formproperty::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Formproperty $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='formproperty-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
