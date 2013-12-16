<?php

class PackageController extends Controller
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
				'actions'=>array('updatepackage','bidsubmit','create','update','remove','addPackage','subcontractview'),
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
         
           
          
           if(User::model()->myCompany()== $model->project->company_id)
          {
           
                $served=1;
		$this->render('view',array(
			'model'=>$model,'tab'=>$tab
		));
          } 
          // see if the current user is a follower.
          $follower = Follower::model()->getFollowers($id,2);
          
          foreach($follower as $item)
          {
            if ($item['user_id']==Yii::app()->user->id)
                {
                $served=1;
                $this->render('followview',array(
			'model'=>$model,'tab'=>$tab));
                } 
           
          }
            $tenderer = Follower::model()->getTenderers($id,2);
          foreach($tenderer as $item)
          {
            if ($item['user_id']==Yii::app()->user->id)
                {
                $served=1;
                $this->render('tenderview',array(
			'model'=>$model,'tab'=>$tab));
                 } 
          }
       
         if ($served != 1) $this->redirect(array('site/fail'));
	
          
        }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Package;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Package']))
		{
			$model->attributes=$_POST['Package'];
			if($model->save())
				$this->redirect(array('/project/view','id'=>$model->project->id,'tab'=>'package'));
		}

		$this->render('create',array(
			'model'=>$model,
                   
		));
	}

        
        public function actionsubcontractview($bidderid, $packid)
	{
		$this->render('subcontractview',array(
			'model'=>$this->loadModel($packid),'bidderid'=>$bidderid, 'packid'=>$packid
		));
	}
        
        	public function actionAddPackage($id)
	{
		$model=new Package;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Package']))
		{
			$model->attributes=$_POST['Package'];
			if($model->save())
				$this->redirect(array('/project/view','id'=>$model->project->id,'tab'=>'package'));
		}

		$this->render('addpackage',array(
			'model'=>$model, 'id'=>$id,
		));
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
        
        
        public function actionUpdatePackage()
{
    $es = new EditableSaver('Package');  //'User' is name of model to be updated
    $es->update();
}
        
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Package']))
		{
			$model->attributes=$_POST['Package'];
			if($model->save())
				$this->redirect(array('/project/view','id'=>$model->project->id,'tab'=>'package'));
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

        
        	public function actionRemove($id)
	{
		$model=$this->loadModel($id);
                $project=$model->project->id;
                $this->loadModel($id)->delete();

		$this->redirect('/project/view/id/'.$project.'/tab/package');
	}
        
        
        
         public function actionbidsubmit($id)
    {
        //Set the tender answers related to this package 
        // from this company as status 5 - ie submitted
        Tenderans::model()->bidsubmit($id);
        $this->redirect(array('/package/view','id'=>$id,'tab'=>'bidder'));
    }
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Package');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Package('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Package']))
			$model->attributes=$_GET['Package'];

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
		$model=Package::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='package-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
