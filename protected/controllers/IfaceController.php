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
				'actions'=>array('create','update','delete','history'),
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
              
              $project=Yii::app()->session['project'];
                $model= new Iface;
		

		if(isset($_POST['Iface']))
		{
                  $model->attributes=$_POST['Iface'];
                  $model->project_id= Yii::app()->session['project'];
                  $model->release_id=Release::model()->currentRelease($project);
                  $model->number=Iface::model()->getNextIfaceNumber($project);
                  $model->iface_id=Version::model()->getNextID(12);
                  //$model->file='default.png';
                     
                  if(!empty($_POST['new_type']))
                    {
                   
                        $interfacetype=new Interfacetype;
                       
                        $interfacetype->name=$_POST['new_type'];
                        $interfacetype->interfacetype_id=Version::model()->getNextID(13);
                        $interfacetype->project_id= $project;
                        $interfacetype->release_id=Release::model()->currentRelease($project);
                        if($interfacetype->save()){
                        $version=Version::model()->getNextNumber($project,13,1,$interface->primaryKey,$interface->interfacetype_id);   
                        $model->type_id=$interface->interfacetype_id; 
                                                    }
                    }
                     
                     
                     
			if($model->save()){
                     $version=Version::model()->getNextNumber($project,12,1,$model->primaryKey,$model->iface_id);   
                   
                
                    	$this->redirect(array('/project/view/id/'.$project.'/tab/interfaces'));
		   } }

		$this->render('create',array(
			'model'=>$model,'id'=>$id,
		));
	}

        
             public function actionHistory($id) // Note that this is form_id
	{
             	$versions=Version::model()->getVersions($id,12,'iface_id');
                $model=$this->loadModel($versions[0]['id']);
                $this->render('history',array('model'=>$model,
			'versions'=>$versions
        	));
	} 

	public function actionUpdate($ucid,$id)
	{
	    $release=Yii::App()->session['release'];
            $project=Yii::App()->session['project'];	
            $model=$this->loadModel($id);
                $new= new Iface;
		
                $new->name=$model->name;
               
                $new->type_id=$model->type_id;
                $new->number=$model->number;
		if(isset($_POST['Iface']))
		{
		 $new->attributes=$_POST['Iface'];
                 $new->number=$model->number;
                 $new->project_id=$project;
                 $new->iface_id=$model->iface_id;
                 $new->release_id=$release;	
                 if($new->save()){
                      $version=Version::model()->getNextNumber($project,12,2,$new->primaryKey,$new->iface_id);   
                      
                      if($uc=-1){
                           $this->redirect(array('project/view/id/'.$project.'/tab/interfaces')); 
                        }
                      ELSE {
                        $this->redirect(array('/usecase/view/id/'.$uc));  
                          
                      }
                      
                 }
				
		}

		$this->render('update',array(
			'model'=>$new,'id'=>$project
		));
	}

	
	public function actionDelete($id,$ucid)
	{
              $project=Yii::app()->session['project'];   
            $model=$this->loadModel($id);
            $version=Version::model()->getNextNumber($project,12,3,$id,$model->iface_id);  
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
