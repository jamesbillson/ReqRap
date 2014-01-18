<?php

class StepController extends Controller
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
				'actions'=>array('create','update','delete','insert'),
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
	public function actionCreate($id)
	{
		$model=new Step;
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $number= 1+ Step::model()->getNextNumber($id);
                $model->number=$number;
                $model->flow_id= $id;
                $model->text = 'New step';
                $model->result = 'Result';
                $model->save();
                
		
		$this->redirect(array('/step/update/flow/'.$model->flow_id.'/id/'.$model->id));
		
	}

      	public function actionInsert($id)
	{
            $step=$this->loadModel($id);
            
            $number=$step->number;
            $flow=$step->flow_id;
            // need to add 1 to all the later steps.
            //UPDATE step SET number = number+1 where number>$Number
            Step::model()->insertNumber($number,$flow);
            
            $model=new Step;
               
                $model->number=$number;
                $model->flow_id= $flow;
                $model->text = 'New step';
                $model->result = 'Result';
                $model->actor_id = $step->flow->usecase->actor_id;
                
                $model->save();
                
		Step::model()->reNumber($flow);
		
                //add the actor
                
                
                $this->redirect(array('/step/update/flow/'.$flow.'/id/-1'));
		
	}
        
        
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($flow,$id)
	{
	if($id!=-1){
            $step=$this->loadModel($id);
            $model=Flow::model()->findbyPK($step->flow->id);
        }
        if($id==-1){
              $model=Flow::model()->findbyPK($flow);
              $step=array();
              }

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
               
		if(isset($_POST['Step']))
		{
			$step->attributes=$_POST['Step'];
			if($step->save())
				$this->redirect(array('/step/update/flow/'.$model->id.'/id/-1'));
		}

		$this->render('update',array(
			'model'=>$model,'step'=>$step,'id'=>$id
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
                $id=$model->flow->usecase_id;
                $flow=$model->flow->id;
                $flowmodel=Flow::model()->findbyPK($flow);
                $model->delete();

                //IF THIS IS THE LAST STEP, THEN DELETE THE FLOW, AND RENUMBER
             $steps= Flow::model()->checkSteps($flow);
             if ($steps==0){
                 $flowmodel->delete();
                 FlowController::renumberFlows($id);
             }
                  Step::model()->reNumber($flow);
		$this->redirect(array('/step/update/flow/'.$flow.'/id/-1'));
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Step');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Step('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Step']))
			$model->attributes=$_GET['Step'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Step the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Step::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Step $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='step-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
