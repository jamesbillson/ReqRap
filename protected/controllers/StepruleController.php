<?php

class StepruleController extends Controller
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
				'actions'=>array('create','update','createinline','delete'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

        public function actionCreateInline()
	{
		
                $model=new Steprule;

		if(isset($_POST['step_id']))
		{
                    $model->step_id=$_POST['step_id'];
                 $step=Step::model()->findbyPK($model->step_id);
                    
		 if(!empty($_POST['new_rule'])){
                     $rule=new Rule;
                     
                     $rule->number=Rule::model()->getNextNumber($step->flow->usecase->package->project->id);
                     $rule->rule_id=Rule::model()->getNextID($step->flow->usecase->package->project->id);
                     $rule->text='stub';
                     $rule->title=$_POST['new_rule'];
                     $rule->project_id=$step->flow->usecase->package->project->id;
                     
                     $rule->save(false);
                     $version=Version::model()->getNextNumber($step->flow->usecase->package->project->id,1,1,$rule->primaryKey,$rule->rule_id);
                   
                     $model->rule_id=$rule->rule_id;
                 }	
             else {
                     $model->rule_id=$_POST['rule'];
                 }
                        
                        $model->save(false);
                }
                        $this->redirect(array('/step/update/id/'.$model->step->id.'/flow/'.$model->step->flow->id));
		
	}
        
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Steprule;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Steprule']))
		{
			$model->attributes=$_POST['Steprule'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->step_id));
		}

		$this->render('create',array(
			'model'=>$model,
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Steprule']))
		{
			$model->attributes=$_POST['Steprule'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->step_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model=Steprule::model()->findbyPK($id);
                $step_id=$model->step_id;
                $flow=$model->step->flow_id;
                $model->delete();

		$this->redirect(array('/step/update/flow/'.$flow.'/id/'.$step_id));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Steprule');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Steprule('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Steprule']))
			$model->attributes=$_GET['Steprule'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Steprule the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Steprule::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Steprule $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='steprule-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
