<?php

class FormController extends Controller
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
				'actions'=>array('create','update','delete','history','rollback'),
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
	public function actionView($id) // Note that this is form_id
	{
             	$versions=Version::model()->getVersions($id,2,'form_id');
                $model=$this->loadModel($versions[0]['id']);
                $this->render('view',array('model'=>$model,
			'versions'=>$versions
        	));
	}
	
        public function actionHistory($id) // Note that this is form_id
	{
             	$versions=Version::model()->getVersions($id,2,'form_id');
                $model=$this->loadModel($versions[0]['id']);
                $this->render('history',array('model'=>$model,
			'versions'=>$versions
        	));
	}
        
        
        public function actionCreate($id)
	{
	
                $model=new Form;

		if(isset($_POST['Form']))
		{
                    
		        
                    $model->attributes=$_POST['Form'];
                    $model->project_id= Yii::app()->session['project'];
                    $model->release_id=Release::model()->currentRelease($model->project);
                    $model->number=Form::model()->getNextNumber($id);
                    $model->form_id=Version::model()->getNextID(2);
                    
                    
                    if($model->save())
                    {
                      
                     $version=Version::model()->getNextNumber($id,2,1,$model->primaryKey,$model->form_id);   
                     $this->redirect(array('/project/view/tab/forms/id/'.$id));
		    }
                        
                }
               
                $this->render('create',array(
			'model'=>$model,'id'=>$id,
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
                $new= new Form;

            
		if(isset($_POST['Form']))
		{
                        
			 $new->attributes=$_POST['Form'];
                         $new->number=$model->number;
                         $new->project_id=$model->project_id;
                         $new->release_id=$model->release_id;
                         $new->form_id=$model->form_id;
                         
			if($new->save())
                        {
			$version=Version::model()->getNextNumber($model->project_id, 2, 2,$new->primaryKey,$model->form_id);
                        $this->redirect(array('/project/view/tab/forms/id/'.$model->project_id));
                        }        
		}

		$this->render('update',array(
			'model'=>$model,'id'=>$model->project_id
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
            $version=Version::model()->getNextNumber($model->project_id,2,3,$id,$model->form_id);  
	    $model->save();
            $this->redirect(array('/project/view/tab/forms/id/'.$model->project_id));
            
            }


            
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Form');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Form('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Form']))
			$model->attributes=$_GET['Form'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Form the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Form::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Form $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='form-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
