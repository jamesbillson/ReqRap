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
	public function actionView($id) // Note that this is form_id
	{
             	$versions=Version::model()->getVersions($id,9,'form_id');
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
            $flow=Flow::model()->findbyPK($id);	
            $model=new Step;
                
                $number= 1+ Step::model()->getNextNumber($id);
                $model->number=$number;
                $model->flow_id= $flow->flow_id;
                $model->project_id= Yii::app()->session['project'];
                $model->release_id=Release::model()->currentRelease($model->project_id);
                $model->text = 'New step';
                $model->result = 'Result';
                $model->actor_id=$flow->usecase->actor_id;
                $model->step_id=Version::model()->getNextID(9);
                $model->save();
                $version=Version::model()->getNextNumber($model->flow->usecase->package->project_id,9,1,$model->getPrimaryKey(),$model->step_id);   
                     
		
		$this->redirect(array('/step/update/flow/'.$model->flow_id.'/id/'.$model->id));
		
	}

      	public function actionInsert($id)
	{
            $step=$this->loadModel($id);
            
            $number=$step->number;
            $flow=$step->flow_id;
            
            Step::model()->insertNumber($number,$flow);
            
            //load all the following steps.
            
            //loop through and create new versions with +1 on
            
            $model=new Step;
               
            $number= 1+ Step::model()->getNextNumber($id);
                $model->number=$number;
                $model->flow_id= $step->flow->flow_id;
                $model->text = 'Inserted new step';
                $model->result = 'Result';
                $model->actor_id=$step->flow->usecase->actor_id;
                $model->step_id=Version::model()->getNextID(9);
                $model->project_id= Yii::app()->session['project'];
                $model->release_id=Release::model()->currentRelease($model->project);
                $model->save();
                $version=Version::model()->getNextNumber($model->flow->usecase->package->project_id,9,1,$model->getPrimaryKey(),$model->step_id);   
                     
		
		$this->redirect(array('/step/update/flow/'.$model->flow_id.'/id/'.$model->id));
		
		
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
        $new= new Step;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
               
		if(isset($_POST['Step']))
		{
			
                         $new->attributes=$_POST['Step'];
                         $new->number=$step->number;
                         $new->flow_id=$step->flow_id;
                         $new->step_id=$step->step_id;
                        $new->project_id=$step->project_id;
                         $new->release_id=$step->release_id;
                         
			if($new->save())
                        {
			$version=Version::model()->getNextNumber($model->usecase->package->project_id, 9, 2,$new->getPrimaryKey(),$step->step_id);
                        $this->redirect(array('/step/update/flow/'.$model->id.'/id/-1'));
                        
                        }        
                    
                 
				
		}

		$this->render('/step/update',array(
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
                //$id=$model->flow->usecase_id;
                $flow=$model->flow->id;
                $flow_id=$model->flow->flow_id;
                $flowmodel=Flow::model()->findbyPK($flow);
                $version=Version::model()->getNextNumber($model->flow->usecase->package->project_id,9,3,$id,$model->step_id);  
	   
            
                //IF THIS IS THE LAST STEP, THEN DELETE THE FLOW, AND RENUMBER
             $steps= Flow::model()->checkSteps($flow); // Update for versions
             if ($steps==0){
                 
                 $flowmodel->delete();// Needs to be a version delete
                 
                 FlowController::renumberFlows($id);
             }
                  Step::model()->reNumber($flow);
		$this->redirect(array('/step/update/flow/'.$flow_id.'/id/-1'));
		
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
