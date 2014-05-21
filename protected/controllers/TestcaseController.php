<?php

class TestcaseController extends Controller
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
		$model=Testrun::model()->findbyAttributes(array('testcase_id'=>$id));
                
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
        
        public function actionRun($id)
	{
           
            // Make a Test Run with the $id TEST CASE related to it.
            
           	$model=new Testrun;
                $model->release_id=Yii::App()->session['release'];
                $model->number=1;
                $model->testcase_id=$id;
                $model->status=2;
		$model->save(false);
                $testrun=$model->getPrimaryKey();
		
            // Make a Test Result for each Test Step related to the Test RUn
            // Set them all to 'Not Tested'
            
                $teststeps=  Teststep::model()->findall('testcase_id='.$id);
                foreach ($teststeps as $teststep){
                
                    $result=new Testresult;
                    $result->testrun_id=$testrun;
                    $result->teststep_id=$teststep->id;
                    $result->user_id=Yii::App()->user->id;
                    $result->result=4;
                    $result->comments='None';
                    $result->save(false);
                    
                }
                
            
            // Show a spreadsheet style form with all the Steps, Results, and Comments.
            
            
                $this->redirect(array('/testrun/view/id/'.$testrun));
            
            
            
            /* $testcase=$this->loadModel($id);
            $release_id=$testcase->release_id;
            $teststeps=  Teststep::model()->findAll('testcase_id='.$id);
            $laststep= Teststep::model()->getLastStep($id);
            $testrun=Testrun::model()->getCurrentRun($release_id); 
            $testcaseresult=Testcaseresult::model()->find('testrun_id='.$testrun.' AND testcase_id='.$id);
            
            
            $newresult=new Testresult;
            if(isset($_POST['Testresult']))
		{
			$newresult->attributes=$_POST['Testresult'];
                        $newresult->user_id = Yii::app()->user->id;
                       
                        //TEST RESULT 1=>'Fail', 2=>'Pass',3=>'Block', 4=>'Not Tested'
                        // TEST CASE RESULT 1=>'new', 2=>'running', 3=>'blocked', 4=>'fail',5=>'pass'
                        if($newresult->save()){
                           // if the testcase result is 'new' set it to 'running'
                            if($testcaseresult->status == 1)$testcaseresult->status =2;
                                                      
                            //if its a fail, fail the testcaseresult
                            if($newresult->result==1)$testcaseresult->status =4;
                            
                            //if its a block, block the test case result
                            if($newresult->result==3)$testcaseresult->status =3;
                            
                            $testcaseresult->save();
                        }
                        
		}
            
	// GET THE CURRENT TEST RUN.
        $testcase=$this->loadModel($id);
        $release_id=$testcase->project_id;
        $teststeps=  Teststep::model()->findAll('testcase_id='.$id);
        $testrun=Testrun::model()->getCurrentRun($release_id);
       
        $rendered=0; // flag for which step is to have a form
        $complete=0; // flag to say the test case is finished.
        $pass=0; // flag to say the test case is PASSing
        $block=0; // flag to say the test case is BLOCKED.
        $laststep=0;

        // go through the test steps and see which have answers from the current test run.
        /*
        foreach ($teststeps as $teststep) {
            $testresult=  Testresult::model()->find(array('order'=>'date ASC',
                                        'condition'=>'testrun_id=:x AND teststep_id=:y',
                                        'params'=>array(':x'=>$testrun->id,':y'=>$teststep->id)));
           
            if ($testresult['result']==3) {
                $complete=1;// THe test case is BLOCKED
            $block=1;
                
            }
             if ($testresult['result']!=1) {
                // THe test step is FAILED
                $pass=0;
            } ELSE {
                $pass=1;
            }
             if (!empty($testresult['id']) ){
            $laststep=$teststep->id;
                       
            
	     } 
            if (empty($testresult['id']) && $rendered==0){
            $rendered=$teststep->id;
                       
            
	     } } 

// IF WE get to the end, and they are all filled out, then the test case is done
                if($teststep->id == $rendered) $complete=1;
                //IF WE get a BLOCK then the test case is done.
              
                
        // LOAD the form with a new Testresult model.
         $this->render('run',array(
			'model'=>$testcase,
                        'teststep_id'=>$rendered,
                        'laststep'=>$laststep,
                        'newresult'=>$newresult,
                        'complete'=>$complete,
                        'block'=>$block,
                        'pass'=>$pass,
                        'testrun'=>$testrun
		));
         */
        } 
        

	public function actionCreate($id)
	{
		Yii::App()->session['release']=$id;
            
            //echo 'Load a list of all the UCs';
            $data = Usecase::model()->getProjectUCs();
            
            //Call actionMake for each UC.
            if(count($data)){
                
                foreach($data as $usecase){
             $this->actionMake($usecase['id']);
              //echo "<pre>";
              //print_r($usecase);
              // echo "</pre>";
                }
                
            }
            
            
            //Display the Test Case page at the end.
            
          $this->redirect(array('/project/view/tab/testcases'));
            
            
            
	}

        
        public function actionMake($id) // this is the db id
	{
$project=Yii::App()->session['project'];
$release=Yii::App()->session['release'];
        // Get the UC details
            
            $uc=Usecase::model()->findbyPK($id);
            // MAKE MAIN TEST CASE
            
           // print_r($uc);
            $all_flows=Flow::model()->getUCFlow($uc->id);
            echo "Loaded Flows";
            //print_r($all_flows);
            //echo "</pre>"; 
            $mainflow=$all_flows[0];
            
            
if (!empty($mainflow)){
        
    // Make a TC for this flow.        
        $testcase=new Testcase;

	$testcase->number=Testcase::model()->getNextNumber($release);
	$testcase->usecase_id=$id;
        $testcase->release_id=$release;
        $testcase->name=$uc->name.'(main)';
        $testcase->preparation='None';
        $testcase->active=1;
        if($testcase->save()){
            $testcase_id=$testcase->getPrimaryKey();
                  // GET STEPS IN FLOW.    
              $steps=Step::model()->getFlowSteps($mainflow['flow_id']);
              if (count($steps)){
              $x=0;
          
              foreach($steps as $step){
                  $x=$x+1;
                  $teststep=new Teststep;
                  $teststep->number=$x;
                  $teststep->testcase_id=$testcase_id;
                  $teststep->action=$step['text'];
                  $teststep->result=$step['result'];
                  $teststep->save();
                  
                  
                                    // Get any intefaces, forms and rules.
            $this->stepForms($step['id'],$testcase_id);    
            $this->stepRules($step['step_id'],$testcase_id);
            $this->stepIfaces($step['step_id'],$testcase_id);    
             
              }
                    
                    
                }  
                /*
                $result=new Testcaseresult;
                $result->testcase_id=$testcase_id;
                $result->status=1;
                // ############ UPDATE GET CURRENT BUN to RELEASE
                $result->testrun_id=  Testrun::model()->getCurrentRun($testcase->release_id);
                $result->modified_date=date('Y-m-d H:i:s');
                $result->user_id=Yii::app()->user->id;   
                      $result->save();  
                  */      
                
              } ELSE {
                        // The case hasn't saved 
                    $this->redirect(array('/site/fail'));
                   // echo 'MAIN Test Case not saved<br /><pre>';
                   // print_r ($testcase->getErrors());
                   //  echo '</pre>';
              }
            
 }             
   //Then get each alternate flow.
   
 
for($i=1;$i<=count($all_flows);$i++){  
if (!empty($all_flows[$i])){
       $flow=$all_flows[$i];
    // Make a TC for this flow.        
        $testcase=new Testcase;
        
        $startflow=$flow['startstep_id'];
        $endflow=$flow['rejoinstep_id'];

	$testcase->number=Testcase::model()->getNextNumber($release);
	$testcase->usecase_id=$id;
        $testcase->release_id=$release;
        $testcase->name=$uc->name.'('.$flow['name'].')';
        $testcase->preparation='None';
        $testcase->active=1;
        if($testcase->save()){
        $testcase_id=$testcase->getPrimaryKey();
        

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
                         $teststep=new Teststep;
                         $teststep->testcase_id=$testcase_id;
                          $teststep->number=$x;
                          $teststep->testcase_id=$testcase_id;
                          $teststep->action=$mainflowstep['text'];
                          $teststep->result=$mainflowstep['result'];
                          $teststep->save();
                        }
                  }    
                  
            $altflowsteps=Step::model()->getFlowSteps($all_flows[$i]['flow_id']);
    // THEN GO THROUGH THE ALT FLOW STEPS 
        
        foreach($altflowsteps as $altflowstep){  
                  $x=$x+1;
                  $teststep=new Teststep;
                  $teststep->testcase_id=$testcase_id;
                  $teststep->number=$x;
                  $teststep->action=$altflowstep['text'];
                  $teststep->result=$altflowstep['result'];
                  $teststep->save();
                  
                                      // Get any intefaces, forms and rules.
                  
                  
            $this->stepForms($altflowstep['id'],$testcase_id);    
            $this->stepRules($altflowstep['step_id'],$testcase_id);
            $this->stepIfaces($altflowstep['step_id'],$testcase_id);    
             
              }
             
             
                                         
            
                         
             foreach($steps as $mainflowstep){
                if ($mainflowstep['number']>=$endstepnumber){
                         $teststep=new Teststep;
                          $teststep->testcase_id=$testcase_id;
                          $teststep->number=$x;
                          $teststep->testcase_id=$testcase_id;
                          $teststep->action=$mainflowstep['text'];
                          $teststep->result=$mainflowstep['result'];
                          $teststep->save();
                        }
                  }                
                         
             
          /*
                         // MAKE THE TEST RESULT ENTRY
                $result=new Testcaseresult;
                $result->testcase_id=$testcase_id;
                $result->status=1;
                $result->testrun_id=  Testrun::model()->getCurrentRun($testcase->release_id);
                $result->modified_date=date('Y-m-d H:i:s');
                $result->user_id=Yii::app()->user->id;   
                      $result->save();  
               */         
                         
                         
                         
                    } ELSE {
                // The case hasn't saved  
                   $this->redirect(array('/site/fail'));
                   //echo 'ALT Test Case not saved';
                    }
                }
                }
                  
      // Set other TC's for the UC to inactive.
	//$this->redirect(array('/usecase/view/id/'.$uc->usecase_id));
		

 
 }                       
            
         
        
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	
 
 private function stepForms($id,$testcase_id)
 {
     $x=0;
      $forms=Form::model()->getStepForms($id);
             if (count($forms)){
             foreach($forms as $form){ 
                      
                        $formproperties=  Formproperty::model()->getFormProperty($form['form_id']);
                        if (count($formproperties)){
                        foreach($formproperties as $property){ 
                       
                       $x++;  
                        $teststep=new Teststep;
                        $teststep->number=$x;
                        $teststep->testcase_id=$testcase_id;
                        $teststep->action='Confirm Form Property';
                        $teststep->result='UF-'.str_pad($form['number'], 4, "0", STR_PAD_LEFT).' '.$form['name'].' - field: '.$property['name'];
                        $teststep->save();
                            }
                          }
                    }
                  }
 }
 
 private function stepRules($id,$testcase_id)
 {
     $x=0;
      $rules=Rule::model()->getStepRules($id);
             if (count($rules)){
             foreach($rules as $rule){ 
             
              $x++;  
              $teststep=new Teststep;
              $teststep->number=$x;
              $teststep->testcase_id=$testcase_id;
              $teststep->action='Validate Business Rule';
              $teststep->result='BR-'.str_pad($rule['number'], 4, "0", STR_PAD_LEFT).' '.$rule['title'];
              $teststep->save();
                          
                    }
                  }
 }
 
 private function stepIfaces($id,$testcase_id)
 {
     $x=0;
      $ifaces=  Iface::model()->getStepIfaces($id);
             if (count($ifaces)){
             foreach($ifaces as $iface){ 
             
                       $x++;  
                        $teststep=new Teststep;
                        $teststep->number=$x;
                        $teststep->testcase_id=$testcase_id;
                        $teststep->action='Confirm User Interface';
                        $teststep->result='IF-'.str_pad($iface['number'], 4, "0", STR_PAD_LEFT).' '
                                . ''.$iface['name'];
                        $teststep->save();
                       
                    }
                  }
 }
 
 
 
 public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Testcase']))
		{
			$model->attributes=$_POST['Testcase'];
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
	public function actionDelete($id,$ucid)
	{
		$model=$this->loadModel($id);
         
                $model->delete();
                if ($ucid !=-1) $this->redirect(array('/usecase/view/id/'.$ucid));
                $this->redirect(array('/project/view/tab/details'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Testcase');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

        
        
        
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Testcase('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Testcase']))
			$model->attributes=$_GET['Testcase'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Testcase the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Testcase::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Testcase $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='testcase-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
