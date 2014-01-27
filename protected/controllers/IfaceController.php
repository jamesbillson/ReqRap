<?php

class IfaceController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id,$uc)
	{
              
            
                $model= new Iface;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Iface']))
		{
                    
                  if(!empty($_POST['new_type']))
                    {
               //echo "make new type with name".$_POST['new_type']." for project ".$_POST['Iface']['project_id'];
               
               $interfacetype=new Interfacetype;
        	$interfacetype->project_id=$_POST['Iface']['project_id'];
                $interfacetype->name=$_POST['new_type'];
		if($interfacetype->save())
                $_POST['Iface']['type_id']=$interfacetype->primarykey;  
                
                    }
			$model->attributes=$_POST['Iface'];
                     $model->number=Iface::model()->getNextIfaceNumber($model->project->id);
                     $model->file='default.png';
			if($model->save()){
                            
                  if($uc != -1){
                   $ifuc= new Interfaceusecase;  
                    $ifuc->usecase_id=$uc;
                    $ifuc->interface_id=$model->primarykey;
                    

                    
                    
                    $ifuc->save();
                  }
                    	$this->redirect(array('/project/view/id/'.$model->project->id.'/tab/interfaces'));
		   } }

		$this->render('create',array(
			'model'=>$model,'id'=>$id,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id,$ucid)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $id=$model->project_id;
		if(isset($_POST['Iface']))
		{
			$model->attributes=$_POST['Iface'];
			if($model->save())
				$this->redirect(array('/usecase/view/id/'.$ucid));
		}

		$this->render('update',array(
			'model'=>$model,'id'=>$id
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id,$ucid,$type)
	{
		$this->loadModel($id)->delete();
               if($type==1) $this->redirect(array('/usecase/view/id/'.$ucid));
               if($type==2) $this->redirect(array('/project/view/tab/interfaces/id/'.$ucid));
	}


        
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Iface');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Iface('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Iface']))
			$model->attributes=$_GET['Iface'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Iface the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Iface::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Iface $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='iface-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
