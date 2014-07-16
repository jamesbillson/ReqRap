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
                'actions'=>array('index','view','extview'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('walkthru','testing','addprojectaddress','set','photo','print',
                    'diary','resetlink','details',
                    'myrequirements','project','delete','create','update','myprojects','projectpackagelist','TenderSummary'),
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
    $this->redirect(array('/project/project/'));
        
    }
    
    public function actionView()
    {
      
         $tab=Yii::App()->session['setting_tab'];
     if (!in_array($tab,array('sections',
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
        $this->render('view',array(
                'model'=>$model ));

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
      
        if(!($model===null))
            {
                $this->render('print',array(
                    'model'=>$model,'tab'=>'documents'
                ));
            } ELSE {    
            $this->redirect(array('site/fail/condition/no_access'));
            }
    }
 public function actionprint()
    {
                  $this->render('print');
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
            $this->redirect(array('view','id'=>$model->id,'tab'=>'documents'));
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
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Project']))
        {
            $model->attributes=$_POST['Project'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id,'tab'=>'documents'));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
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
        } ELSE {
     
                  $this->redirect(array('site/fail/condition/no_access'));
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
            $this->redirect('myrequirements');
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
         } ELSE {
                        // You are not permitted to see this page
                  $this->redirect(array('site/fail/condition/no_access'));
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
         } ELSE {
                        // You are not permitted to see this page
                  $this->redirect(array('site/fail/condition/no_access'));
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
        } ELSE {
                  $this->redirect(array('site/fail/condition/no_access'));
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

}
