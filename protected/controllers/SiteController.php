<?php
class SiteController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public function accessRules()
    {
        return array(
                array('allow',  // deny all users
                'users'=>array('terms'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('view', 'create','quickaddvintage','update','inlineupdate','addvintage','addvariety','addregion'),
               //'roles'=>array('@'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
               //'roles'=>array('admin'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                'class'=>'CViewAction',
            ),
            'coco'=>array(
            'class'=>'CocoAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionAdmin()
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('admin');
    }

        public function actionTerms()
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
          $this->render('terms');
    }

    
    public function actionPrivacy()
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
         $this->render('privacy');
    }    

            public function actionBenefits()
    {
       //if (Yii::app()->user->isGuest) $this->layout = 'public';
        
        $this->render('benefits');
    }  

      public function actionManage_drawings_and_tenders_online()
    {
       //if (Yii::app()->user->isGuest) $this->layout = 'public';
        
        $this->render('pms');
    }  
      public function actionManage_Construction_Online()
    {
       //if (Yii::app()->user->isGuest) $this->layout = 'public';
        
        $this->render('build');
    }  
    
                public function actionPlans()
    {
       //if (Yii::app()->user->isGuest) $this->layout = 'public';
        
        $this->render('plans');
    }  
    
        public function actionFail()
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('fail');
    }
    
    
    public function actionReports()
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('reports');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model=new ContactForm;
        if(isset($_POST['ContactForm']))
        {
            $model->attributes=$_POST['ContactForm'];
            if($model->validate())
            {
                $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
                $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
                $headers="From: $name <{$model->email}>\r\n".
                    "Reply-To: {$model->email}\r\n".
                    "MIME-Version: 1.0\r\n".
                    "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
                Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact',array('model'=>$model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
                
        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                
       
                
                        $this->redirect(array('site/index'));
        }
        // display the login form
        //CHECK IF A USER IS LOGGED IN AND REDIRECT TO INDEX IF NOT, REDIRECT TO LOGIN
         if(Yii::app()->user->isGuest){ // not logged in 
            $this->render('login',array('model'=>$model)); //
        // $this->redirect(array('site/login')); /// redirect to target page 
                                    }
        else{
        $this->render('index');/// redirect to target page 
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }      
}