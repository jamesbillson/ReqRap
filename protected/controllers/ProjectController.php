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
                'actions'=>array('addprojectaddress','photo','diary','resetlink','details','packagescontract','stagescontract','templatepackage','responses','tendersubmit','mybids','mytenders','delete','create','update','myprojects','projectpackagelist','TenderSummary'),
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
    public function actionView($id,$tab)
    {
        $model = $this->loadModel($id);
        $served=0; //variable to stop redirect to fail if a page is served
        // if the user belongs to the owner company, show one view
        if(User::model()->myCompany()== $model->company_id)
        {
            $served=1;
            $this->render('view',array(
                'model'=>$model,'tab'=>$tab
            ));
        } 
        // see if the current user is a follower.
        $follower = Follower::model()->getFollowers($id,1);

        foreach($follower as $item)
        {
            if ($item['user_id']==Yii::app()->user->id)
            {
                $served=1;
                $this->render('followview',array(
                    'model'=>$model,'tab'=>$tab
                ));
            }     
        }

        $tenderer = Follower::model()->getTenderers($id,1);

        foreach($tenderer as $item)
        {
            if ($item['user_id']==Yii::app()->user->id)
            {
                $served=1;
                $this->render('followview',array(
                    'model'=>$model,'tab'=>$tab
                ));
            }     
        }
        
        if ($served != 1) $this->redirect(array('site/fail/condition/no_access'));
    }
 public function actionExtView($id)
    {
        $model = Project::model()->find('extlink = \''.$id.'\'');
      
        if(!($model===null))
            {
         
            $this->render('extview',array(
                'model'=>$model,'tab'=>'documents'
            ));
        } ELSE {    
           $this->redirect(array('site/fail/condition/no_access'));
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
            if($model->save())
           
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

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect('myprojects');
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
    
    public function actionMyBids()
    {
        $this->render('mybids');
    }
        
    public function actionprojectPackageList()
    {
        $id=$_POST['project_id'];
        $data=Project::model()->projectPackageList($id);
        $data=CHtml::listData($data,'id','name');
        foreach($data as $value=>$name)
        {
            echo CHtml::tag('option',
            array('value'=>$value),CHtml::encode($name),true);
        }
    }
                
    public function actiontendersubmit($id)
    {
        //Set the tender answers related to this project 
        // from this company as status 5 - ie submitted
        Tenderans::model()->tendersubmit($id);
        $this->redirect(array('/project/view','id'=>$id,'tab'=>'tenderers'));
    }
        
    public function  actiontemplatepackage($template, $project)
    {
        //Copy the template package items to this project
        Package::model()->addfromtemplate($project, $template);
        $this->redirect(array('/project/view','id'=>$project,'tab'=>'package'));
    }
    
     public function  actionpackagescontract($vid,$pid)
    {
        //Create contract items from packages
        Contractitem::model()->addfrompackages($vid,$pid);
        $this->redirect(array('/variation/view','id'=>$vid));
    }
    
        public function  actionstagescontract()
    {
        //Create contract items from packages
          if(isset($_POST['contractsum']))
        {
           $_POST['pid'];
                     
             Contractitem::model()->addfromstages($_POST['vid'],$_POST['pid'],$_POST['contractsum']);
        
        }
        
        $this->redirect(array('/variation/view','id'=>$_POST['vid']));
    }
    
    public function actionResponses($id,$resp)
    {
        $model = $this->loadModel($id);
        $this->render('responses',array(
            'model'=>$model,'resp'=>$resp));
    }
        
    /**
     * Manages all models.
     */
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
