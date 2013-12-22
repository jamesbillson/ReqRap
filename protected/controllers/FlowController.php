<?php

class FlowController extends Controller
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
				'actions'=>array('create','update','updateendpoints'),
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
	public function actionCreate($start, $id)
	{
	// CREATE A NEW FLOW	
            $flow=new Flow;
                        $flow->startstep_id=$start;
                        $flow->rejoinstep_id=$start;
                        $flow->usecase_id=$id;
                        $flow->main=0;
                        $flow->name=Flow::model()->getNextFlow($id);
                        $flow->save();
                        
             // ADD A STEP TO THE FLOW AND THEN SEND TO THE STEP EDIT FORM
             $step=new Step;
                        $step->flow_id=$flow->getPrimaryKey();
                        $step->number=1;
                        $step->text='New step.';
                         $step->result='Result';
                        $step->save();
                        $id=$step->getPrimaryKey();
              $this->redirect(array('/step/update/flow/'.$step->flow_id.'/id/'.$id));
		

	}

        	public function renumberFlows($id)
       {
               
               $data = Flow::model()->findAll(array('order'=>'id ASC', 'condition'=>'usecase_id=:x and main=0', 'params'=>array(':x'=>$id)));
               $label=chr(ord('A')-1);
                       //
               foreach($data as $line) {
                   $label= chr(ord($label)+1);
                   $line->name = $label;
                   $line->save(false);
               }
	}
        
          public function actionUpdateEndpoints($flow,$id,$end)
	{
		$model=$this->loadModel($flow);
               if($end==1)
                $model->startstep_id=$id;
               if($end==2)
               $model->rejoinstep_id= $id;
                 $model->save();
                
		
		$this->redirect(array('/step/update/flow/'.$model->id.'/id/-1'));
		
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

		if(isset($_POST['Flow']))
		{
			$model->attributes=$_POST['Flow'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Flow');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Flow('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Flow']))
			$model->attributes=$_GET['Flow'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Flow the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Flow::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Flow $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='flow-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
