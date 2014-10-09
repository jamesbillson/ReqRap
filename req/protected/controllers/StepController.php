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
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete','insert','view'),
				'users'=>array('@'),
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
             	$versions=Version::model()->getVersions($id,9);
                $id=$versions[0]['flow_id'];;
                
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
	public function actionCreate($id)
	{
		$project=Yii::App()->session['project'];
                //$flow=Flow::model()->findbyPK($id);	
                $flow = Flow::model()->findByPk($id);
                $usecaseid = Version::model()->getVersion($flow->usecase_id,10);
                $usecase=Usecase::model()->findByPk($usecaseid);
                
    
    
                $model=new Step;
                
                $number= 1+ Step::model()->getNextNumber($id);
                $model->number=$number;
                $model->flow_id= $flow->flow_id;
                $model->project_id= $project;
                $model->release_id=Release::model()->currentRelease($project);
                $model->text = 'Actor ...';
                $model->result = 'System ...';
                $model->actor_id=$usecase->actor_id;
                $model->step_id=Version::model()->getNextID(9);
                $model->save();
                $version=Version::model()->getNextNumber($project,9,1,$model->getPrimaryKey(),$model->step_id);   
                     
		
		$this->redirect(('/req/step/update/flow/'.$model->flow_id.'/id/'.$model->id));
		
	}

      	public function actionInsert($id)
	{
            //$step=$this->loadModel($id);
            $step = Step::model()->with('flow')->findByPk($id);
            $flow = Flow::model()->with('usecase')->findbyPK($step->flow->id);
            $project=Yii::App()->session['project'];
            $release=Yii::App()->session['release'];
            $number=$step->number;
            $flow_id=$step->flow_id;
            
            Step::model()->insertNumber($number,$flow_id);
            
            
            $model=new Step;
               
            $number= 1+ Step::model()->getNextNumber($id);
                $model->number=$number;
                $model->flow_id= $flow->flow_id;
                $model->text = 'Inserted new step';
                $model->result = 'Result';
                $model->actor_id=$flow->usecase->actor_id;
                $model->step_id=Version::model()->getNextID(9);
                $model->project_id= $project;
                $model->release_id=$release;
                $model->save();
                $version=Version::model()->getNextNumber($project,9,1,$model->getPrimaryKey(),$model->step_id);   
                     
		$this->renumberSteps($flow->id);
		$this->redirect(('/req/step/update/flow/'.$model->flow_id.'/id/'.$model->id));
		
		
	}
        
        private function renumberSteps($id)
       {
               //echo 'Starting <br />';
               $data = Step::model()->getFlowSteps($id);
               $label=0;
               //print_r($data);
               foreach($data as $line) {
                   $label= $label+1;
                   $step=$this->loadModel($line['id']);
                   $step->number = $label;
                   $step->save(false);
                   //echo 'name: '.$flow->name.'<br />';
               }
	}
	
        
        
public function actionUpdate($flow,$id)
{
            $project=Yii::App()->session['project'];
	if($id!=-1){
           
            $step= Step::model()->findByPk($id);
            $flow = Step::model()->getStepParentFlow($id);
            $usecase= Flow::model()->getFlowParentUsecase($flow['id']);
            $package= Usecase::model()->getUsecaseParentPackage($usecase['id']);
            $model = Flow::model()->findByPk($flow['id']);
            $usecase= Flow::model()->getFlowParentUsecase($flow['id']);
            
            
        }
        if($id==-1){
              
              $model = Flow::model()->findByPk($flow);
              $usecase= Flow::model()->getFlowParentUsecase($flow);
              $package= Usecase::model()->getUsecaseParentPackage($usecase['id']);
              $step=array();
              }
        $new= new Step;

               
		if(isset($_POST['Step']))
		{
			
                         $new->attributes=$_POST['Step'];
                         // check the step text for wiki entries.
                         
                         
                         
                         
                         $new->number=$step->number;
                         $new->flow_id=$step->flow_id;
                         $new->step_id=$step->step_id;
                         $new->project_id=$step->project_id;
                         $new->release_id=$step->release_id;
                         
			if($new->save())
                        {
                        $newid= $new->getPrimaryKey();
			$version=Version::model()->getNextNumber($project, 9, 2,$newid,$step->step_id);
                       
                        $new->text = Version::model()->wikiInput($new->text,9,$newid);
                        $new->result = Version::model()->wikiInput($new->result,9,$newid);
                        $new->save();

                        $this->redirect(('/req/step/update/flow/'.$model->id.'/id/-1'));
                        
                        }        
                    
                 
				
		}

		$this->render('/step/update',array(
			'model'=>$model,'step'=>$step,'id'=>$id,'usecase'=>$usecase, 'package'=>$package
		));
}


	public function actionDelete($id)
	{
		$project=Yii::App()->session['project'];
                $model=$this->loadModel($id);
                $flow=Flow::model()->findbyPK(Version::model()->getVersion($model->flow_id,8));
                $fid=$flow->id;
                $flow_id=$flow->flow_id;
                $usecase_id=$flow->usecase_id;
                //$id=$model->flow->usecase_id;
                $version=Version::model()->getNextNumber($project,9,3,$id,$model->step_id);  
	   
            
                //IF THIS IS THE LAST STEP, THEN DELETE THE FLOW, AND RENUMBER
             $steps= Flow::model()->checkSteps($flow->id); // Update for versions
             if ($steps==0){
                 
             //$flow->delete();// Needs to be a version delete
            
            $version=Version::model()->getNextNumber($project,8,3,$fid,$flow_id); 
            
           // SOMETHING WRONG HERE - CAN't FIGURE IT OUT.
            
            
            /*
             * 
             * 
             * 
             *   H H EEE L   PP
             *   HHH EEE L   PP
             *   H H EEE LLL P
             * 
             * 
             * 
             */
            
            
            
             $this->renumberFlows($usecase_id);
             $this->redirect(('/req/usecase/view/id/'.$usecase_id));
             }
             Step::model()->reNumber($flow_id);
            //echo 'renumbering flow '.$flow_id;
            $this->redirect(('/req/step/update/flow/'.$fid.'/id/-1'));
		
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
