<?php

class ProjectController extends Controller
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
                'actions'=>array('index','view','extview', 'addmeta'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('prototype','protoifaceadd','ProtoFlowIfaceAdd',
                    'protoflowsave','protoFlowView','protoflow','protoActor','ProtoPackage',
                   'ProtoFlowStore','ProtoFlowLoad','ProtoFlowClear',
                    'ProtoDescriptionSet','ProtoNameSet','ProtoActorSet','walkthru','testing','addprojectaddress','set','photo','print',
                    'diary','resetlink','details',
                    'myrequirements','project','delete','create','update','myprojects','projectpackagelist','TenderSummary','RearrangeProtoSteps','RemoveProtoSteps'),
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


    
     public function actionSet($id)
    {
    //echo 'starting set to id='.$id;
    Yii::app()->session['project']=$id;
    
    $myproject=array();
    $myfollows=array();
    $mycompany=User::model()->myCompany();
    $projectlist=Company::model()->getProjects($mycompany);
    //echo '<br />loaded project list';
    foreach($projectlist as $proj){
    array_push($myproject,$proj['id']);
    }
   // echo '<br />loaded follow list';   
    $followlist = Follower::model()->getMyProjectFollows(1);
    foreach($followlist as $follow){
     //   echo '<br />add a follow project'.$follow['id'];
    $myfollows=$myfollows+array($follow['id']=>$follow['role']);
    }
    //echo 'follows:<pre>';
    //print_r($follow);
    //echo '</pre>';

    //echo 'myproject:<pre>';
    //print_r($myproject);
    //echo '</pre>';

// If I am a follower then set the release to the last release.
    if(isset($myfollows[$id]) && $myfollows[$id]>1) {
    //echo '<br />I am  a follower';    
        Yii::app()->session['release']=  Release::model()->lastRelease();
    }
// if I own the project set the viewing release to current release
    if(in_array($id, $myproject) || (isset($myfollows[$id]) && $myfollows[$id]==1)) {
    //echo '<br />my project ';    
        Yii::app()->session['release']=  Release::model()->currentRelease();
    }
    Yii::app()->session['setting_tab']='details';
    //echo '<br />redirecting...';
    
    //$companyMeta = User::model()->myCompany();
    //$companyMeta->setEavAttribute('last_project',$id);
    //$companyMeta->save();
    
    $this->redirect(('/req/project/project/'));
        
    }
    
    public function actionView()
    {
      
         $tab=Yii::App()->session['setting_tab'];
     if (!in_array($tab,array(
         'sections',
         'objects',
         'actors',
         'usecases',
         'rules',
         'forms',
         'interfaces',
         'structure',
        ))){
         Yii::App()->session['setting_tab']='usecases';
     }
     $id=Yii::app()->session['project'];
     $model = $this->loadModel($id);
     $arr=Actor::model()->getProjectActors();
     $this->generateTree($str, $arr, -1);
              
     $this->render('view',array(
                'model'=>$model,'actorstring'=>$str ));

    }
    
    public function generateTree(&$str ,$array, $parent = 0, $level = 0)
    {
          
        foreach($array as $key => $value)
        {
            if (!isset($str)) $str='';
        if ($value['inherits'] == $parent) 
            {    
            $str .= '[';
            $level++;           
            $str .= $value['name'].'' ;
            $str .= $this->generateTree($str ,$array, $value['actor_id'], $level);
            $str .= ']';
            }
        }   
          
      }
    
     public function actionTesting()
    {
     $tab=Yii::App()->session['setting_tab'];
     if (!in_array($tab,array('testcases',
         'testruns'))){
         Yii::App()->session['setting_tab']='testruns';
     }
     $id=Yii::app()->session['project'];
        $model = $this->loadModel($id);
        $this->render('testing',array(
                'model'=>$model ));

    }

         public function actionWalkthru()
    {
        Yii::App()->session['setting_tab'];
     $id=Yii::app()->session['project'];
        $model = $this->loadModel($id);
        $this->render('_walkthru',array(
                'model'=>$model));

    }
    
       public function actionProject()
    {
     $tab=Yii::App()->session['setting_tab'];
     if (!in_array($tab,array('details','documents','settings','followers','todo','notes'))){
         Yii::App()->session['setting_tab']='details';
     }
     $model = $this->loadModel(Yii::app()->session['project']);
     $this->render('project',array('model'=>$model));
     
    }
    
   public function actionExtView($id)
    {
        $model = Project::model()->find('extlink = \''.$id.'\'');
      
        if(!($model === null))
            {
                $this->render('print',array(
                    'model'=>$model,'tab'=>'documents'
                ));
            } else {
                ReportHelper::processError('Project Controller, ExtView action', '/req/site/fail/condition/no_access');  
                //$this->redirect(('/req/site/fail/condition/no_access'));
            }
    }
    public function actionPrint() {
        
      //  $metaModel = Company::model()->findByPk(User::model()->myCompany());
        $id = Yii::App()->session['project'];
        $project = Project::model()->findByPk($id);
        $metaData  = $project->getEavAttributes(array('html_output', 'output_font'));

        $fontDefault = 'dejavusans';

        if ( isset($metaData['output_font']) && $metaData['output_font'] ) {
            $fontDefault = $metaData['output_font'];
        }
        if ( isset($metaData['html_output']) &&  $metaData['html_output']== 1) {
            echo $this->renderPartial('print', array(), true);
        } else {
            $filename = $project->name.'.pdf';
            $mPDF1 = Yii::app()->ePdf->mpdf('','A4',16, $fontDefault);
            $mPDF1->SetHeader('First section header');
            $mPDF1->SetFooter('First section footer');
      //      $mPDF1->WriteHTML(file_get_contents(Yii::getPathOfAlias('webroot').Yii::app()->theme->baseUrl.'/css/print.css'), 1);
            $mPDF1->WriteHTML($this->renderPartial('print', array(), true), 0);
            $mPDF1->Output( $filename, EYiiPdf::OUTPUT_TO_DOWNLOAD);
        }
    }
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Project;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Project']))
        {
            $model->attributes=$_POST['Project'];
            $model->company_id = User::model()->myCompany();
            $model->extlink = md5(uniqid(rand(), true));
            $model->stage=1;
            if($model->save())
            $project=$model->getPrimaryKey();
            Yii::app()->session['project'] = $project;
            Release::model ()->createInitial($project); 
            $release=Release::model()->currentRelease();
           Yii::App()->session['release']=$release;
           
          
            
            $initial=array(1=>'Not Classified',2=>'Web interface',3=>'Email');
            for ($case = 1; $case <= 3; $case++) 
            {       
               $type=new Interfacetype;
               $type->name=$initial[$case];
               $type->number=$case;
               $type->interfacetype_id=Version::model()->getNextID(13);
               $type->project_id=$project;
               $type->release_id=$release;
               $type->save(false);
               $newid=$type->getPrimaryKey();
               $version=Version::model()->getNextNumber($project,13,1,$newid,$type->interfacetype_id);   
            }          
            
          //  Testrun::model ()->createInitial($release); 
            Actor::model()->createInitial($project);
            Package::model()->createInitial($project);
               // Version::model ()->createInitial($project); 
            Yii::App()->session['setting_tab']='usecases';
            $this->redirect(array('view'));
        }

        $this->render('create',array(
            'model'=>$model,
        ));
           
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate()
    {
        $id=Yii::App()->session['project'];
        $model=$this->loadModel($id);
        $mycompany=User::model()->myCompany();
        if($mycompany==$model->company_id) {
        
            Yii::App()->session['setting_tab']='settings';
            
            if(isset($_POST['Project']))
            {
                $model->attributes=$_POST['Project'];
                if($model->save())
                    $this->redirect(array('project'));
            }

            $this->render('update',array(
                'model'=>$model,
            ));
        } else {
            ReportHelper::processError('Project Controller, Update action', '/req/site/fail/condition/no_access');  
              // $this->redirect(('/req/site/fail/condition/no_access'));
        }
    }

    public function actionResetLink($id)
    {
       $model = $this->loadModel($id);
        if(User::model()->myCompany()== $model->company_id)
        {
            
        $model->extlink = md5(uniqid(rand(), true));
        $model->save();
        $this->render('details',array(
                'model'=>$model,
            ));
        } else {
            ReportHelper::processError('Project Controller, Reset Link action', '/req/site/fail/condition/no_access');  
            //$this->redirect(('/req/site/fail/condition/no_access'));
        }
    }
    
    
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
unset(Yii::app()->session['project']);
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(UrlHelper::getPrefixLink('/req/myrequirements'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Project');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    public function actionMyProjects()
    {
        $this->render('myprojects');
    }

    public function actionDetails($id)
    {
        $model = $this->loadModel($id);
        if(User::model()->myCompany()== $model->company_id)//check this project belongs to my company
        {
                   $this->render('details',compact('model'));
         } else {
            // You are not permitted to see this page
            ReportHelper::processError('Project Controller, Details action', '/req/site/fail/condition/no_access');  
            //$this->redirect(('/req/site/fail/condition/no_access'));
        }
    }
        public function actionAddProjectAddress($id)
    {
        $model = $this->loadModel($id);
        if(User::model()->myCompany()== $model->company_id)//check this project belongs to my company
        {
                    $addresses = new Addresses;
                     if(isset($_POST['Addresses'])){
                                $addresses->attributes=$_POST['Addresses'];
                                $addresses->foreign_key = $model->id;
                                if(!empty($addresses->name)){
                                    if($addresses->save())
                                        $this->render('details',compact('model'));                        
                                }
                     } 
                   $this->render('address',compact('model','addresses'));
         } else {
            // You are not permitted to see this page
            ReportHelper::processError('Project Controller, Add Project Address action', '/req/site/fail/condition/no_access');  
            //$this->redirect(('/req/site/fail/condition/no_access'));
        }
    }
    
    
     public function actionDiary($id)
    {
        $model = $this->loadModel($id);
        if(User::model()->myCompany()== $model->company_id)
        {
        $this->render('diary',array(
                'model'=>$model,
            ));
        } else {
            ReportHelper::processError('Project Controller, Add Diary action', '/req/site/fail/condition/no_access');  
            //$this->redirect(('/req/site/fail/condition/no_access'));
        }
    }
    public function actionMyTenders()
    {
        $this->render('mytenders');
    }
    
    public function actionPhoto($id)
    {
         $model = $this->loadModel($id);
         $this->render('photo',array(
                'model'=>$model,
            ));
    }
    
    public function actionMyRequirements()
    {
        $this->render('myrequirements');
    }
        

    
    public function actionAdmin()
    {
        $model=new Project('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Project']))
            $model->attributes=$_GET['Project'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

        public function actionPrototype()
    {
     
    
     $model = $this->loadModel(Yii::app()->session['project']);
     $ucDef=$this->ProtoFlowLoad();
     $this->render('prototype',array('model'=>$model,'ucDef'=>$ucDef));
     
    }
   
    
      public function actionProtoActor()
    {

     $ucDef=$this->ProtoFlowLoad();
     $model = $this->loadModel(Yii::app()->session['project']);
     $ucDef['actor_id']=$_POST['value'];
     $this->ProtoFlowStore($ucDef);
     $this->redirect('prototype',array('model'=>$model,'ucDef'=>$ucDef));
     
    }
    
        public function actionProtoPackage()
    {

     $ucDef=$this->ProtoFlowLoad();
     $model = $this->loadModel(Yii::app()->session['project']);
     $ucDef['package_id']=$_POST['value'];
     $this->ProtoFlowStore($ucDef);
     $this->redirect('prototype',array('model'=>$model,'ucDef'=>$ucDef));
     
    }
    
      public function actionProtoFlowClear()
    {
  
     $this->ProtoFlowErase();
     $ucDef=$this->ProtoFlowLoad();
     
     $model = $this->loadModel(Yii::app()->session['project']);
     
     $this->render('prototype',array('model'=>$model,'ucDef'=>$ucDef));
     
    }
    
       public function actionProtoFlowIfaceAdd($id,$type,$step_index=-1)
    {
     //
     // Load the ucDef back from the user parameter
    //       $this->ProtoFlowLoad($data);
        
         $ucDef= $this->ProtoFlowLoad();  
     //
     /*
     echo '<pre>';
     print_r($ucDef);
     echo '</pre>';
     */
     //
           //find the form or iface
         
     
     if($type==12){
      $model=Iface::model()->findByPk(Version::model()->getVersion($id,$type));
      $wikiLink="[[UI:".$model->iface_id."]]";
     }
           if($type==2){
      $model=Form::model()->findByPk(Version::model()->getVersion($id,$type));
     $wikiLink="[[UF:".$model->form_id."]]";
           }
     //define a new step with the chosen iface
     $step=array();
     $step['action']='Undefined action';
     $step['resultname']=$model->name;
     $step['resulttype']=$type;
     $step['object_id']=$id;
     $step['resulttext']='System displays '.$wikiLink;
     // $ucDef['flow'][$flowNum]['step'][$stepNum]['rule'][$ruleNum]['name']=$rule['name'];
	 if($step_index==-1)
	 {
     array_push($ucDef['flow'][1]['step'],$step);
	 }else
	 {
		array_splice($ucDef['flow'][1]['step'],$step_index,0,array($step)); 
	 }
     $model = $this->loadModel(Yii::app()->session['project']);
     
     // Save the ucDef
     
     $this->ProtoFlowStore($ucDef);
	  if(Yii::app()->request->isAjaxRequest)
		{
		 die;
		}
     
     $this->redirect(Yii::app()->getBaseUrl().'/project/prototype',array('model'=>$model,'ucDef'=>$ucDef));
     
    }
      public function ProtoFlowStore($ucDef)
    {
     $release=Yii::App()->session['release'];
     $ucDefJSON=  json_encode($ucDef);
     $companyMeta = Company::model()->findByPk(User::model()->myCompany());
     $companyMeta->setEavAttribute('temp_flow_'.$release, $ucDefJSON);
     $companyMeta->save();
  		
    }
    
      public function ProtoFlowLoad()
    {
        $release=Yii::App()->session['release'];
        $metaModel = Company::model()->findByPk(User::model()->myCompany());
        $metaData = $metaModel->getEavAttributes(array('temp_flow_'.$release));
        if (  !empty($metaData['temp_flow_'.$release]) ) {
            $ucDefjson = $metaData['temp_flow_'.$release];
            $ucDef=  json_decode($ucDefjson,true); 
        } ELSE {
            $this->ProtoFlowErase();
            
            $metaData = $metaModel->getEavAttributes(array('temp_flow_'.$release));
            $ucDefjson = $metaData['temp_flow_'.$release];
            $ucDef=  json_decode($ucDefjson,true); 
            }
        
         
     return $ucDef;
    }
    
        public function ProtoFlowErase()
    {
$release=Yii::App()->session['release'];
            $ucDef=array();
            $ucDef['name']='Undefined Flow';
            $ucDef['description']='Description';
            $ucDef['actor_id']=-1;
            $ucDef['package_id']=-1;
            $ucDef['id']=-1;
            $ucDef['flow']=array();
            $ucDef['flow'][1]['name']='Main';
            $ucDef['flow'][1]['step']=array();
        
        
            $companyMeta = Company::model()->findByPk(User::model()->myCompany());
            $companyMeta->setEavAttribute('temp_flow_'.$release, json_encode($ucDef));
            $companyMeta->save();
  	
   
    }
    
       public function actionProtoFlowView($id)
    {
     $tab=Yii::App()->session['setting_tab'];

     
     $usecase=Usecase::model()->findbyPK($id);
        $ucDef=array();
        $ucDef['name']=$usecase->name;
        $ucDef['id']=$usecase->usecase_id;
        $ucDef['actor_id']=$usecase->actor_id;
        $ucDef['package_id']=$usecase->package_id;
        $ucDef['description']=$usecase->description;
        $flowNum=0;
        $flows = Flow::model()->getUCFlow($usecase->id); // get flows
                foreach($flows as $aflow) { // LOOP THRU FLOWS
                $flowNum++;    
                $stepNum=0;  

                $steps= Step::model()->getFlowSteps($aflow['flow_id']); // get steps
                $name = ($aflow['main']==1)?'<strong>Scenario Text</strong> ':'<strong>Alternate Course '.
                        $aflow['name'].
                        '</strong><br />Start after main step '.$aflow['start'].
                        ' re-join at main step '.$aflow['rejoin'];
                        $ucDef['flow'][$flowNum]['name']=$name;
                                foreach($steps as $step){ 
                                $stepNum++;
                                //$flowDef[$flowNum][$stepNum]=$step['id'];
                                $ifaces=Step::getStepLinks($step['id'],12,15);
                                $forms=Step::getStepLinks($step['id'],2,14);
                                $rules=Step::getStepLinks($step['id'],1,16);

                                $ucDef['flow'][$flowNum]['step'][$stepNum]['action']= Version::model()->wikiOutput($step['text'],1);



                                    $name='none';
                                    if(count($ifaces)){ 
                                        $name=$ifaces[0]['name'];
                                        $type='12';
                                        $object_id=$ifaces[0]['iface_id'];
                                    }
                                    if(count($forms)) {
                                        $name=$forms[0]['name'];
                                        $type ='2';
                                        $object_id=$forms[0]['form_id'];
                                    }
                                    $ucDef['flow'][$flowNum]['step'][$stepNum]['resultname']= $name;
                                    $ucDef['flow'][$flowNum]['step'][$stepNum]['resulttype']= $type;
                                    $ucDef['flow'][$flowNum]['step'][$stepNum]['object_id']= $object_id;
                                    $ucDef['flow'][$flowNum]['step'][$stepNum]['resulttext']= Version::model()->wikiOutput($step['result'],1);

                                        if(count($rules)){
                                        $ruleNum=0;
                                                   foreach($rules as $rule){ 
                                                   $ruleNum++;
                                                   $ucDef['flow'][$flowNum]['step'][$stepNum]['rule'][$ruleNum]['name']=$rule['name'];
                                                   $ucDef['flow'][$flowNum]['step'][$stepNum]['rule'][$ruleNum]['number']=$rule['number'];     
                                                    }
                                         }

                         }   

             }
      $this->ProtoFlowStore($ucDef);
     $model = $this->loadModel(Yii::app()->session['project']);
    $this->redirect(Yii::app()->getBaseUrl().'/project/prototype',array('model'=>$model,'ucDef'=>$ucDef));

     
     
     
    } 
    
          public function actionProtoFlowSave()
    {
          
        $release=Yii::App()->session['release'];
        $project=Yii::App()->session['project'];
              
        // Load the ucDef from the company_meta
              $ucDef=$this->ProtoFlowLoad();
             // echo '<pre>';
            //  print_r($ucDef);
            //  echo '</pre>';
        
        // check if this use case exists or if its new.
              if ($ucDef['id']==-1){ // if its new make a new usecase
        
                
                $new= new Usecase;
		 $new->description=$ucDef['description'];
                 $new->name=$ucDef['name'];
		 $new->actor_id=$ucDef['actor_id'];
                 $new->package_id=$ucDef['package_id'];
                 $new->preconditions='none';
				 //get package.id from package.packag_id from the version table
				 $package_versions=Version::model()->getVersions($ucDef['package_id'],5,'package_id');
                 $new->number=Usecase::model()->getNextNumber($package_versions[0]['id']);
                 $new->usecase_id=Version::model()->getNextID(10);
                 $new->project_id=$project;
                 $new->release_id=$release;	
                 if ($new->save()){
                 $version=Version::model()->getNextNumber($project,10,2,$new->primaryKey,$new->usecase_id);  
                 
				 $ucDef['id']=$new->usecase_id;
                   $flow=new Flow;
                        $flow->name='Main';
                        $flow->main=1;
                        $flow->startstep_id=0;
                        $flow->rejoinstep_id=0;
                        $flow->usecase_id=$new->usecase_id;
                        $flow->flow_id=Version::model()->getNextID(8);
                        $flow->project_id= $project;
                        $flow->release_id=Release::model()->currentRelease($project);
                        $flow->save(false);
                        $version=Version::model()->getNextNumber($project,8,1,$flow->primaryKey,$flow->flow_id);
                        //make version
                        
                        // Got to go through all the steps and save them...
                       //$ucDef['flow'][$flowNum]['step'][$stepNum]['resulttext']
                    
                 } ELSE {
                 //$this->redirect('/site/fail/didnotsave');   
                     echo 'Usecase has not saved <br /><pre>';
                     print_r($ucDef);
                     echo '</pre>';

                 }                    	
		
                    
              } ELSE { // if its existing update the usecase with the values from ucDef.
                  
                  
                 // load the UC
                  //find the id from the usecase_id
                  $usecase=Usecase::model()->findbyPK(Version::model()->getVersion($ucDef['id'],10));
                          
                  
                  // update the UC details with the ones in ucDef
                  $usecase->description = $ucDef['description']; 
                  $usecase->name = $ucDef['name'];
                  $usecase->actor_id = $ucDef['actor_id'];
                  $usecase->package_id = $ucDef['package_id'];
                  
                  
                  //save the UC
                  if ($usecase->save()){
                  $version=Version::model()->getNextNumber($project,10,2,$usecase->primaryKey,$usecase->usecase_id);  
                 
                   // find a flow with 
                  $flows=Flow::model()->getUCReleaseFlow($usecase->usecase_id, $release);
                  $steps=Step::model()->getFlowSteps($flows[0]['flow_id']);
                  $flow=Flow::model()->findbyPK($flows[0]['id']);
                      // erase all the steps
                  foreach ($steps as $step){
                      
                      $version=Version::model()->getNextNumber($project,9,3,$step['id'],$step['step_id']);  
                      
                  }
                      //  echo '<pre>';
                      //  print_r($steps);
                      //  echo '</pre>';
                  // cycle through the steps and add the ones in ucDef
                
                  }
                  
              }
              
                  foreach($ucDef['flow'][1]['step'] as $step) {
                            
                             // echo 'Number '.Step::model()->getNextNumber($flow->id).'<br />';
                        $newstep=new Step;
                        $newstep->flow_id=$flow->flow_id;
                        $newstep->number =  Step::model()->getNextNumber($flow->id)+1;
                        $newstep->text=$step['action'];
                        $newstep->actor_id=$ucDef['actor_id'];
                        $newstep->result=$step['resulttext'];
                        $newstep->step_id=Version::model()->getNextID(9);
                        $newstep->project_id= Yii::app()->session['project'];
                        $newstep->release_id=Release::model()->currentRelease($project);
                        if($newstep->save()){;
                          // make version
                        $version=Version::model()->getNextNumber($project,9,1,$newstep->primaryKey,$newstep->step_id);
                    	Step::model()->reNumber($flow->flow_id);
						$newid= $newstep->getPrimaryKey();
						$newstep->text = Version::model()->wikiInput($newstep->text,9,$newid);
                        $newstep->result = Version::model()->wikiInput($newstep->result,9,$newid);
                        $newstep->save();

                       // echo 'step text '.$newstep->text.'<br />';
                        //echo 'step number '.$newstep->number.'<br />';
                       // echo 'flow id to get number '.$flow->id.'<br />';
                          // $ucDef['flow'][$flowNum]['step'][$stepNum]['rule'][$ruleNum]['name']=$rule['name'];
                        } ELSE {
                        echo 'Didnt save the step';
                        }
                          /*if($step['resulttype']==12){ // its an interfacet so add the stepiface
                                $newstepiface=new Stepiface;
                                $newstepiface->stepiface_id=Version::model()->getNextID(15);
                                $newstepiface->project_id= $project;
                                $newstepiface->release_id=Release::model()->currentRelease($project);
                                $newstepiface->step_id=$newstep->step_id;
                                $newstepiface->iface_id=$step['object_id'];
                                $newstepiface->save(false);
                                $version=Version::model()->getNextNumber($project,15,1,$newstepiface->primaryKey,$newstepiface->stepiface_id);
                  
                       //     echo 'Flow id is:'.$flow->id.'<br />';
                        //              echo '<br / > STEPS <br /><pre>';
                       // print_r($steps);
                       // echo '</pre>';
              
                              
                          }
                          
                            if($step['resulttype']==2){ // its a form so add the stepiform
                              
                          }*/
                          
                        }
                 
             
      $this->redirect('prototype');
    } 
    
    public function actionProtoFlow($id)
	{
		$usecase=Usecase::model()->findbyPK($id);
                $this->render('_protoflow',array(
			'usecase'=>$usecase,
		));  
                    
	}
      public function actionProtoIfaceAdd()
    {
     $tab=Yii::App()->session['setting_tab'];
    $flow['add']=1;
	 $ucDef= $this->ProtoFlowLoad();  
     $model = $this->loadModel(Yii::app()->session['project']);
	 
     $this->render('prototype',array('model'=>$model,'flow'=>$flow,'ucDef'=>$ucDef));
	 
     
    }
       public function actionProtoTitleSet()
	{
           
	$ucDef= $this->ProtoFlowLoad();  
        $ucDef['name']=$_POST['value'];
        $this->ProtoFlowStore($ucDef);
        }
    
     
       public function actionProtoNameSet()
	{
           
	$ucDef= $this->ProtoFlowLoad();  
        $ucDef['name']=$_POST['value'];
        $this->ProtoFlowStore($ucDef);
        }
        
       public function actionProtoDescriptionSet()
	{
           
	$ucDef= $this->ProtoFlowLoad();  
        $ucDef['description']=$_POST['value'];
        $this->ProtoFlowStore($ucDef);
        }
    
    
    
    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=Project::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='project-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionTenderSummary($id){
        if(isset($_GET['id']) && $project = Project::model()->findByPk($_GET['id'])){
            
            $model=new Tenderans('myProject');
            $model->unsetAttributes();  // clear any default values
            
            if(isset($_GET['Tenderans']))
                $model->attributes=$_GET['Tenderans'];

            $this->render('tenderSummary',compact('model','project'));
        }
    }

    public function actionAddmeta() {
        if ( isset($_POST) && isset($_POST['Projectmetaform']) ) {
            $data = $_POST['Projectmetaform'];
            $id =  Yii::App()->session['project'];
            foreach ($data as $key => $meta) {
                $projectMeta = Project::model()->findByPk($id);
                $projectMeta->setEavAttribute($key, $meta);
                $projectMeta->save();
            }
            if (!isset($_POST['Projectmetaform']['html_output']) ) {
                $projectMeta = Project::model()->findByPk($id);
                $projectMeta->setEavAttribute('html_output', 0);
                $projectMeta->save();
            }
        }
        $this->redirect(UrlHelper::getPrefixLink('project/project/'));
    }
	
	public function actionRearrangeProtoSteps($new_index,$old_index)
	{
		$ucDef= $this->ProtoFlowLoad();
		$step = array($ucDef['flow'][1]['step'][$old_index]);
		unset($ucDef['flow'][1]['step'][$old_index]);
		array_splice($ucDef['flow'][1]['step'],$new_index,0,$step);
		$this->ProtoFlowStore($ucDef);
		 die;
		
		
	}
	 public function actionRemoveProtoSteps($index=-1)
	 {
		 if($index!=-1){
		 $ucDef= $this->ProtoFlowLoad();
		 unset($ucDef['flow'][1]['step'][$index]);
		 $ucDef['flow'][1]['step']=array_values($ucDef['flow'][1]['step']);
		 $this->ProtoFlowStore($ucDef);
		 }
		 die;
	 }

}
