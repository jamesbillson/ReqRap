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
	$project=Yii::App()->session['project'];
                $model=new Steprule;
                $model->steprule_id=Version::model()->getNextID(16);
                $model->project_id= $project;
                $model->release_id=Release::model()->currentRelease($project);
                
		if(isset($_POST['step_id']))
		{
                 
                 
                 $step=Step::model()->findbyPK($_POST['step_id']);
                 $model->step_id=$step->step_id;
                    
                             if(!empty($_POST['new_rule'])){
                                $rule=new Rule;

                                $rule->number=Rule::model()->getNextNumber($project);
                                $rule->rule_id=Version::model()->getNextID(1);
                                $rule->project_id= Yii::app()->session['project'];
                                $rule->release_id=Release::model()->currentRelease($rule->project_id);
                                $rule->text='stub';
                                $rule->title=$_POST['new_rule'];
                                $rule->project_id=$project;

                                $rule->save(false);
                                $version=Version::model()->getNextNumber($project,1,1,$rule->primaryKey,$rule->rule_id);

                                $model->rule_id=$rule->rule_id;
                            }		
                            else 
                            {
                                 $model->rule_id=$_POST['rule'];
                             }
                        
                  $model->save(false);
                  $version=Version::model()->getNextNumber($project,16,1,$model->primaryKey,$model->steprule_id);
                  
                }
                  $step = Step::model()->with('flow')->findByPk($_POST['step_db_id']);
             $this->redirect(array('/step/update/id/'.$step->id.'/flow/'.$step->flow->id));
		
	}
        
        
        
	public function actionCreate()
	{
		$model=new Steprule;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Steprule']))
		{
			$model->attributes=$_POST['Steprule'];
                        $model->steprule_id=Version::model()->getNextID(16);
                        $model->project_id= Yii::app()->session['project'];
                        $model->release_id=Release::model()->currentRelease($model->project_id);
			if($model->save())
                        $version=Version::model()->getNextNumber($project->id,1,16,$model->primaryKey,$model->steprule_id);
                      
				$this->redirect(array('view','id'=>$model->step_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	
        
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
            $release=Yii::App()->session['release'];
            $project=Yii::App()->session['project'];
		
		if(isset($_POST['Steprule']))
		{
			$new=new Steprule;
                    
                        $new->attributes=$_POST['Steprule'];
                        $new->steprule_id=$model->steprule_id;
                        $new->project_id=$project;
                        $new->release_id=$release;
                        if($new->save())
			$version=Version::model()->getNextNumber($project->id,2,16,$model->id,$model->steprule_id);
                
                        $this->redirect(array('view','id'=>$model->step_id));
                        
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

 
            public function actionDelete($id)
	{
                $model=Steprule::model()->findByPK($id);
                $flow=$model->step->flow_id;
                $step_id=$model->step->id;
                $project_id=$model->step->flow->usecase->package->project_id;
                $version=Version::model()->getNextNumber($project_id,16,3,$model->id,$model->steprule_id);
                  

		$this->redirect(array('/step/update/flow/'.$flow.'/id/'.$step_id));
	}
        
 
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Steprule');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


        
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
