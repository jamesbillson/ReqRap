<?php

class StepformController extends Controller
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
				'actions'=>array('associate','unlink','create','update','createinline','delete'),
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

	        
            
           public function actionAssociate()
	{
	        $project=Yii::App()->session['project'];	
                $model=new Stepform;

		if(isset($_POST['step_id']))
		{
                $model->stepform_id=Version::model()->getNextID(14);
		$model->project_id= $project;
                $model->release_id=Release::model()->currentRelease($project);
                $model->step_id=$_POST['step_id'];
                $model->form_id=$_POST['form_id'];
                //echo "<pre>";
                //print_r($model);
               // echo "</pre>";
                if($model->save()){
                    Version::model()->getNextNumber($project,14,1,$model->primaryKey,$model->stepform_id);
                $this->redirect(('/req/form/view/id/'.$model->form_id));
                 }
                 $error_string='';
                 foreach ($model->getErrors() as $message) 
                     
                     $error_string.=$message[0];
                }
          Yii::app()->user->setFlash('error', ' Something went wrong, all we can report is:<br/> '.$error_string);


          $this->redirect(('/req/site/fail/reason/form_no_save'));
       
           
        }
        
        public function actionCreateInline()
	{
		$project= Yii::app()->session['project'];
                $model=new Stepform;
                $model->stepform_id=Version::model()->getNextID(14);
                $model->project_id=$project;
                $model->release_id=Release::model()->currentRelease($project);
                    
		if(isset($_POST['step_id']))
		{
                 
                 
                 $step=Step::model()->findbyPK($_POST['step_id']);
                 $model->step_id=$step->step_id; 
                 
		 if(!empty($_POST['new_form'])){
                     $form=new Form;
                     
                     $form->number=Form::model()->getNextNumber($project);
                     $form->form_id=Version::model()->getNextID(2);
                     $form->project_id= $project;
                     $form->release_id=Release::model()->currentRelease($project);
                     $form->name=$_POST['new_form'];
                     $form->project_id=$project;
                     $form->save(false);
                     $version=Version::model()->getNextNumber($project,2,1,$form->primaryKey,$form->form_id);
                   
                     $model->form_id=$form->form_id;
                 }	
             else {
                     $model->form_id=$_POST['form'];
                 }
                        
                        $model->save(false);
                        $version=Version::model()->getNextNumber($project,14,1,$model->primaryKey,$model->stepform_id);
                  
                }
                  $step = Step::model()->with('flow')->findByPk($_POST['step_db_id']);
                  $this->redirect(('/req/step/update/id/'.$step->id.'/flow/'.$step->flow->id));
		
	}
        
        public function actionCreate()
	{
		$model=new Stepform;

		
                
		if(isset($_POST['Stepform']))
		{
			$model->attributes=$_POST['Stepform'];
                        $model->steprule_id=Version::model()->getNextID(14);
                        $model->project_id= Yii::app()->session['project'];
                        $model->release_id=Release::model()->currentRelease($model->project_id);
			if($model->save())
                        $version=Version::model()->getNextNumber($project->id,1,14,$model->primaryKey,$model->stepform_id);
                      
				$this->redirect(array('view','id'=>$model->step_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        



        
          public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
            $release=Yii::App()->session['release'];
            $project=Yii::App()->session['project'];
		
		if(isset($_POST['Stepform']))
		{
			$new=new Stepform;
                    
                        $new->attributes=$_POST['Stepform'];
                        $new->stepform_id=$model->stepform_id;
                        $new->project_id=$project;
                        $new->release_id=$release;
                        if($new->save())
			$version=Version::model()->getNextNumber($project->id,2,14,$model->id,$model->stepiface_id);
                
                        $this->redirect(('/req/view','id'=>$model->step_id));
                        
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

        

	 
        public function actionDelete($id)
	{
		  $project_id=Yii::App()->session['project'];
               $model=Stepform::model()->findByPK($id);
               $step=Step::model()->findByPK(Version::model()->getVersion($model->step_id,9));
               $flow=Step::model()->getStepParentFlow($step->id);
               
               $version=Version::model()->getNextNumber($project_id,14,3,$model->id,$model->stepform_id);
     
               
$this->redirect(('/req/step/update/flow/'.$flow['id'].'/id/'.$step['id']));
                
	}
        
      public function actionUnlink($id,$ucid)
	
        {
            $project=Yii::App()->session['project'];
            $model=Stepform::model()->findByPK($id);
            $version=Version::model()->getNextNumber($project,14,3,$model->id,$model->stepform_id);
            $this->redirect(('/req/usecase/view/id/'.$ucid));
                
	}    
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Stepform');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Stepform('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Stepform']))
			$model->attributes=$_GET['Stepform'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Stepform the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Stepform::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Stepform $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='stepform-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
