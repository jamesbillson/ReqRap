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
				'actions'=>array('create','update','updateendpoints','delete'),
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
             	$versions=Version::model()->getVersions($id,8);
                $id=$versions[0]['usecase_id'];
                
                Yii::app()->session['setting_tab']='usecases';
		$versions=Version::model()->getVersions($id,10);
                $model=Usecase::model()->findbyPK($versions[0]['id']);
                $package=Package::model()->findbyPK(Version::model()->getVersion($model->package_id,5));
                
                $this->render('/usecase/view',array('model'=>$model,
			'versions'=>$versions,'package'=>$package
        	));
                
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($start, $id)
	{
 
            $project = Yii::app()->session['project'];
            $release=  Yii::app()->session['release'];
            //$parent=Step::model()->find('step_id ='.$start);// get the start step to get the actor
            $parent = Step::model()->with('flow')->find('step_id ='.$start);
            $parentflow = Flow::model()->with('usecase')->findbyPK($parent->flow->id);
// CREATE A NEW FLOW	
            $flow=new Flow;
                        $flow->startstep_id=$start; // Note these are now step_id not id
                        $flow->rejoinstep_id=$start;// Note these are now step_id not id
                        $flow->usecase_id=$id;
                        $flow->project_id=$project;
                        $flow->release_id=$release;
                        $flow->main=0; // new flow will always be ALT i.e. value 0
                        $flow->name=0;
                    //$flow->name=
                        $flow->flow_id=Version::model()->getNextID(8);
                        if ($flow->save()){
                        $flowid=$flow->getPrimaryKey();
                        
                        $version=Version::model()->getNextNumber($project,8,1,$flowid,$flow->flow_id);   
                    
             // ADD A STEP TO THE FLOW AND THEN SEND TO THE STEP EDIT FORM
             $step=new Step;
                        $step->flow_id=$flow->flow_id;
                        $step->number=1;
                        $step->project_id=$project;
                        $step->release_id=$release;
                        $step->step_id=Version::model()->getNextID(9);
                        $step->actor_id=$parent->actor_id;
                        $step->text='New step.';
                        $step->result='Result';
                       if($step->save())
                           {
                        $stepid=$step->getPrimaryKey();
                        $version=Version::model()->getNextNumber($project,9,1,$stepid,$step->step_id);   
                           }
                           ELSE 
                            {
                                echo 'step did not save';
                            }  
            } ELSE {
             echo 'flow did not save';
             }   
             $this->renumberFlows($id);
              $step = Step::model()->with('flow')->findByPk($stepid);
             $this->redirect(('/req/step/update/flow/'.$step->flow->id.'/id/'.$step->id));
		

	}

   
        
        
        
        
        	public function renumberFlows($usecase_id)
       {
               //echo 'Starting <br />';
               $data = Flow::model()->getNextFlow($usecase_id);
               $label=chr(ord('A')-1);
               //print_r($data);
               foreach($data as $line) {
                   $label= chr(ord($label)+1);
                   $flow=$this->loadModel($line['id']);
                   $flow->name = $label;
                   $flow->save(false);
                   //echo 'name: '.$flow->name.'<br />';
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
                
		
		$this->redirect(('/req/step/update/flow/'.$model->id.'/id/-1'));
		
	}
 
		public function actionUpdate($id)
	{
	$model=$this->loadModel($id);
                $new= new Flow;
            $release=Yii::App()->session['release'];
            $project=Yii::App()->session['project'];
            
		if(isset($_POST['Flow']))
		{
                        
			 $new->attributes=$_POST['Flow'];
                         $new->name=$model->name;
                         $new->project_id=$project;
                         $new->release_id=$release;
                         $new->flow_id=$model->flow_id;
                         
			if($new->save())
                        {
			$version=Version::model()->getNextNumber($model->project_id, 9, 2,$new->getPrimaryKey(),$model->flow_id);
                        $this->redirect(('/req/usecase/view/id/'.$model->project_id));
                        }        
		}

		$this->render('update',array(
			'model'=>$model,'id'=>$model->project_id
		));
	}

	
        public function actionDelete($id)
	{
	    $project=Yii::App()->session['project'];	
            $model=$this->loadModel($id);
            $version=Version::model()->getNextNumber($project,8,3,$id,$model->flow_id); 
            //$model->save();
            $this->renumberFlows($model->usecase_id);
            $this->redirect(('/req/usecase/view/id/'.$model->usecase_id));
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
