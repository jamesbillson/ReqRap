<?php

class FormpropertyController extends Controller
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
				'actions'=>array('preview','create','update','history','delete','rollback','move'),
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

	

	
        public function actionView($id) // Note that this is formproperty_id
	{
             	$versions = Version::model()->getVersions($id,3);
                $model=$this->loadModel($versions[0]['id']);
                $this->render('view',array('model'=>$model,
			'versions'=>$versions
        	));
	}

                public function actionpreView($id) // Note that this is formproperty_id
	{
             	$versions = Version::model()->getVersions($id,3);
                $model=$this->loadModel($versions[0]['id']);
                $this->layout = 'popup';
                $this->render('preview',array('model'=>$model,
			'versions'=>$versions
        	));
	}
        
            public function actionHistory($id) // Note that this is form_id
	{
             	$versions=Version::model()->getVersions($id,3,'form_id');
                $model=$this->loadModel($versions[0]['id']);
                $this->render('history',array('model'=>$model,
			'versions'=>$versions
        	));
	}
          public function actionCreate($id)
	{
	 $project=Yii::app()->session['project'];
                $model=new Formproperty;

		if(isset($_POST['Formproperty']))
		{
                    
		        
                    $model->attributes=$_POST['Formproperty'];
                    $model->project_id= Yii::app()->session['project'];
                    $model->release_id=Release::model()->currentRelease($project);
                    $model->number=Formproperty::model()->getNextNumber($id);
                    $model->formproperty_id=Version::model()->getNextID(3);
                    
                    if($model->save())
                    {
                   
                     $version=Version::model()->getNextNumber($project,3,1,$model->primaryKey,$model->formproperty_id);   
                     $this->redirect(('/req/form/view/id/'.$model->form_id));
		    }
                        
                }
               
                $this->render('create',array(
			'model'=>$model,'form_id'=>$id,
		));
	}
        
        public function actionUpdate($id)
	{
            //  The id should be the formproperty_id rather than the id? 
            
            $model=$this->loadModel($id);
            $new= new Formproperty;
            $release=Yii::App()->session['release'];
            $project=Yii::App()->session['project'];
            
		if(isset($_POST['Formproperty']))
		{
                  	 $new->attributes=$_POST['Formproperty'];
                         $new->number=$model->number;
                         $new->form_id=$model->form_id;
                         $new->release_id=$release;
                         $new->project_id=$project;
                         $new->formproperty_id=$model->formproperty_id;
                         
			if($new->save())
                        {
			$version=Version::model()->getNextNumber($project, 3, 2,$new->primaryKey,$model->formproperty_id);
                       $this->redirect(('/req/form/view/id/'.$model->form_id));
                        
                        }        
		}

		$this->render('update',array(
			'model'=>$model,'form_id'=>$model->form_id
		));
	}


        
        public function actionDelete($id)
	{
	    $project=Yii::App()->session['project'];
            $model=$this->loadModel($id);
            $version=Version::model()->getNextNumber($project,3,3,$id,$model->formproperty_id);  
            $model->save();
            Formproperty::model()->renumber($model->form_id);
            $this->redirect(('/req/form/view/id/'.$model->form_id));
            
            }

        public function actionRollBack($id)
	{
	 $model=$this->loadModel($id);
         $formproperty=$model->formproperty_id;
         Formproperty::model()->rollback($model->formproperty_id, $id);
         $this->redirect(('/req/formproperty/view/id/'.$formproperty));
        }
        
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Formproperty');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

        
              public function actionMove($dir, $id) //down 1, up 2
	{
          
            $model = Formproperty::model()->findByPk($id);
            $oldnum=$model->number;
            $objects=FormProperty::model()->getFormProperty($model->form_id);
            $nextid=0;
            
            if($dir==1){ // DOWN
                    for ($i = 0; $i <= count($objects)-1; $i++) {
                    if ($objects[$i]['number']==$oldnum) $nextid=$objects[$i+1]['id'];
                    }
                } 
 
            if($dir==2){ // UP
                    for ($i = count($objects)-1; $i > 0; $i--) {
                    if ($objects[$i]['number']==$oldnum) $nextid=$objects[$i-1]['id'];
                    }
                } 
                
          $model2 = $this->loadmodel($nextid);
          $model->number = $model2->number;
          $model2->number=$oldnum;
            
          $model->save(false);
          $model2->save(false);
          
          
           
          $this->redirect(('/req/form/view/id/'.$model->form_id));
	
	}
        
        
        
        
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Formproperty('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Formproperty']))
			$model->attributes=$_GET['Formproperty'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Formproperty the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Formproperty::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Formproperty $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='formproperty-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
