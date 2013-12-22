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
				'actions'=>array('create','update','make','delete','run'),
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

        public function actionRun($id)
	{
		$this->render('run',array(
			'model'=>$this->loadModel($id),
		));
	}
        
        
        
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Testcase;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Testcase']))
		{
			$model->attributes=$_POST['Testcase'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

        
        public function actionMake($id)
	{

        // Get the UC details
            
            $uc=Usecase::model()->findbyPK($id);
            // MAKE MAIN TEST CASE
            $mainflow=Flow::model()->findAll('main=1 and usecase_id='.$id);
            
if (count($mainflow)){
        
    // Make a TC for this flow.        
        $testcase=new Testcase;

	$testcase->number=Testcase::model()->getNextNumber($uc->package->project->id);
	$testcase->usecase_id=$id;
        $testcase->project_id=$uc->package->project->id;
        $testcase->name=$uc->name.'(main)';
        $testcase->preparation='None';
        $testcase->active=1;
        if($testcase->save()){
            $testcase_id=$testcase->getPrimaryKey();
                  // GET STEPS IN FLOW.    
              $steps=Step::model()->findAll('flow_id='.$mainflow[0]['id']);
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
                  
                     $forms=Stepform::model()->findAll('step_id='.$step['id']);
             if (count($forms)){
             foreach($forms as $form){ 
                      
                         $formproperties=  Formproperty::model()->findAll('form_id='.$form->form_id);
                        if (count($formproperties)){
                        foreach($formproperties as $property){ 
                       
                       $x++;  
                        $teststep=new Teststep;
                        $teststep->number=$x;
                        $teststep->testcase_id=$testcase_id;
                        $teststep->action='Test Validation Rules';
                        $teststep->result='UF-'.str_pad($property->form->number, 4, "0", STR_PAD_LEFT).' '.$property->form->name.' - field: '.$property->name;
                        $teststep->save();
                            }
                          }
                    }
                  }
                  
            $rules=Steprule::model()->findAll('step_id='.$step['id']);
             if (count($rules)){
                   foreach($rules as $rule){ 
                       $x++;  
                       $teststep=new Teststep;
                  
                  $teststep->number=$x;
                  $teststep->testcase_id=$testcase_id;
                  $teststep->action='Verify rule';
                  $teststep->result='BR-'.str_pad($rule->rule->number, 4, "0", STR_PAD_LEFT).' '.$rule->rule->title;
                  $teststep->save();
                   }
             }
             
             
                 $ifaces=Stepiface::model()->findAll('step_id='.$step['id']);
             if (count($ifaces)){
                   foreach($ifaces as $iface){ 
                       $x++;  
                       $teststep=new Teststep;
                  
                  $teststep->number=$x;
                  $teststep->testcase_id=$testcase_id;
                  $teststep->action='Verify interface';
                  $teststep->result='UI-'.str_pad($iface->iface->number, 4, "0", STR_PAD_LEFT).' '.$iface->iface->name;
                  $teststep->save();
                   }
             }
             
             
          
             
              }
                    
                    
                }  
                
              } ELSE {
                        // The case hasn't saved 
                    $this->redirect(array('/site/fail'));
                   // echo 'MAIN Test Case not saved<br /><pre>';
                   // print_r ($testcase->getErrors());
                   //  echo '</pre>';
              }
            
 }             
   //Then get each alternate flow.
   
 
$flows=Flow::model()->findAll('main=0 and usecase_id='.$id);
if (count($flows)){
foreach($flows as $flow){         
    // Make a TC for this flow.        
        $testcase=new Testcase;
        
        $startflow=$flow['startstep_id'];
        $endflow=$flow['rejoinstep_id'];

	$testcase->number=Testcase::model()->getNextNumber($uc->package->project->id);
	$testcase->usecase_id=$id;
        $testcase->project_id=$uc->package->project->id;
        $testcase->name=$uc->name.'('.$flow['name'].')';
        $testcase->preparation='None';
        $testcase->active=1;
        if($testcase->save()){
        $testcase_id=$testcase->getPrimaryKey();
//GET the start of the Flow
        

        $mainflowsteps=Step::model()->findAll('id <='.$startflow.' AND flow_id='.$mainflow[0]['id']);
          // Start going through the main flow until you hit the start step of the ALT flow.
 
        $x=0;
        foreach($mainflowsteps as $mainflowstep){  

            
                  $x=$x+1;
                  $teststep=new Teststep;
                  
                  $teststep->number=$x;
                  $teststep->testcase_id=$testcase_id;
                  $teststep->action=$mainflowstep['text'];
                  $teststep->result=$mainflowstep['result'];
                  $teststep->save();
                  

             
             
             
          }    
                  
            $altflowsteps=Step::model()->findAll('flow_id='.$flow['id']);
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
                  
                  
              // FORM AND FORM FIELDS
                    $forms=Stepform::model()->findAll('step_id='.$altflowstep['id']);
             if (count($forms)){
             foreach($forms as $form){ 
                      
                         $formproperties=  Formproperty::model()->findAll('form_id='.$form->form_id);
                        if (count($formproperties)){
                        foreach($formproperties as $property){ 
                       
                       $x++;  
                        $teststep=new Teststep;
                        $teststep->number=$x;
                        $teststep->testcase_id=$testcase_id;
                        $teststep->action='Test Validation Rules';
                        $teststep->result='UF-'.str_pad($property->form->number, 4, "0", STR_PAD_LEFT).' '.$property->form->name.' - field: '.$property->name;
                        $teststep->save();
                            }
                            }
                    }
                  }
                  
                  
            $rules=Steprule::model()->findAll('step_id='.$altflowstep['id']);
             if (count($rules)){
                   foreach($rules as $rule){ 
                       $x++;  
                       $teststep=new Teststep;
                  
                  $teststep->number=$x;
                  $teststep->testcase_id=$testcase_id;
                  $teststep->action='Verify rule';
                  $teststep->result='BR-'.str_pad($rule->rule->number, 4, "0", STR_PAD_LEFT).' '.$rule->rule->title;
                  $teststep->save();
                   }
             }
             
             
                 $ifaces=Stepiface::model()->findAll('step_id='.$altflowstep['id']);
             if (count($ifaces)){
                   foreach($ifaces as $iface){ 
                       $x++;  
                       $teststep=new Teststep;
                  
                  $teststep->number=$x;
                  $teststep->testcase_id=$testcase_id;
                  $teststep->action='Verify interface';
                  $teststep->result='UI-'.str_pad($iface->iface->number, 4, "0", STR_PAD_LEFT).' '.$iface->iface->name;
                  $teststep->save();
                   }
             }
             
             
           
             
             
                  
                  
                         }                
            
                 $mainflowsteps=Step::model()->findAll('id >='.$endflow.' AND flow_id='.$mainflow[0]['id']);
   // THEN START GOING THROUGH THE MAIN FLOW STEPS FROM THE FINISH OF THE ALT FLOW TO THE END.
 
        
        foreach($mainflowsteps as $mainflowstep){  
                  $x=$x+1;
                  $teststep=new Teststep;
                  $teststep->testcase_id=$testcase_id;
                  $teststep->number=$x;
                  $teststep->action=$mainflowstep['text'];
                  $teststep->result=$mainflowstep['result'];
                  $teststep->save();
                         }    
                    } ELSE {
                // The case hasn't saved  
                   $this->redirect(array('/site/fail'));
                   //echo 'ALT Test Case not saved';
                    }
                }
                }
                  
      // Set other TC's for the UC to inactive.
	$this->redirect(array('/usecase/view/','id'=>$id));
		

 
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
         $proj_id=$model->project_id;
                $model->delete();
                if ($ucid !=-1) $this->redirect(array('/usecase/view/id/'.$ucid));
                $this->redirect(array('/project/view/id/'.$proj_id));
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
