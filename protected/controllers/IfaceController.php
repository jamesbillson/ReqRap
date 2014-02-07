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



        public function actionView($id) // Note that this is form_id
	{
             	$versions=Version::model()->getVersions($id,12,'iface_id');
                $model=$this->loadModel($versions[0]['id']);
                $this->render('view',array('model'=>$model,
			'versions'=>$versions
        	));
	}
        
        
	public function actionCreate($id)
	{
              
            
                $model= new Iface;
		

		if(isset($_POST['Iface']))
		{
                  $model->attributes=$_POST['Iface'];
                  $model->number=Iface::model()->getNextIfaceNumber($model->project->id);
                  $model->iface_id=Version::model()->getNextID($id,12);
                  //$model->file='default.png';
                     
                  if(!empty($_POST['new_type']))
                    {
                   
                        $interfacetype=new Interfacetype;
                        $interfacetype->project_id=$_POST['Iface']['project_id'];
                        $interfacetype->name=$_POST['new_type'];
                        $interfacetype->interfacetype_id=Version::model()->getNextID($id,13);

                        if($interfacetype->save()){
                        $version=Version::model()->getNextNumber($id,13,1,$interface->primaryKey,$interface->interfacetype_id);   
                        $model->type_id=$interface->interfacetype_id; 
                                                    }
                    }
                     
                     
                     
			if($model->save()){
                     $version=Version::model()->getNextNumber($id,12,1,$model->primaryKey,$model->iface_id);   
                   
                
                    	$this->redirect(array('/project/view/id/'.$model->project->id.'/tab/interfaces'));
		   } }

		$this->render('create',array(
			'model'=>$model,'id'=>$id,
		));
	}

        
        

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                $new= new Iface;
		
                $id=$model->project_id;
		if(isset($_POST['Iface']))
		{
		 $new->attributes=$_POST['Iface'];
                 $new->number=$model->number;
                 $new->project_id=$model->project_id;
                 $new->iface_id=$model->iface_id;	
                 if($new->save()){
                      $version=Version::model()->getNextNumber($id,12,2,$new->primaryKey,$new->iface_id);   
                      $this->redirect(array('/usecase/view/id/'.$ucid));
                 }
				
		}

		$this->render('update',array(
			'model'=>$new,'id'=>$new->project_id
		));
	}

	
	public function actionDelete($id,$ucid)
	{
               
            $model=$this->loadModel($id);
            $version=Version::model()->getNextNumber($model->project_id,12,3,$id,$model->iface_id);  
	       if($ucid!=-1) 
               {
               $this->redirect(array('/usecase/view/id/'.$ucid));
               } ELSE {
               $this->redirect(array('/project/view/tab/interfaces/id/'.$ucid));
               }
               
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
