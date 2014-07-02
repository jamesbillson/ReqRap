<?php

class WalkthrupathController extends Controller
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
				'actions'=>array('create','update','results', 'make','delete','run','viewrun'),
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
        
        public function actionViewRun($id)
	{
		$model=Testrun::model()->findbyAttributes(array('walkthrupath_id'=>$id));
                
                $this->render('/testrun/view',array(
			'id'=>$model->id,
		));
	}
        
   

        
           public function actionResults($id)
	{
		$this->render('/testrun/results',array(
			'id'=>$id,
		));
	}
        
        public function actionRun()
	
	{
	$newresult=new Walkthruresult;
	if(isset($_POST['result']))
		{
			$newresult->result=$_POST['result'];
                        $newresult->comments=$_POST['comments'] ;
                        $newresult->user_id=Yii::App()->user->id;
                        $newresult->walkthrupath_id=$_POST['id'] ;
			if($newresult->save())
			$this->redirect(array('/walkthrupath/view','id'=>$_POST['id']));
		}
	$this->redirect(array('/project/walkthru/'));
	}

	public function actionCreate($id)
	{
        Walkthrupath::model()->deleteOld();
	$release=Yii::App()->session['release']=$id;
           
            $data = Usecase::model()->getProjectUCs();

            if(count($data))
            {
                foreach($data as $usecase)
                {
                    $this->actionMake($usecase['id']);
                }
            }
            
          $this->redirect(array('/project/walkthru/'));
            
	}

        
        public function actionMake($id) // this is the db id
	{
        $project=Yii::App()->session['project'];
        $release=Yii::App()->session['release'];
        // Get the UC details
            $uc=Usecase::model()->findbyPK($id);
            // MAKE MAIN TEST CASE
            $all_flows=Flow::model()->getUCFlow($uc->id);
            $mainflow=$all_flows[0];
            
if (!empty($mainflow)){
        
    // Make a Walkthrough for this flow.        
        $walkthrupath=new Walkthrupath;
        $walkthrupath->number=Walkthrupath::model()->getNextNumber($release);
	$walkthrupath->usecase_id=$id;
        $walkthrupath->release_id=$release;
        $walkthrupath->name=$uc->name.'(main)';
        $walkthrupath->preparation='None';
        $walkthrupath->active=1;
        if($walkthrupath->save()){
            $walkthrupath_id=$walkthrupath->getPrimaryKey();
                  // GET STEPS IN FLOW.    
              $steps=Step::model()->getFlowSteps($mainflow['flow_id']);
              if (count($steps)){
              $x=0;
          
              foreach($steps as $step){
                  $x=$x+1;
                  $walkthrustep=new Walkthrustep;
                  $walkthrustep->number=$x;
                  $walkthrustep->walkthrupath_id=$walkthrupath_id;
                  $walkthrustep->action=$step['text'];
                  $walkthrustep->result=$step['result'];
                  $walkthrustep->save();
                  
                  
                // Get any intefaces, forms and rules.
           $x= $this->stepForms($step['id'],$walkthrupath_id,$x,$release);    
           $x= $this->stepRules($step['step_id'],$walkthrupath_id,$x,$release);
           $x= $this->stepIfaces($step['step_id'],$walkthrupath_id,$x,$release);    
             
               }
              }  
             } ELSE 
                 {
                        // The case hasn't saved 
                    $this->redirect(array('/site/fail'));
                }
            
 }             
   //Then get each alternate flow.
   
 
for($i=1;$i<=count($all_flows);$i++){  
if (!empty($all_flows[$i])){
       $flow=$all_flows[$i];
    // Make a TC for this flow.        
        $walkthrupath=new Walkthrupath;
        
        $startflow=$flow['startstep_id'];
        $endflow=$flow['rejoinstep_id'];

	$walkthrupath->number=Walkthrupath::model()->getNextNumber($release);
	$walkthrupath->usecase_id=$id;
        $walkthrupath->release_id=$release;
        $walkthrupath->name=$uc->name.'('.$flow['name'].')';
        $walkthrupath->preparation='None';
        $walkthrupath->active=1;
        if($walkthrupath->save()){
        $walkthrupath_id=$walkthrupath->getPrimaryKey();
        

        //determine the number of the start step
        
        // start number = where the step_id=startstep
     $startstepnumber=1;
     $endstepnumber=1;
        foreach($steps as $mainstep){
          if($mainstep['step_id']==$startflow) $startstepnumber=$mainstep['number'];  
          if($mainstep['step_id']==$endflow) $endstepnumber=$mainstep['number'];  
        }
        
        
        // main steps
            
       // Steps are ordered by Step Number
            
       // work out which is the start number (the relationship uses the step_id, which is not ordered)
       // work out which is the end number 
            
       // Step through them up to the start number.
    foreach($steps as $mainflowstep){
    if ($mainflowstep['number']<=$startstepnumber){
        $x++;
                         $walkthrustep=new Walkthrustep;
                         $walkthrustep->walkthrupath_id=$walkthrupath_id;
                          $walkthrustep->number=$x;
                          $walkthrustep->walkthrupath_id=$walkthrupath_id;
                          $walkthrustep->action=$mainflowstep['text'];
                          $walkthrustep->result=$mainflowstep['result'];
                          $walkthrustep->save();
                        }
                  }    
                  
            $altflowsteps=Step::model()->getFlowSteps($all_flows[$i]['flow_id']);
    // THEN GO THROUGH THE ALT FLOW STEPS 
        
        foreach($altflowsteps as $altflowstep){  
                  $x++;
                  $walkthrustep=new Walkthrustep;
                  $walkthrustep->walkthrupath_id=$walkthrupath_id;
                  $walkthrustep->number=$x;
                  $walkthrustep->action=$altflowstep['text'];
                  $walkthrustep->result=$altflowstep['result'];
                  $walkthrustep->save();
                  
                                      // Get any intefaces, forms and rules.
                  
                  
           $x= $this->stepForms($altflowstep['id'],$walkthrupath_id,$x,$release);    
            $x= $this->stepRules($altflowstep['step_id'],$walkthrupath_id,$x,$release);
            $x= $this->stepIfaces($altflowstep['step_id'],$walkthrupath_id,$x,$release);    
             
              }
             
             
                                         
            
                         
             foreach($steps as $mainflowstep){
                if ($mainflowstep['number']>=$endstepnumber){
                    $x++;
                         $walkthrustep=new Walkthrustep;
                          $walkthrustep->walkthrupath_id=$walkthrupath_id;
                          $walkthrustep->number=$x;
                          $walkthrustep->walkthrupath_id=$walkthrupath_id;
                          $walkthrustep->action=$mainflowstep['text'];
                          $walkthrustep->result=$mainflowstep['result'];
                          $walkthrustep->save();
                        }
                  }                
                         
             
       
                         
                         
                         
                    } ELSE {
                // The case hasn't saved  
                   $this->redirect(array('/site/fail'));
                   //echo 'walkthrough not saved';
                    }
                }
                }
                  
      // Set other TC's for the UC to inactive.
	//$this->redirect(array('/usecase/view/id/'.$uc->usecase_id));
		

 
 }                       
            
   
	
 
 private function stepForms($id,$walkthrupath_id,$x,$release)
 {
     
      $forms=Form::model()->getStepForms($id);
             if (count($forms)){
             foreach($forms as $form){ 
             
             $x++;  
             $walkthrustep=new Walkthrustep;
             $walkthrustep->number=$x;
             $walkthrustep->walkthrupath_id=$walkthrupath_id;
             $walkthrustep->result='#form#_'.$release.'_2_'.$form['form_id'];
             $walkthrustep->action='UF-'.str_pad($form['number'], 4, "0", STR_PAD_LEFT).' '.$form['name'];
             $walkthrustep->save();
                   }
                }
                return $x;
 }
 
 private function stepRules($id,$walkthrupath_id,$x,$release)
 {
     $rules=Rule::model()->getStepRules($id);
             if (count($rules)){
             foreach($rules as $rule){ 
             
              $x++;  
              $walkthrustep=new Walkthrustep;
              $walkthrustep->number=$x;
              $walkthrustep->walkthrupath_id=$walkthrupath_id;
              $walkthrustep->result=$rule['text'];
              $walkthrustep->action='BR-'.str_pad($rule['number'], 4, "0", STR_PAD_LEFT).' '.$rule['name'];
              $walkthrustep->save();
                          
                    }
                  }
                  return $x;
 }
 
 private function stepIfaces($id,$walkthrupath_id,$x,$release)
 {
    
      $ifaces=  Iface::model()->getStepIfaces($id);
             if (count($ifaces)){
             foreach($ifaces as $iface){ 
             
                       $x++;  
                        $walkthrustep=new Walkthrustep;
                        $walkthrustep->number=$x;
                        $walkthrustep->walkthrupath_id=$walkthrupath_id;
                        $walkthrustep->result='#image#_'.$release.'_12_'.$iface['iface_id'];
                        $walkthrustep->action='IF-'.str_pad($iface['number'], 4, "0", STR_PAD_LEFT).' '
                                . ''.$iface['name'];
                        $walkthrustep->save();
                       
                    }
                  }
              return $x;
 }
 
 
 
 public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Walkthrupath']))
		{
			$model->attributes=$_POST['Walkthrupath'];
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
		$model=$this->loadModel($id);
         
                $model->delete();
               
                $this->redirect(array('/project/project/'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Walkthrupath');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

        
        
        
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Walkthrupath('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Walkthrupath']))
			$model->attributes=$_GET['Walkthrupath'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Walkthrupath the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Walkthrupath::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Walkthrupath $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='walkthrupath-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
