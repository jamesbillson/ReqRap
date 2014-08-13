<?php

class CategoryController extends Controller
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
				'actions'=>array('create','update','delete','history','up','down','rollback'),
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
     public function actionView($id) // Note that this is category_id not id
	{
         Yii::app()->session['setting_tab']='category';    	
         $versions=Version::model()->getVersions($id,17);
                $model=$this->loadModel($versions[0]['id']);
                $this->render('view',array('model'=>$model,
			'versions'=>$versions
        	));
	}
        
             public function actionHistory($id) // Note that this is form_id
	{
             	$versions=Version::model()->getVersions($id,17);
                $model=$this->loadModel($versions[0]['id']);
                $this->render('history',array('model'=>$model,
			'versions'=>$versions
        	));
	}
        
	  public function actionCreate()
	{
            Yii::app()->session['setting_tab']='category'; 
              $project=Yii::app()->session['project'];
                $model=new Category;

		if(isset($_POST['Category']))
		{
                   $model->attributes=$_POST['Category'];
                   $model->category_id=Version::model()->getNextID(17);
                   $model->release_id=Release::model()->currentRelease($project);
                   $model->number=Category::model()->getNextNumber($project);
                   $model->order=1.5;
                   $model->project_id=$project;
                
                    
                    if($model->save())
                    {
                     $version=Version::model()->getNextNumber($project,17,1,$model->primaryKey,$model->category_id);   
                     $this->redirect(array('/req/project/view/tab/category/id/'.$project));
		    }
                        
                }
               
                $this->render('create',array(
			'model'=>$model,'project_id'=>$project,
		));
	}


        
        
        	public function actionUpdate($id)
	{
                Yii::app()->session['setting_tab']='category'; 
                    $model=$this->loadModel($id);
                $new= new Category;
            $release=Yii::App()->session['release'];
            $project=Yii::App()->session['project'];
            
		if(isset($_POST['Category']))
		{
                        
			 $new->attributes=$_POST['Category'];
                         $new->project_id=$project;
                         $new->release_id=$release;
                         $new->category_id=$model->category_id;
                         $new->order=$model->order;
                         $new->number=$model->number;
                      
			if($new->save())
                        {
			$version=Version::model()->getNextNumber($project, 17, 2,$new->primaryKey,$model->category_id);
                        $this->redirect(array('/req/project/view/tab/category/id/'.$model->project_id));
                        }        
		}

		$this->render('update',array(
			'model'=>$model,'project_id'=>$project
		));
	}
        
        
        
          
        	public function actionUp($id)
	{
               Yii::app()->session['setting_tab']='structure'; 
                    $model=$this->loadModel($id);
                $release=Yii::App()->session['release'];
            $project=Yii::App()->session['project'];
                $new= new Category;
                        $new->attributes=$model->attributes;
                        $new->order=$model->order-1;
                      
			if($new->save())
                        {
			$version=Version::model()->getNextNumber($project, 17, 2,$new->primaryKey,$model->category_id);
                        $this->redirect(array('/req/project/view/tab/details/id/'.$model->project_id));
                        }        
		

		$this->render('update',array(
			'model'=>$model,'project_id'=>$project
		));
	}
        
        
          
        	public function actionDown($id)
	{
               Yii::app()->session['setting_tab']='structure'; 
                    $model=$this->loadModel($id);
            $release=Yii::App()->session['release'];
            $project=Yii::App()->session['project'];
                $new= new Category;
            
		
                        
			 $new->attributes=$model->attributes;
                         $new->order=$model->order+1;
                         
                      
			if($new->save())
                        {
			$version=Version::model()->getNextNumber($project, 17, 2,$new->primaryKey,$model->category_id);
                        $this->redirect(array('/req/project/view/tab/details/id/'.$model->project_id));
                        }        
		
		$this->render('update',array(
			'model'=>$model,'project_id'=>$project
		));
	}
        


      
public function actionDelete($id)
	{
	Yii::app()->session['setting_tab']='category'; 	
            $model=$this->loadModel($id);
            
            $version=Version::model()->getNextNumber($model->project_id,17,3,$id,$model->category_id); 
            
            $model->save();
            $this->redirect(array('/req/project/view/tab/category/id/'.$model->project_id));
            
            }


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Category');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Category('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Category']))
			$model->attributes=$_GET['Category'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Category the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Category::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Category $model the model to be validated
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
