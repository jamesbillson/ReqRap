<?php

class PackageController extends Controller
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
				'actions'=>array('updatepackage','bidsubmit','create','update','remove','addPackage','subcontractview'),
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
  public function actionView($id) // Note that this is package_id not id
	{
             	$versions=Version::model()->getVersions($id,5);
                $model=$this->loadModel($versions[0]['id']);
                $this->render('view',array('model'=>$model,
			'versions'=>$versions
        	));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	  public function actionCreate($id)
	{
	
                $model=new Package;

		if(isset($_POST['Package']))
		{
                   $model->attributes=$_POST['Package'];
                   $model->package_id=Version::model()->getNextID(5);
                   $model->number=Package::model()->getNextNumber($id);
                   $model->project_id=$id;
                    
                    if($model->save())
                    {
                     $version=Version::model()->getNextNumber($id,5,1,$model->primaryKey,$model->package_id);   
                     $this->redirect(array('/project/view/tab/packages/id/'.$id));
		    }
                        
                }
               
                $this->render('create',array(
			'model'=>$model,'id'=>$id,
		));
	}

        
  
     
        
        
      	public function actionUpdate($id)
	{
                $model=$this->loadModel($id);
                $new= new Package;

            
		if(isset($_POST['Package']))
		{
                        
			 $new->attributes=$_POST['Package'];
                         $new->project_id=$model->project_id;
                         $new->package_id=$model->package_id;
                         $new->number=$model->number;

			if($new->save())
                        {
			$version=Version::model()->getNextNumber($model->project_id, 5, 2,$new->primaryKey,$model->package_id);
                        $this->redirect(array('/project/view/tab/packages/id/'.$model->project_id));
                        }        
		}

		$this->render('update',array(
			'model'=>$model,'id'=>$model->project_id
		));
	}
        

	
public function actionDelete($id)
	{
		
            $model=$this->loadModel($id);
            $version=Version::model()->getNextNumber($model->project_id,5,3,$id,$model->actor_id);  
            $model->save();
            $this->redirect(array('/project/view/tab/packages/id/'.$project));
            
            }
        
        
        
  
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Package');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Package('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Package']))
			$model->attributes=$_GET['Package'];

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
		$model=Package::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='package-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
