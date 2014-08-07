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
				'actions'=>array('deleted','rollback','diff','packchange','dynamicsteps','create','update','delete','move','history'),
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

        
        
        public function actionDeleted() // Note that this is form_id
	{
            
            $this->render('deleted');
	} 
        
        
        
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
        
    
      
        foreach ($history as $version=>$line){
            // Set all the versions to inactive for these objects
             Version::model()->rollbackInactivate($line['object_id'], $line['object']);
            
      
            
            // Reset each version to point to the most recent version in the array.
             // do this by comparing if its older than the rollback point ($id) and if
             // its already been set.  This way it only sets once, at the closest point to the $id
             
            if ($line['action']!=3 && $version<=$id && $line['object']==8 && !isset($flows[$line['object_id']])){
                   $flows[$line['object_id']]=$version;
             }
         
            if ($line['action']!=3 && $version<=$id && $line['object']==9 && !isset($steps[$line['object_id']])){
                  $steps[$line['object_id']]=$version;        
            }
           
            if ($line['action']!=3 && $version<=$id && $line['object']==10 && !isset($usecases[$line['object_id']])){
                $usecases[$line['object_id']]=$version;
            }
            
             if ($line['action']!=3 && $version<=$id && $line['object']==14 && !isset($flows[$line['object_id']])){
                   $stepforms[$line['object_id']]=$version;
             }
             
              if ($line['action']!=3 && $version<=$id && $line['object']==15 && !isset($flows[$line['object_id']])){
                   $stepifaces[$line['object_id']]=$version;
             }
             
              if ($line['action']!=3 && $version<=$id && $line['object']==16 && !isset($flows[$line['object_id']])){
                   $steprules[$line['object_id']]=$version;
             }
             
        }
    
         
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
          
        
       
                     
          $thisrelease=Release::model()->findbyPK($new);
          
          $oldrelease=Release::model()->findbyPK($old);
          $lastchangenew=Release::model()->LastChange($new);
           //Check both releases belong to one project.
                  
          //Check Ownership of new release.
          
          $permissiontoview=0;
          if ($thisrelease->project_id == $oldrelease->project_id) 
              { 
          
          $mycompany=User::model()->myCompany();
          if ($thisrelease->project->company_id==$mycompany)$permissiontoview=1;
          $follower=Follower::model()->getProjectFollowerDetails($thisrelease->project->id);
          if(!empty($follower)) $permissiontoview=1;
              }
          if ($permissiontoview==0)$this->redirect(array('site/fail/condition/permission_fail'));
         
          
          
            // if its the current release it doesn't have an offset, so use the last change instead
          if ($thisrelease->status==1) $lastchangenew=Version::model()->getLastChange($thisrelease->id);
           
          $lastchangeold=Release::model()->LastChange($old); 
          $history=array();
         /* 
          echo '<h3>params</h3> old release: '.$old.' <br>new release: '.$new.' <br> '
                 . 'last change in old release: '.$lastchangeold.'<br>'
                 . 'last change in new release: '.$lastchangenew.'<br>';
          
          */
         $changes=Version::model()->findAll('number >'.$lastchangeold.
                 ' and number <='.$lastchangenew.' and project_id='.$thisrelease->project_id);
          
          $changes=Version::model()->findAll(array('order'=>'id DESC', 
              'condition'=>'number >:x AND number <=:y AND project_id =:z', 
              'params'=>array(':x'=>$lastchangeold,
                            ':y'=>$lastchangenew,
                            ':z'=>$thisrelease->project_id)));
          
               foreach($changes as $change)
                {
                    if (!isset($history[$change->object][$change->foreign_id]))
                    {
                    $history[$change->object][$change->foreign_id]['create']=0;
                        // THere is no entry for this object, so make one
                    $history[$change->object][$change->foreign_id]['content']=$change->id;
                    // if this is a create step, set the create flag
                    if($change->action==1)$history[$change->object][$change->foreign_id]['create']=1;
                    
                    }
                    // if its was alread set as a change, and now there's a create, update the 'change' to create.
                    if (isset ($history[$change->object][$change->foreign_id]) 
                            && $change->action==1)
                    {
                       
                    $history[$change->object][$change->foreign_id]['create']=1;
                    }
                    
                }  
            $linkparent=array(1=>16,2=>14, 12=>15);
            $parentlink=array(16=>1,14=>2, 15=>12);
            $ruleformiface=array(
                1=>array('name'=>'Title', 'text'=>'Rule'),
                2=>array('name'=>'Title', 'text'=>'Description'),
                12=>array('name'=>'Title', 'text'=>'Description'),
                );
            $changelog=array(); 
            $usecasechange=array();
            if (count($history))
            {            
                for($i=1;$i<=18;$i++)
                {
                  //  echo '------testing object type: '.$i.'<br>';
                    if (isset($history[$i])){
                        foreach($history[$i] as $object)
                        {
                  //    echo '-----------Found one object type '.$i.' which is '.$object['content'].'<br>';
                        
                        $version=Version::model()->findbyPK($object['content']);
                        if ($object['create']==1) $version->action=1;
                        //echo 'change '.$version->number.''
                        //        . ' '.Version::$action_labels[$version->action].''
                        //        . ' '.Version::$objects[$version->object].'<br />';
                        $changelog[$object['content']]['number']=$version->number;
                        $changelog[$object['content']]['action']=$version->action;
                        $changelog[$object['content']]['object']=$version->object;
                        $changelog[$object['content']]['object_id']=$version->foreign_id;
                      // Rules, Forms and Interfaces 
                        if($version->object==1 || $version->object==2 || $version->object==12){ 
                        $parentuc=Version::model()->getObjectStepObjectParentUC($version->foreign_key,$linkparent[$version->object], $thisrelease->project_id,$version->object);
                        $diffobject=Version::model()->getDiffObject($version->object, $version->foreign_id, $new);
                        $changelog[$object['content']]['usecase_id']=$parentuc['usecase_id'];
                        $usecasechange[$parentuc['usecase_id']]=(isset($usecasechange[$parentuc['usecase_id']]))?$usecasechange[$parentuc['usecase_id']]+1 : 1;
                        $changelog[$object['content']]['name']=$ruleformiface[$version->object]['name'].': '.$diffobject['name'];
                        $changelog[$object['content']]['text']=$ruleformiface[$version->object]['text'].': '.$diffobject['text'];
                        $changelog[$object['content']]['link']= $new.'_'.$version->object.'_'.$diffobject[Version::$objects[$version->object].'_id'];
                        //echo 'Usecase is '. $parentuc['usecase_id'].'<br />';
                        //print_r($diffobject);
                        
                        } 
                        
                      //3 - form property
                      //4 - Actor
                      //6 - object
                      //7 - object property
                      
                        
                        if (in_array($version->object,array(3,4,5,6,7))){
                        $changelog[$object['content']]['usecase_id']=-1;
                        $changelog[$object['content']]['name']='none';
                        $changelog[$object['content']]['description']='none';
                        $diffobject=Version::model()->getDiffObject($version->object, $version->foreign_id, $new);
                        $changelog[$object['content']]['link']= $new.'_'.$version->object.'_'.$diffobject[Version::$objects[$version->object].'_id'];
                      
                        }
                        
                         if ($version->object==13){
                        $changelog[$object['content']]['usecase_id']=-1;
                        $changelog[$object['content']]['name']='none';
                        $changelog[$object['content']]['description']='none';
                        $changelog[$object['content']]['link']= '';
                      
                        }
                        
                           if($version->object==11){ //This is a photo - find the UC
                        $diffobject=Version::model()->getDiffObject($version->object, $version->foreign_id, $new);
                        // find the iface that uses this photo
                        $iface=Iface::model()->find('photo_id='.$version->foreign_id.' AND release_id='.$new);
                        if(!empty($iface)) {
                        $parentuc=Version::model()->getObjectStepObjectParentUC($iface->iface_id,$linkparent[12], $thisrelease->project_id,12);
                        $changelog[$object['content']]['usecase_id']=$parentuc['usecase_id'];
                        $usecasechange[$parentuc['usecase_id']]=(isset($usecasechange[$parentuc['usecase_id']]))?$usecasechange[$parentuc['usecase_id']]+1 : 1;
                        $changelog[$object['content']]['name']=$ruleformiface[12]['name'].': '.$iface['name'];
                        $changelog[$object['content']]['text']=$ruleformiface[12]['text'].': '.$iface['text'];
                        $changelog[$object['content']]['link']= $new.'_12_'.$diffobject[Version::$objects[$version->object].'_id'];
                        //echo 'Usecase is '. $parentuc['usecase_id'].'<br />';
                        //print_r($diffobject);
                        } ELSE {
                        $changelog[$object['content']]['usecase_id']=-1;
                        $changelog[$object['content']]['name']='none';
                        $changelog[$object['content']]['description']='none';
                        $changelog[$object['content']]['link']= '';
                        
                        }
                        } 
                                
                        // FLOWS
                           if($version->object==8){ //This is a flow - find the UC
                        $parentuc=Flow::model()->getDiffFlowParentUsecase($version->foreign_id, $new);
                        $changelog[$object['content']]['usecase_id']=$parentuc['usecase_id'];
                        $changelog[$object['content']]['name']=$parentuc['name'];
          
                        $changelog[$object['content']]['text']='';
                        $usecasechange[$parentuc['usecase_id']]=(isset($usecasechange[$parentuc['usecase_id']]))? $usecasechange[$parentuc['usecase_id']]+1 :1;
                        $changelog[$object['content']]['link']= $new.'_9_'.$parentuc['usecase_id'];
                    
                        //echo 'Usecase is '. $parentuc['usecase_id'].'<br />';
                        }
                        
                        //STEPS
                        if($version->object==9){ //This is a step - find the UC
                        $parentflow=Step::model()->getStepParentFlowByStepID($version->foreign_id);
                        $parentuc=Flow::model()->getFlowParentUsecase($parentflow['id']);
                        $changelog[$object['content']]['usecase_id']=$parentuc['usecase_id'];
                      
                         $changelog[$object['content']]['name']='Action: '.$parentflow['text'];
                         $changelog[$object['content']]['text']='Result: '.$parentflow['result'];
                        $usecasechange[$parentuc['usecase_id']]=(isset($usecasechange[$parentuc['usecase_id']]))?$usecasechange[$parentuc['usecase_id']]+1 : 1;
                        $changelog[$object['content']]['link']= $new.'_9_'.$parentuc['usecase_id'];
                        //echo 'Usecase is '. $parentuc['usecase_id'].'<br />';
                        }
                        // USECASES
                       if($version->object==10){ //This is a use case
                       $changelog[$object['content']]['usecase_id']=$version->foreign_id;
                       $uc=Usecase::model()->findbyPK($version->foreign_key);
                       $usecasechange[$parentuc['usecase_id']]=(isset($usecasechange[$version->foreign_id]))?$usecasechange[$version->foreign_id]+1 : 1;  
                       $changelog[$object['content']]['name']=$uc->name;
                       $changelog[$object['content']]['text']=$uc->description;
                     $changelog[$object['content']]['link']= $new.'_9_'.$uc['usecase_id'];
                        //echo 'Usecase is '.$version->foreign_id.'<br />';
                        }
                        // Relationship to Rules, Forms and Interfaces.
                        if($version->object==14 || $version->object==15 || $version->object==16){ //This is a stepform - find the UC
                        $parentuc=Version::model()->getStepObjectParentUC($version->foreign_key,$new,$version->object);
                        $parentobject=Version::model()->getStepObject($version->object,$version->foreign_key,$new);
                        $changelog[$object['content']]['usecase_id']=$parentuc['usecase_id'];
                        $usecasechange[$parentuc['usecase_id']]=(isset($usecasechange[$parentuc['usecase_id']]))?$usecasechange[$parentuc['usecase_id']]+1 : 1;
                        $changelog[$object['content']]['name']=$parentobject['name'];
                        $changelog[$object['content']]['text']=$parentobject['text'];
                       $changelog[$object['content']]['link']= $new.'_9_'.$parentuc['usecase_id'];
                   

                        ///echo 'Usecase is '. $parentuc['usecase_id'].'<br />';
                       // echo '<br>############ PARENT ##########';
                        //print_r($parentobject);
                        }
                        
                       
                        
                        }
                    }
                }        
            }   
            ksort($usecasechange); 
            
        

        
       
        
       
        $this->render('/project/diff',array(
			'changelog'=>$changelog,
                        'usecasechange'=>$usecasechange,
                        'old'=>$old,
                        'new'=>$new,
		));  
            
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
