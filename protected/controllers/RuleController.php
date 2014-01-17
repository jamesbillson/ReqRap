<?php

class RuleController extends Controller
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=$this->loadModel($id);
                $versions=Rule::model()->getVersions($model->rule_id);
            $this->render('view',array(
			'model'=>$model,'versions'=>$versions
                
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($type, $id)
	{
		if ($type==1) {
                    $usecase=Usecase::model()->find('id='.$id);
                    $project=$usecase->package->project->id;
                            } ELSE {
                     $project=$id;            
                            }
          
                $model=new Rule;
                

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Rule']))
		{
                    
		// get the highest rule_id and increment one.
                    $version=Version::model()->getNextNumber($project,1,1);   
                    $model->attributes=$_POST['Rule'];
                    $model->version_id=$version;
                    $model->number=Rule::model()->getNextNumber($project);
                    $model->rule_id=Rule::model()->getNextID($project);
                    $model->active=1;
                    if($model->save())
                    {
                       $this->redirect(array('/project/view/tab/rules/id/'.$project));
		 
                    }
                 
                        
                }
                
              

		$this->render('create',array(
			'model'=>$model,'id'=>$id,'project'=>$project,
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
                $new= new Rule;

            
		if(isset($_POST['Rule']))
		{
                      $version=Version::model()->getNextNumber($model->project_id, 1, 2);  
			$new->attributes=$_POST['Rule'];
                         $new->version_id=$version;
                         $new->number=$model->number;
                         $new->project_id=$model->project_id;
                         $new->rule_id=$model->rule_id;
                         $new->active=1;
			if($new->save())
                        {
			$model->active=0;
                        $model->save();
                            $this->redirect(array('/project/view/tab/rules/id/'.$model->project_id));
                        }        
		}

		$this->render('update',array(
			'model'=>$model,'project'=>$model->project_id
		));
	}

        public function actionRollBack($id)
	{
	 $model=$this->loadModel($id);
         $project=$model->project_id;
         Rule::model()->rollback($model->number, $id);
         $this->redirect(array('/project/view/tab/rules/id/'.$project));
        }
        
        
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		
            $model=$this->loadModel($id);
            $project=$model->project_id;
            $new= new Rule;
	    
            
                      $version=Version::model()->getNextNumber($model->project_id,1,3);  
			$new->title='deleted';
                        $new->text='deleted';
                         $new->version_id=$version;
                         $new->number=$model->number;
                         $new->project_id=$model->project_id;
                         $new->rule_id=$model->rule_id;
                         $new->active=0;
			if($new->save()){
                            $model->active=0;
                        $model->save();
	$this->redirect(array('/project/view/tab/rules/id/'.$project));
                        }
            
            }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Rule');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Rule('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Rule']))
			$model->attributes=$_GET['Rule'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Rule the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Rule::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Rule $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='rule-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
