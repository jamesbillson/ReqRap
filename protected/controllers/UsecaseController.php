<?php

class UsecaseController extends Controller
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
				'actions'=>array('editablechange','index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('rollback','diff','packchange','dynamicsteps','create','update','delete','move','history'),
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
            Yii::app()->session['setting_tab']='usecases';
		$versions=Version::model()->getVersions($id,10);
                $model=$this->loadModel($versions[0]['id']);
                $package=Package::model()->findbyPK(Version::model()->getVersion($model->package_id,5));
       
               // $model = Usecase::model()->with('package')->findByPk($versions[0]['id']);
               // $foo = $bar->foo;
                
                $this->render('view',array('model'=>$model,
			'versions'=>$versions,'package'=>$package
        	));
	}
       public function actionHistory($id) // Note that this is form_id
	{
           Yii::app()->session['setting_tab']='usecases';
             	$versions=Version::model()->getVersions($id,10,'usecase_id');
                $model=$this->loadModel($versions[0]['id']);
                $this->render('history',array('model'=>$model,
			'versions'=>$versions
        	));
	} 
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id)
	{
            Yii::app()->session['setting_tab']='usecases';
		$model=new Usecase;
                $model->description=Usecase::$default_description;
                $project=Yii::app()->session['project'];
		
                $number=Usecase::model()->getNextNumber($id);
                $package=Package::model()->findbyPK($id);
               
		if(isset($_POST['Usecase']))
		{
			
                    $model->attributes=$_POST['Usecase'];
                    $model->package_id=$package->package_id;
                    $model->project_id= $project;
                    $model->release_id=Release::model()->currentRelease($project);
                    // set usecase_id
                    $model->usecase_id=Version::model()->getNextID(10);
			if($model->save()){
                        $version=Version::model()->getNextNumber($project,10,1,$model->primaryKey,$model->usecase_id);   
                        $flow=new Flow;
                        $flow->name='Main';
                        $flow->main=1;
                        $flow->startstep_id=0;
                        $flow->rejoinstep_id=0;
                        $flow->usecase_id=$model->usecase_id;
                        $flow->flow_id=Version::model()->getNextID(8);
                        $flow->project_id= $project;
                        $flow->release_id=Release::model()->currentRelease($project);
                        $flow->save(false);
                        $version=Version::model()->getNextNumber($project,8,1,$flow->primaryKey,$flow->flow_id);
                        //make version
                        $step=new Step;
                          $step->flow_id=$flow->flow_id;
                          $step->number=  Step::model()->getNextNumber($id);
                          $step->text='Actor action.';
                          $step->actor_id=$model->actor_id;
                          $step->result='System result.';
                          $step->step_id=Version::model()->getNextID(9);
                          $step->project_id= Yii::app()->session['project'];
                        $step->release_id=Release::model()->currentRelease($project);
                          $step->save(false);
                          // make version
                          $version=Version::model()->getNextNumber($project,9,1,$step->primaryKey,$step->step_id);
			$this->redirect(array('/project/view/tab/usecases/'));
                }}

		$this->render('create',array(
			'model'=>$model,'package'=>$package,'number'=>$number
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		                
                Yii::app()->session['setting_tab']='usecases';
            $release=Yii::App()->session['release'];
            $project=Yii::App()->session['project'];
                $model=$this->loadModel($id);
                //$package=Package::model()->findbyPK($model->package->id);
                $number=$model->number;
               
                $description=$model->description;
                $new= new Usecase;
			
                if(isset($_POST['Usecase']))
		{
                 $new->attributes=$_POST['Usecase'];
                 $description=$new->description;  
		 $new->number=$model->number;
                 $new->package_id=$model->package_id;
                 $new->usecase_id=$model->usecase_id;
                 $new->project_id=$project;
                 $new->release_id=$release;	
                 if($new->save()){
                      $version=Version::model()->getNextNumber($project,10,2,$new->primaryKey,$new->usecase_id);   
                      $this->redirect(array('/usecase/view/id/'.$new->usecase_id));
                 }
				
		}
                
		$this->render('update',array(
			'model'=>$model,'id'=>$id,'number'=>$number,'description'=>$description
                            
		));
	}

        public function actionEditableChange()
	{
           // THIS IS NOT USED...
            $release=Yii::App()->session['release'];
                $project=Yii::App()->session['project'];
                $model=$this->loadModel($_POST['pk']);
                $new= new Usecase;
			
                if($_POST['scenario']=='update')
		{
                 $new->usecase_id=$model->usecase_id;
                 $new->project_id=$project;
                 $new->release_id=$release;
                 $new->package_id=$_POST['value'];
                 $new->description=$model->description;  
		 $new->number=$model->number;
                 $new->actor_id=$model->actor_id;
                 $new->name=$model->name;
                 $new->preconditions=$model->preconditions;
                 
                 
                 //$new->$_POST['name']=$_POST['value'];
                 
                 $new->save(false);
                 Version::model()->getNextNumber($project,10,2,$new->primaryKey,$new->usecase_id);   
                }
            
             
                echo 'ok';
                header('HTTP/1.1 200 OK');
		die;
	}
        
         public function actionPackChange($id)
	{
           Yii::app()->session['setting_tab']='usecases';
            $release=Yii::App()->session['release'];
                $project=Yii::App()->session['project'];
                $model=$this->loadModel($id);
                $new= new Usecase;
			
                  if(isset($_POST['Usecase']))
		{
                   if($_POST['Usecase']['package_id'] != $model->package_id){
                 $new->usecase_id=$model->usecase_id;
                 $new->project_id=$project;
                 $new->release_id=$release;
                 $new->package_id=$_POST['Usecase']['package_id'];
                 $new->description=$model->description;  
		 $new->number=$model->number;
                 $new->actor_id=$model->actor_id;
                 $new->name=$model->name;
                 $new->preconditions=$model->preconditions;
                 
                 
                if($new->save()){
                      $version=Version::model()->getNextNumber($project,10,2,$new->primaryKey,$new->usecase_id);   
                      $this->redirect(array('/usecase/view/id/'.$new->usecase_id));
                 }
                }}
             $this->render('packchange',array(
			'model'=>$model,'id'=>$id         
         ));
	}
        
        
        public function actionMove($dir, $id)
	{
		Yii::app()->session['setting_tab']='usecases';
            // UP
            // load this one, and the next one.
            // 
           // $model=$this->loadModel($id);
            $model = Usecase::model()->findByPk($id);
            $oldnum=$model->number;
            //echo 'moving old number'.$oldnum.'<br />';
            $ucs=Usecase::model()->getPackageUsecases($model->package_id);
            //echo 'getting them for '.$model->package_id.'<br />';
            //echo 'number of results: '.count($ucs);
            //echo '<pre>';
            //print_r($ucs);
            //echo '</pre>'.'<br />';
          
            $nextid=0;
            
            if($dir==1){
                    for ($i = 0; $i <= count($ucs)-1; $i++) 
                    {
                  //     echo 'going up'.$i.'<br />';
                    if ($ucs[$i]['number']==$oldnum) $nextid=$ucs[$i+1]['id'];
                    }
                } 
          // echo '$nextid down ='.$nextid.'<br />';
            if($dir==2){
                    for ($i = count($ucs)-1; $i > 0; $i--) 
                    {
                 //      echo 'going down'.$i.'<br />';
                    if ($ucs[$i]['number']==$oldnum) $nextid=$ucs[$i-1]['id'];
                    }
                } 
                
               //    echo '$nextid up ='.$nextid.'<br />';     
                
      $model2 = $this->loadmodel($nextid);
            
            $model->number = $model2->number;
            $model2->number=$oldnum;
            
          //  echo 'moved to  number'.$model->number.'<br />';
          //  echo 'moved from number'.$model2->number.'<br />';
           $model->save(false);
          $model2->save(false);
           
            
            
            // 
            // get the next one, and make it have this one's number
            // get this one and make it have the old number.
            // save them both
            
          
		$this->redirect(array('/project/view/'));
	
	}
        
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
	Yii::app()->session['setting_tab']='usecases';
        $project=Yii::app()->session['project'];
        $model = $this->loadModel($id);
        $version=Version::model()->getNextNumber($project,10,3,$model->id,$model->usecase_id);  
	Usecase::model()->Renumber();
      	$this->redirect(array('/project/view/'));
	}

        public function actionRollback($uc,$id)
	{
	
        $release=Yii::app()->session['release'];
        $steps=array();
        $flows=array();
        $steprules=array();
        $stepifaces=array();
        $stepforms=array();
        $usecases=array();
        $history=Usecase::model()->getHistory($uc);
        krsort($history);
        
      //  echo '<pre>';
      //  print_r($history);
       // echo '</pre>';
        
      
        foreach ($history as $version=>$line){
            
             Version::model()->rollbackInactivate($line['object_id'], $line['object']);
            
         //  echo 'now testing this id '.$id.' is greater than Version: '.$version.' object is '.$line['object'].' <br><br>'; 
       // echo '<br>Flows: ';
       // print_r($flows);
        //echo '<br>';
       // echo '<br>Steps: ';
       // print_r($steps);
       // echo '<br>';
       // echo '<br>Use Cases: ';
       // print_r($usecases);
       // echo '<br><br>';
        //  if ($version<=$id && $line['object']=='Flow' ){
        //echo 'matching <br>';
            
            
            if ($version<=$id && $line['object']==8 && !isset($flows[$line['object_id']])){
                   $flows[$line['object_id']]=$version;
             }
         
            if ($version<=$id && $line['object']==9 && !isset($steps[$line['object_id']])){
                  $steps[$line['object_id']]=$version;        
            }
           
            if ($version<=$id && $line['object']==10 && !isset($usecases[$line['object_id']])){
                $usecases[$line['object_id']]=$version;
            }
            
             if ($version<=$id && $line['object']==14 && !isset($flows[$line['object_id']])){
                   $stepforms[$line['object_id']]=$version;
             }
             
              if ($version<=$id && $line['object']==15 && !isset($flows[$line['object_id']])){
                   $stepifaces[$line['object_id']]=$version;
             }
             
              if ($version<=$id && $line['object']==16 && !isset($flows[$line['object_id']])){
                   $steprules[$line['object_id']]=$version;
             }
             
        }
      /* 
        echo '<pre>';
        print_r($steps);
        echo'</pre>';

        echo '<pre>';
        print_r($flows);
        echo'</pre>';
        
        echo '<pre>';
        print_r($usecases);
        echo'</pre>';
        
        */     
         
        foreach ($steps as $instance=>$versionid){
           //  echo  'Version::model()->rollback('.$instance.', 9, '.$versionid.' )<br> '; 
            Version::model()->rollback($instance, 9, $versionid); 
        }
        
        foreach ($flows as $instance=>$versionid){
          //   echo  'Version::model()->rollback('.$instance.', 8, '.$versionid.' )<br> '; 
            Version::model()->rollback($instance, 8, $versionid); 
        }
        
        foreach ($usecases as $instance=>$versionid){
          //   echo  'Version::model()->rollback('.$instance.', 10, '.$versionid.' )<br> '; 
            Version::model()->rollback($instance, 10, $versionid); 
        }
        
         foreach ($stepforms as $instance=>$versionid){
          //   echo  'Version::model()->rollback('.$instance.', 10, '.$versionid.' )<br> '; 
            Version::model()->rollback($instance, 14, $versionid); 
        }
        
         foreach ($stepifaces as $instance=>$versionid){
          //   echo  'Version::model()->rollback('.$instance.', 10, '.$versionid.' )<br> '; 
            Version::model()->rollback($instance, 15, $versionid); 
        }
        
         foreach ($steprules as $instance=>$versionid){
          //   echo  'Version::model()->rollback('.$instance.', 10, '.$versionid.' )<br> '; 
            Version::model()->rollback($instance, 16, $versionid); 
        }
        
        
        
        
        
        
        
        
     	$this->redirect(array('/usecase/history/id/'.$uc));
        }
        
        
        public function actionDynamicSteps()
	{
	$id=$_POST['usecase_id'];
        $project=Yii::app()->session['project'];
        $steps=Usecase::model()->getAllSteps($id);
        foreach($steps as $step)
        {
         //echo CHtml::tag('option',
         //            array('value'=>$step['step_id']),
         //        CHtml::encode($step['flow'].' Flow - '.$step['number'].' '.$step['text'].),true);
        echo '<option value='.$step['step_id'].'>';
         echo $step['flow'].' Flow - '.$step['number'].' '.$step['text'];
        echo '</option>';
        }   
        
        
        }
        
        
                 public function actionDiff($old, $new)
        {
            
        $dataold = Usecase::model()->getReleaseUCs($old);
        $datanew = Usecase::model()->getReleaseUCs($new);
        $deletedUC = array();
        $addedUC=array();
  //find deleted UC's
          if (count($dataold))
            {
                foreach($dataold as $itemold){
                    
                   $matchingNew=-1;
                    for($i=0;$i<count($datanew);$i++)
                    {
                    if($datanew[$i]['usecase_id']==$itemold['usecase_id']) $matchingNew=$datanew[$i]['usecase_id'];
                        
                    }
                    if ($matchingNew == -1) array_push($deletedUC,$itemold['usecase_id']);
                }
            }
            

            
     // find added UC's     
           if (count($datanew))
            {
                foreach($datanew as $itemnew){
                    
                    $matchingOld=-1;
                    for($i=0;$i<count($dataold);$i++){
                    if($dataold[$i]['usecase_id']==$itemnew['usecase_id']) $matchingOld=$itemnew['usecase_id'];
                    }
                    if ($matchingOld == -1) array_push($addedUC,$itemnew['usecase_id']);
      
                }
            }
            echo'Deleted Use Case ID<br>';
            foreach ($deletedUC as $UC) echo 'UC ID: '.$UC.'<br>';

       
            echo'Added Use Case ID<br>';
            foreach ($addedUC as $UC) echo 'UC ID: '.$UC.'<br>';  
            
             // find changed UC's    
            
            
            // find changed stepiface, steprule, stepform 
            
     if (count($datanew))
            {
                foreach($datanew as $itemnew){
                    echo '<br>checking UCs for deleted rules UC #'.$itemnew['usecase_id'] ;
           $params['new']=$new;
           $params['old']=$old;
           $params['id']=$itemnew['usecase_id'];
           $params['object']=1;
           $rules=Usecase::model()->linkedObjectComparison($params);
           print_r($rules);
           echo '<br />';
           
                       echo '<br>checking UCs for deleted forms UC #'.$itemnew['usecase_id'] ;
           $params['new']=$new;
           $params['old']=$old;
           $params['id']=$itemnew['usecase_id'];
           $params['object']=2;
           $forms=Usecase::model()->linkedObjectComparison($params);
             print_r($forms);
           echo '<br />';
           
                }
            }            
            // find UC's with added/changed steps.
        echo '<br>Deleted Rules '.count($rules);
        echo '<br>Deleted Forms '.count ($forms);
            

            
            
            
            
        }
        

          
        
        
                public function actionDiffBackup($old, $new)
        {
            
        $dataold = Usecase::model()->getReleaseUCs($old);
        $datanew = Usecase::model()->getReleaseUCs($new);
          echo 'old ucs: '.count($dataold).'<br> new UCs: '.count($datanew).'<br>';
                     
            if (count($dataold))
            {
         
                foreach($dataold as $itemold){
                    //find the matching entry in $datanew (if there is one)
                      echo '<br><br>Testing UC '.$itemold['usecase_id'].'<br>  ('.$itemold['create_date'].')';
                              
                $matchingNew=-1;
                    for($i=0;$i<count($datanew);$i++){
                    if($datanew[$i]['usecase_id']==$itemold['usecase_id']) $matchingNew=$i;
                        
                    }
                    if($matchingNew!=-1) // there is a matching new UC.
                    {
                       $itemnew=$datanew[$matchingNew];
                       echo '<br> there is a matching new UC dated ('.$itemnew['create_date'].')';
                       
                       // load the flows and see if they have changed.
                      $flowsold= Flow::model()->getUCReleaseFlow($itemold['usecase_id'],$old);
                      $flowsnew= Flow::model()->getUCReleaseFlow($itemold['usecase_id'],$new);
                       if(count($flowsold)!=count($flowsnew))
                            { 
                            echo '<br>number of Flows changed by '.(count($flowsnew)-count($flowsold));
                            } ELSE {
                            echo '<br>same number of flows';    
                            }
                        // load the steps per flow and see if they have changed.
                           
                            foreach($flowsold as $flowold){
                                    echo '<br>Testing Flow '.$flowold['name'].'<br>';

                   // Load the version history for this flow_id
                                  
                            $stepsold= Usecase::model()->getAllReleaseSteps($flowold['id'],$old);
                            $stepsnew= Usecase::model()->getAllReleaseSteps($flownew['id'],$new);
                           
                            if(count($stepsold)!=count($stepsnew))
                            { 
                            echo '<br>number of steps changed by '.(count($stepsnew)-count($stepsold));
                            }
                        
                        foreach ($stepsold as $stepold){
                            // go through steps and find if there are any rules, forms or interfaces.
                                     $ifacesold = Step::model()->getStepLinks($stepold['id'], 12, 15);
                                   
                                     
                                     $rulesold = Step::model()->getStepLinks($stepold['id'], 1, 16);
                                     
                                     
                                     $formsold = Step::model()->getStepLinks($stepold['id'], 2, 14);
                               
                                     
                                    }    
                            
                            
                            
                       
         
                        }
                        
                        
                    } // End there is a matching new USeCase  
                    if($matchingNew==-1) // this UC has been added since.
                    {
                    echo  '<br> This is a deleted UC '.$itemold['name'];
                    }
                    
            }
               
        }
       
  
         
        }
        
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Usecase');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Usecase('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usecase']))
			$model->attributes=$_GET['Usecase'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Usecase the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Usecase::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Usecase $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='usecase-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
