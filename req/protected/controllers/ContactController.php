<?php

class ContactController extends Controller
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
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update','mycontacts'),
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
        $model=new Contact;
        $newCompany = new Company;
        $addresses = new Addresses;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Contact']))
        {
            //$userid=Yii::app()->user->id;
            $mycompany=User::model()->myCompany();
            $model->attributes=$_POST['Contact'];
            $company = Company::model()->find('name=\''.$_POST['Company']['name'].'\' AND companyowner_id='.$mycompany);
            
            //process company
            if(isset($company)){
                $model->company_id = $company->id;
            }else{               
                if(isset($_POST['Company']))
                {
                    $newCompany->attributes=$_POST['Company'];
                    $newCompany->type=2;
                    $newCompany->companyowner_id=$_POST['Company']['companyowner_id'];
                    
                    if($newCompany->save()){
                        $model->company_id = $newCompany->id;
                    } else {
                        $this->render('create',compact('model','newCompany','addresses'));
                        return;
                    }  
                } else {
                    $this->render('create',compact('model','newCompany','addresses'));
                    return;
                }
            }


   
            if($model->save()){
                //process Addresses
                if(isset($_POST['Addresses'])){
                    $addresses->attributes=$_POST['Addresses'];
                    $addresses->foreign_key = $model->id;
                    if(!empty($addresses->name)){
                        if(!$addresses->save())
                            $this->render('update',compact('model','newCompany','addresses','address'));                        
                    }
                } 
                $this->redirect(('/req/contact/mycontacts'));
            }
        }

        $this->render('create',compact('model','newCompany','addresses'));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);
        $newCompany = Company::model()->findByPk($model->company_id); 
        if(!isset($newCompany)) {
            $newCompany = new Company;
        }
        $addresses = new Addresses;          
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Contact']))
        {
            Yii::app()->user->id;
            $model->attributes=$_POST['Contact'];
            $company = Company::model()->findByAttributes(array('name'=>$_POST['Company']['name']));
            
            //process company
            if(isset($company)){
                $model->company_id = $company->id;
            }else{               
                if(isset($_POST['Company']))
                {
                    $blankCompany = new Company;
                    $blankCompany->attributes=$_POST['Company'];
                    $blankCompany->type=2;
                    if($blankCompany->save()){
                        $model->company_id = $blankCompany->id;
                    } else {
                        $this->render('update',compact('model','newCompany','addresses','address'));
                        return;
                    }  
                } else {
                    $this->render('update',compact('model','newCompany','addresses','address'));
                    return;
                }
            }


            // I WONDER IF .... User_id should be stored in the contact.
            // a user may have many contacts. So that makes more sense than storing 
            // it in the follower.
            if($model->save()){
                if(isset($_POST['Addresses'])){
                    $addresses->attributes=$_POST['Addresses'];
                    $addresses->foreign_key = $model->id;
                    if(!empty($addresses->name)){
                        if(!$addresses->save())
                            $this->render('update',compact('model','newCompany','addresses','address'));                        
                    }

                } 
                $this->redirect(('/req/contact/mycontacts'));
            }
        }

        $this->render('update',array(
            'model'=>$model,
            'newCompany'=>$newCompany,
            'addresses'=>$addresses,
            'address'=>Addresses::model()->getAddressForContact($id),
            //'addresses'=>Addresses::model()->getAddressForContact($id),
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

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Contact');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }
    public function actionMyContacts()
    {
        $company=Company::model()->findbyPK(User::model()->myCompany());
        $model=new Contact('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Contact']))
            $model->attributes=$_GET['Contact'];

        $this->render('mycontacts',array(
            'model'=>$model,'company'=>$company
        ));
    
      
    }
        
    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Contact('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Contact']))
            $model->attributes=$_GET['Contact'];

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
        $model=Contact::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='contact-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
