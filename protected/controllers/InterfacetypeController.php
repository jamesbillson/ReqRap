<?php

class InterfacetypeController extends Controller
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
				'actions'=>array('create','update'),
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
        public function actionView($id) // Note that this is interfacetype_id
	{
             	$versions=Version::model()->getVersions($id,13,'interfacetype_id');
                $model=$this->loadModel($versions[0]['id']);
                $this->render('view',array('model'=>$model,
			'versions'=>$versions
        	));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Interfacetype;

		if(isset($_POST['Interfacetype']))
		{
                        $model->attributes=$_POST['Interfacetype'];
                        $model->interfacetype_id=Version::model()->getNextID(13);
			if($model->save())
                                {
				$this->redirect(array('/project/view/tab/interfaces/id/'.$model->id));
                                $version=Version::model()->getNextNumber($id,13,1,$model->primaryKey,$model->interfacetype_id);   
                                }
                 }

		$this->render('create',array(
			'model'=>$model,
		));
	}

 
	public function actionUpdate($id)
	{
		
            
            $model=$this->loadModel($id);
                $new= new Interfacetype;
		
                $id=$model->project_id;
		if(isset($_POST['Iface']))
		{
		 $new->attributes=$_POST['Interfacetype'];
                 $new->number=$model->number;
                 $new->project_id=$model->project_id;
                 $new->interfacetype_id=$model->interfacetype_id;	
                 if($new->save()){
                      $version=Version::model()->getNextNumber($id,13,2,$new->primaryKey,$new->interfacetype_id);   
                      $this->redirect(array('/usecase/view/id/'.$ucid));
                 }
				
		}
                    $this->render('update',array(
			'model'=>$model,
		));
	}

	 
	public function actionDelete($id)
	{
		
            $model=$this->loadModel($id);
            $version=Version::model()->getNextNumber($model->project_id,13,3,$id,$model->interfacetype_id);  
	     $this->redirect(array('/project/view/tab/interfaces/id/'.$model->project_id));
        }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Interfacetype');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Interfacetype('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Interfacetype']))
			$model->attributes=$_GET['Interfacetype'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Interfacetype the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Interfacetype::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Interfacetype $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='interfacetype-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
