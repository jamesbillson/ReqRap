<?php

class SimpleController extends Controller
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
             	$versions = Version::model()->getVersions($id,18);
                $model=$this->loadModel($versions[0]['id']);
                $this->render('view',array('model'=>$model,
			'versions'=>$versions
        	));
	}

	     public function actionHistory($id) // Note that this is form_id
	{
             	$versions=Version::model()->getVersions($id,18);
                $model=$this->loadModel($versions[0]['id']);
                $this->render('history',array('model'=>$model,
			'versions'=>$versions
        	));
	}
	
                 public function actionCreate($id)
	{
	    $release=Yii::App()->session['release'];
            $project=Yii::App()->session['project'];
                $category=Category::model()->findbyPK($id);
                $category_id=$category->category_id;
                $model=new Simple;

		if(isset($_POST['Simple']))
		{
                    
		        
                    $model->attributes=$_POST['Simple'];
                    $model->number=Simple::model()->getNextNumber($category_id);
                    $model->simple_id=Version::model()->getNextID(18);
                    $model->project_id=$project;
                    $model->release_id=$release;
                    
                    if($model->save())
                    {
                     $version=Version::model()->getNextNumber($project,18,1,$model->primaryKey,$model->simple_id);   
                     Simple::model()->Renumber($category_id);
     
                     $this->redirect(array('/category/view/id/'.$model->category_id));
		    }
                        
                }
                $this->render('create',array(
			'model'=>$model,'category_id'=>$category_id,
		));
	}
        
        
   public function actionUpdate($id)
	{
            
           $release=Yii::App()->session['release'];
            $project=Yii::App()->session['project'];
            
            $model=$this->loadModel($id);
                $new= new Simple;

		if(isset($_POST['Simple']))
		{
                  	 $new->attributes=$_POST['Simple'];
                         $new->number=$model->number;
                         $new->simple_id=$model->simple_id;
                         $new->project_id=$project;
                         $new->release_id=$release;
                         
                         
			if($new->save())
                        {
			$version=Version::model()->getNextNumber($project, 18, 2,$new->primaryKey,$new->simple_id);
                        $this->redirect(array('/category/view/id/'.$model->category_id));
                        }        
		}

		$this->render('update',array(
			'model'=>$model,'category_id'=>$model->category_id
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
            $version=Version::model()->getNextNumber($model->category->project_id,18,3,$id,$model->simple_id);  
	    //$model->active=0;
            $model->save();
            $this->redirect(array('/category/view/id/'.$model->category_id));
            
            }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Simple');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Simple('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Simple']))
			$model->attributes=$_GET['Simple'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Simple the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Simple::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Simple $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='simple-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
