<?php

class StepifaceController extends Controller
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Stepiface;

		if(isset($_POST['Stepiface']))
		{
			$model->attributes=$_POST['Stepiface'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->step_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
public function actionCreateInline()
	{
		
                $model=new Stepiface;

		if(isset($_POST['step_id']))
		{
                    $model->step_id=$_POST['step_id'];
                    $step=Step::model()->findbyPK($model->step_id);
                                   
		 if(!empty($_POST['new_interface'])){
                     
                     $iface=new Iface;
                     
                     $iface->number=Iface::model()->getNextIfaceNumber($step->flow->usecase->package->project->id);
                     $iface->name=$_POST['new_interface'];
                     $iface->type_id=Interfacetype::model()->getUnclassified($step->flow->usecase->package->project->id);
                     $iface->project_id=$step->flow->usecase->package->project->id;
                     $iface->file='default.png';
                     $iface->save(false);
                     $model->iface_id=$iface->getprimaryKey();
                     
                   //  make a new interface record
                    // get the new PK() 
                 }	
		ELSE {
                        
			$model->iface_id=$_POST['interface'];
                }
                        $model->save(false);
                }
                        $this->redirect(array('/step/update/id/'.$model->step->id.'/flow/'.$model->step->flow->id));
		
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

		if(isset($_POST['Stepiface']))
		{
			$model->attributes=$_POST['Stepiface'];
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
		$model=Stepiface::model()->findbyPK($id);
                $flow_id=$model->step->flow->id;
                $model->delete();

		$this->redirect(array('/step/update/id/-1/flow/'.$flow_id));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Stepiface');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Stepiface('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Stepiface']))
			$model->attributes=$_GET['Stepiface'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Stepiface the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Stepiface::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Stepiface $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='stepiface-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
