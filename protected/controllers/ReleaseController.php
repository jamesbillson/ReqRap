<?php

class ReleaseController extends Controller
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
				'actions'=>array('create','update','finalise','copy','set','import'),
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

public function actionSet($id)
	{
        Yii::App()->session['release']=$id;
        $release=Release::model()->findbyPK($id);
        Yii::App()->session['project']=$release->project->id;
         $this->redirect(array('/project/view/tab/usecases/'));
	}
        
public function actionFinalise($id)
	{
	// ID is the release we are finalising.
         
         $project=Yii::App()->session['project'];
         $model= $this->loadModel($id); // This is the current release.
         $oldrelease=$model->id;
         $oldnumber=FLOOR($model->number);
         $model->number=$model->number+1.0001;
         $model->status=1;
         $model->save();
         
         $release=new Release;
         $release->create_user=Yii::app()->user->id;
         $release->project_id=$project;
         $release->number = $oldnumber+1;
         $release->status = 2; 
         $release->save();
         $newrelease=$release->getPrimaryKey();
 
         for ($object = 1; $object <= 18; $object++) 
         {
          // echo 'We are copying '.Version::$objects[$object].'<br />';
          $objects = Version::model()->objectList($object,$oldrelease);

            foreach ($objects as $instance)
            {
            Version::model()->importObject($object,$instance['id'],$project,$newrelease,0,0);
            //   echo 'We are copying id '.$instance['id'].'<br />';
            }
         }
         $model->number=$oldnumber+1.0001;
         $model->offset=Version::model()->getMaxVersionNumber($model->id);
         $model->save();
$release->offset=$model->offset; 
         $release->save();
         // A new release has been created.

         // set project to the new  release.
         Yii::App()->session['release']=$model->id;
         Yii::App()->session['project']=$model->project_id;
         $this->redirect(array('/project/project/'));
        	
	}
        
                 public function actionCopy($id) // id is the db id of the release
	{
$library=  Release::model()->findbyPK($id);	
        // CREATE A NEW PROJECT and a New Release, copy the selected release to this new release.
        
         $model=new Project;
         $model->name='Copy of '.$library->project->name;
         $model->description='Copied from '.$library->project->name.'.';
         $model->company_id = User::model()->myCompany();
         $model->extlink = md5(uniqid(rand(), true));
         if($model->save())
         {
    
                $project=$model->getPrimaryKey();
                Yii::App()->session['project']=$project;
                Release::model()->createInitial($project); 
                $newrelease = Release::model()-> currentRelease();   
                
       	
        //echo 'We are copying from Project id = '.$id.'to Project id='.$project.'<br /><br />'; 
        for ($object = 1; $object <= 18; $object++) 
         {
       // echo 'We are copying '.Version::$objects[$object].'<br />';
        $objects = Version::model()->objectList($object,$id);    
        foreach ($objects as $instance)
            {
            Version::model()->importObject($object,$instance['id'],$project,$newrelease);
           // echo 'We are copying object '.Version::$objects[$object].'
                //     with id '.$instance['id'].' to project '.$project.'<br />';
           }
            
            } // end object loop
         } // end model save
     
            // echo '<a href="/project/myrequirements">projects</a>';
	
        		$this->redirect(array('/project/myrequirements'));
             
	}
        
        
                public function actionImport($id)
	{
        $project=Yii::App()->session['project'];
        $release=Yii::App()->session['release']; 
        
        $offset=  Version::model()->getMaxId($project);//get the max X_id from the existing job, and add this number to all the objects being imported
       
        for ($object = 1; $object <= 18; $object++) 
         {
        $objects = Version::model()->objectList($object,$id);
        if(Version::$number[$object]!='none')
         {
          $numberoffset=Version::model ()->getMaxNumber($object, $release);
         }
        foreach ($objects as $instance)
            {
            Version::model()->importObject($object,$instance['id'],$project,$release,$offset,$numberoffset);
            }
         } 
        Package::model()->Renumber();
        Usecase::model()->Renumber();
        $this->redirect(array('/project/view/tab/usecases'));
        }
        
        
	public function actionCreate()
	{
		$model=new Release;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Release']))
		{
			$model->attributes=$_POST['Release'];
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

		if(isset($_POST['Release']))
		{
			$model->attributes=$_POST['Release'];
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Release');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Release('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Release']))
			$model->attributes=$_GET['Release'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Release the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Release::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Release $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='version-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
