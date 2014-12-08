<?php

class FollowerController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';
    public $objects = array('0','project','package');
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
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
                'actions'=>array('index','view','accept'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('resendinvite','create','update','AddFollower','remove'),
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
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Follower;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Follower']))
        {
            $model->attributes=$_POST['Follower'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
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

        if(isset($_POST['Follower']))
        {
            $model->attributes=$_POST['Follower'];
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
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionremove($id)
    {
    $redirect=$this->loadModel($id);
        $object = $this->objects;
        $controller=$object[$redirect->type];
        $action= $redirect->foreign_key;
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
        {
                Yii::App()->session['setting_tab']='followers';
                $this->redirect(array('/req/project/project'));
                }
                
        }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Follower');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Follower('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Follower']))
            $model->attributes=$_GET['Follower'];

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
        $model=Follower::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='follower-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
        
    public function actionAddFollower($id,$type)
    {
        $model = new Follower;
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Follower']))
        {
            $model->attributes=$_POST['Follower']; 
            $contactid = $_POST['Follower']['contact_id'];
            //does this contact have an account?
            $contact = Contact::model()->find("id = ".$contactid); 
            //load the details of the person inviting the follower
           
            $model->modified=Yii::app()->user->id;
            $model->modified_date=date("Y-m-d H:i:s", time());
            $model->link=uniqid('',true);
         //echo 'created now follower about to save';
            if($model->save()) {
                Follower::model()->sendInvite($model->primaryKey);
                Yii::App()->session['setting_tab']='followers';
								$this->redirect(('/req/project/project'));
             }
        }
        //check user
       // $user = User::model()->findByPk(Yii::app()->user->id);
        
        $this->render('_form',array(
            'model'=>$model,
            'fk'=>$id,
            'type'=>$type,
            
        ));
    }
    
      public function actionResendInvite($id,$fk)
    {
       
            $model=$this->loadModel($id);

          
            Follower::model()->sendInvite($model->primaryKey);
            
            //go back to the original follow object screen
            //pick the object from an array by the index.
            
        $this->redirect(array('/project/project','tab'=>'followers'));
                
    }
    
    public function actionAccept($id)
    {
       
        // unencode the link, and see if it matches.
        $link = urldecode($id);
        $follower = Follower::model()->find("link = '".$link."'");
        // if it doesn't match, redirect to sorry page.
        if (!isset($follower->id))  {
            //$this->redirect(array('/req/site/fail'));
            ReportHelper::processError('Follower Controller, Accept action');
        }
        //if it does match, see what kind of contact they are
        $contact = Contact::model()->findbyPk($follower->contact_id);
        $matchuser = User::model()->find("username = '".$contact->email."'"); 
     
        //if they don't have an account 
        //give them a join form.
        if (!isset($matchuser->id)) {
            Yii::app()->user->logout();
            $this->redirect(array('/req/user/joinfollower/id/'.$contact->id));
        }
        //on successful save of the user,                  
        //confirm them  (Do this on home page - show follower invites, send email on join).              
                      
        //if they have an account then just confirm them as a follower, 
        // set link = 0, set confirmed = 1, set contact.user_id to user.id
        $follower->link = '0';
        $follower->confirmed = 1;
        if($follower->save())
        {
           //connect the contact to the user as they have linked the account.
            Contact::model()->connectUser($matchuser->id);
           // LOG THEM IN..
            
            
            
          $user = User::model()->findByAttributes(array('id'=>$matchuser->id));
        if(isset($user)) {
            $identity = new UserIdentity($user->email, $user->password);
            $identity->setId($user->id);

            //just add code to auto authentication
            $identity->authenticate();
            $identity->errorCode = UserIdentity::ERROR_NONE;
            Yii::app()->user->login($identity, (Yii::app()->params['loggedInDays'] * 60 * 60 * 24 ));
            Follower::model()->sendAcceptConfirm($follower->id);
            
            
   $this->redirect(array('/req/project/set','id'=>$follower->foreign_key));
        }
           //send a welcome email
            //send an email to the inviter to say they have joined.
        }                                    
    }
}
