<?php

class UserController extends Controller
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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('reverify','promote','demote','sack','reinvite','index','invite','create','update','admin','delete'),
                'roles'=>array('admin'),
                /*'users'=>array('@'),*/
            ),
            array('allow', 
                'actions'=>array('view','actup','destroy'),
                'users'=>array('james@billson.com'),
            ),
            array('allow',  
                  'actions'=>array('join','accept','active','success'),
                  'users'=>array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView()
    {

       
        $this->render('view');
    }
    
    

     public function actionmyaccount()
    {
       
        $this->render('myaccount',array(
            'model'=>$this->loadModel(Yii::App()->user->id),
        ));
    }
   public function actionJoinSuccess($id)
    {
       $model=$this->loadModel($id);
        $this->render('joinsuccess',array('model'=>$model));
        
        
    }
   public function actionWelcome()
    {
       
        $this->render('welcome');
    }
    
    
       public function actionDestroy($id)
    {
           $model=$this->loadModel($id); 
        //Remove Versions
        Version::model()->userDestroy($id);
        
        // Remove the company   
        if($model->company_id>0)
        Company::model()->userDestroy($model->company_id);      
   
       // Remove User    
       $model->delete();
      
           
        $this->render('/user/view');
    }
    
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new User;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['User']))
        {
            $model->attributes=$_POST['User'];
            if ($model->save()) {
                $this->redirect(array('/req/view','id'=>$model->id));
        }
 }
        $this->render('create',array(
            'model'=>$model,
            //        'users'=>$users,
        ));
    }

     
    public function actionJoin()
    {
        $this->layout='column1';
        
        $model = new RegisterForm;
        
        if(isset($_POST['RegisterForm'])){
            $model->attributes = $_POST['RegisterForm'];

            if($model->validate()){
                $user = new User;
                $user->attributes = $_POST['RegisterForm'];
                $user->active = 0;
                $user->username = $user->email;

                if($user->save()){

                  $link = urlencode($user->salt);
                  $mail = new YiiMailer();

                    $mail->setFrom(Yii::app()->params['adminEmail']);
                    $mail->setTo($user->email);
                    $mail->setSubject('You have registered an account on ReqRap');
                    $mail->setBody('Dear '.$user->firstname.',
                    <br />
                    Hi, it looks like you\'ve created a ReqRap account, the 
                    rapid web requirements system.<br />
                    To confirm your email address and activate your account follow 
                    the link below and complete the join form.
                    <br />
                    Click here to accept <a href="http://'.Yii::app()->params['server'].'/user/active/verifycode/'.$link.'">'.Yii::app()->params['server'].'/user/active/verifycode/'.$link.'</a>                   
                    <br />
                    <br />
                    Thanks, 
                    from the ReqRap Team.
                    ');

                    $mail->Send();
                    Yii::app()->user->logout(); 
                    $this->redirect(array('joinsuccess','id'=>$user->id));
                    /**/
                } 
            }
        }

        $this->render('join',array(
            'model'=>$model,
        ));
    }

    
      
    public function actionReverify()
    {
       
          $user=User::model()->findbyPK(Yii::App()->user->id);

                  $link = urlencode($user->salt);
                  $mail = new YiiMailer();

                    $mail->setFrom(Yii::app()->params['adminEmail']);
                    $mail->setTo($user->email);
                    $mail->setSubject('You have registered an account on ReqRap');
                    $mail->setBody('Dear '.$user->firstname.',
                    <br />
                    Hi, it looks like you\'ve created a ReqRap account, the 
                    rapid web requirements system.<br />
                    To confirm your email address and activate your account follow 
                    the link below and complete the join form.
                    <br />
                    Click here to accept <a href="http://'.Yii::app()->params['server'].'/user/active/verifycode/'.$link.'">'.Yii::app()->params['server'].'/user/active/verifycode/'.$link.'</a>                   
                    <br />   <br />.
                    Thanks, 
                    from the ReqRap Team.
                    ');

                    $mail->Send();
                    Yii::app()->user->logout();
                    $this->redirect(array('joinsuccess','id'=>$user->id));
                    /**/
                

    }
    
     public function actionJoinfollower($id)
    {
         $contact = Contact::model()->findbyPk($id);
      
         
// version of join that is used for followers
        $this->layout='column1';
        
        $model = new FollowerForm;
        
        if(isset($_POST['FollowerForm'])){
            $model->attributes = $_POST['FollowerForm'];
           
            if($model->validate()){
                $user = new User;
                $user->attributes = $_POST['FollowerForm'];
                $user->active = 0;
                $user->email=$contact->email;
                $user->username = $user->email;
                $user->verification_code = substr(sha1($user->email . time()), 0, 10);
                if($user->save()){

                  $link = urlencode($user->salt);
                  $mail = new YiiMailer();

                    $mail->setFrom(Yii::app()->params['adminEmail']);
                    $mail->setTo($user->email);
                    $mail->setSubject('You have registered an account on ReqRap');
                    $mail->setBody('Dear '.$user->firstname.',
                    <br />
                    Hi, it looks like you\'ve created an account on ReqRap, the 
                    rapid web requirements system.<br />
                    To confirm your email address and activate your account follow 
                    the link below and complete the join form.
                    <br />
                    Click here to accept <a href="http://'.Yii::app()->params['server'].'/user/active/verifycode/'.$link.'">'.Yii::app()->params['server'].'/user/active/verifycode/'.$link.'</a>                   
                    <br />   <br />.
                    Thanks, 
                    from the ReqRap Team.
                    ');

                    $mail->Send();
                    Yii::app()->user->logout();
                    $this->redirect(array('joinsuccess','id'=>$user->id));
                    /**/
                } 
            }
        }

        $this->render('joinfollower',array(
            'model'=>$model,
        ));
    }

    public function actionActive() {
			Yii::app()->user->logout();
			wp_logout();
      if(isset($_GET['verifycode']) && $user = User::model()->findByAttributes(array('salt'=>$_GET['verifycode'])) ) {
        if(isset($user)) {
          	$user->active = 1;
          	$user->type = 1;
          	User::model()->activate($user->id);
            $identity = new UserIdentity($user->email, $user->password);
            $identity->setId($user->id);
            $identity->errorCode = UserIdentity::ERROR_NONE;
            Yii::app()->user->login($identity, (Yii::app()->params['loggedInDays'] * 60 * 60 * 24 ));
            wp_set_auth_cookie( $user->id );
            $this->redirect(('/req/company/mycreate'));
        }
      }
			ReportHelper::processError('User Controller, Active action', '/req/site/fail');
    }

    public function actionReInvite($id)
    {
       
            $model=$this->loadModel($id);

          
            User::model()->sendInvite($model->primaryKey);
            
            //go back to the original follow object screen
            //pick the object from an array by the index.
            Yii::app()->user->setFlash('success', "Invite Sent.");
        $this->redirect(('/req/company/mycompany'));
                
    }
    
       public function actionactUp($id)
    {
       
            $user=$this->loadModel($id);
  if(isset($user)) {
            $identity = new UserIdentity($user->email, $user->password);
            $identity->setId($user->id);

            //just add code to auto authentication
            $identity->authenticate();
            $identity->errorCode = UserIdentity::ERROR_NONE;
            Yii::app()->user->login($identity, (Yii::app()->params['loggedInDays'] * 60 * 60 * 24 ));
                       
            
   $this->redirect(('/req/company/mycompany'));
        }
            
    }
    
    
    public function actionInvite()
    {
      try {
            $model = new User;
            if(isset($_POST['User'])) {
                $model->attributes = $_POST['User'];
                $model->password ='temp';
                $model->username = $model->email ;
                $model->company_id = User::model()->myCompany();
                $model->verification_code = substr(sha1($model->email . time()), 0, 10);
               // $model->isNewRecord = true;
                $sender = User::model()->findbyPK(Yii::app()->user->id);
                
                if($model->validate() && $model->save()) {

                    $message = User::model()->findByPk($model->id);
                    $link = urlencode($message->salt);
                    $mail = new YiiMailer();
                    $mail->setFrom($sender->email, $sender->firstname.' '.$sender->lastname);
                    $mail->setTo($message->email);
                    $mail->setSubject('You have been invited to join '.$sender->company->name.' on ReqRap');
                    $mail->setBody($message->firstname.',
                    <br />
                    You\'ve been invited to join '.$sender->company->name.' on ReqRap, the 
                    rapid web requirements system.<br />
                    To create your account follow the link below and complete the join form.
                    <br />
                    Click here to accept <a href="http://'.Yii::app()->params['server'].'/user/accept/id/'.$link.'">'.Yii::app()->params['server'].'/user/accept/id/'.$link.'</a>                   
                    <br />   <br />
                    If you don\'t know why you got this email then check with '.$sender->firstname.' '.$sender->lastname.'  
                    <br />
                    If you have received this email in error, simply ignore it.
                    ');
                    $mail->Send();
                    $this->redirect(('/req/company/mycompany'));
                }
            }
        } catch(Exception $e) {
          throw new Exception($e->getMessage());
        }
        $this->render('invite',array(
            'model'=>$model
        ));
    }
    
    public function actionAccept($id)
    {
     Yii::app()->user->logout();
        //check the uuencoded password string.
        $salt = urldecode($id); 
        $model = User::model()->find("salt = '".$salt."'");
        if (!isset($model->id))  $this->redirect(('/req/site/fail/nomatch'));
        // there is a matching user.
        // model loads the existing user
        //$model=$this->loadModel($newaccount->id);

        if(isset($_POST['User']))
            // if the form has been submitted
        {   
        if ($_POST['User']['password']==$_POST['User']['password2']){
            $model->scenario = 'update';
            $model->type=1;
            $model->firstname=$_POST['User']['firstname'];
            $model->lastname=$_POST['User']['lastname'];
            $model->password=$_POST['User']['password'];
            $model->salt = $model->generateSalt();
                        
            if($model->save()){
         
            $identity = new UserIdentity($model->email, $model->password);
            $identity->setId($model->id);
            $identity->errorCode = UserIdentity::ERROR_NONE;
            Yii::app()->user->login($identity, (Yii::app()->params['loggedInDays'] * 60 * 60 * 24 ));
            
            $this->redirect(('/req/company/mycompany'));      
        }
        
            }
        
               
        } 
         
              $this->render('accept',array(
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
       $id=yii::app()->user->id;
        $model=$this->loadModel($id);

        if(isset($_POST['User']))
        {   
            if(empty($_POST['User']['password'])) {
                $model->scenario = 'update';
                $model->firstname=$_POST['User']['firstname'];
                $model->lastname=$_POST['User']['lastname'];
         //       $model->email=$_POST['User']['email'];
          //      $model->username=$_POST['User']['email'];
              //  $model->password=$model->password;
                $model->salt =  $model->generateSalt();
                if($model->save())
                    $this->redirect('/req/user/update');
            }else{
                $model->scenario = 'newPassword';
                $model->attributes=$_POST['User'];
                $model->password = $_POST['User']['password'];
                if( $model->save() ) {
                  wp_set_password( $_POST['User']['password'], $model->id );
                  $modelLogin = new LoginForm;
            //      $modelLogin->username = $_POST['User']['email'];
                  $modelLogin->password = $_POST['User']['password'];
                  $modelLogin->login();
                  $this->redirect('/req/user/update');
                }
            }
            Yii::app()->user->setFlash('success', "Profile Updated");
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    
    
       public function actionPromote($id)
    {
       
       //check ownership
       if (Company::model()->checkOwnershipUser($id))
       {
       $model=$this->loadModel($id);
       $model->admin=1;
	if($model->save())
	$this->redirect(('/req/company/mycompany'));
		
       }
		
    }
       public function actionDemote($id)
    {
         if (Company::model()->checkOwnershipUser($id))
       {
       $model=$this->loadModel($id);
       $model->admin=0;
	if($model->save())
		$this->redirect(('/req/company/mycompany'));
		
       }

		
    }    
    
      public function actionSack($id)
    {
         if (Company::model()->checkOwnershipUser($id))
       {
       $model=$this->loadModel($id);
       $model->company_id=0;
	if($model->save())
		$this->redirect(('/req/company/mycompany'));
		
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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : '/req/admin');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('User');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new User('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['User']))
            $model->attributes=$_GET['User'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=User::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.', 'load_model');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    
 
    
    
    
    
        }
