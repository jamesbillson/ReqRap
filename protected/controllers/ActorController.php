<?php

class ActorController extends Controller
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
				'actions'=>array('diagram','tree','create','update','delete','rollback','history'),
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
	
       public function actionDiagram()
	{
        $this->render('diagram');
	}
	
        public function actionView($id) // Note that this is actor_id not id
	{
            Yii::App()->session['setting_tab']='actors';  	
            $versions=Version::model()->getVersions($id,4);
                $model=$this->loadModel($versions[0]['id']);
                $this->render('view',array('model'=>$model,
			'versions'=>$versions
        	));
	}


        
       	        public function actionHistory($id) // Note that this is form_id
	{
             	$versions=Version::model()->getVersions($id,4,'form_id');
                $model=$this->loadModel($versions[0]['id']);
                $this->render('history',array('model'=>$model,
			'versions'=>$versions
        	));
	} 
        
	  public function actionCreate($id)
	{
	Yii::App()->session['setting_tab']='actors'; 
                $model=new Actor;

		if(isset($_POST['Actor']))
		{
                   

                   $model->project_id= Yii::app()->session['project'];
                   $model->release_id=Release::model()->currentRelease($model->project_id);
                   $model->attributes=$_POST['Actor'];
                   $model->number=Actor::model()->getNextNumber($id);
                   $model->actor_id=Version::model()->getNextID(4);
                   //$model->inherits=-1;
                    
                    if($model->save())
                    {
                     $version=Version::model()->getNextNumber($id,4,1,$model->primaryKey,$model->actor_id);   
                     $this->redirect(array('/project/view/tab/actors/id/'.$id));
		    }
                        
                }
               
                $this->render('create',array(
			'model'=>$model,'id'=>$id,
		));
	}


        
        
        	public function actionUpdate($id)
	{
                   Yii::App()->session['setting_tab']='actors'; 
                $model=$this->loadModel($id);
                $new= new Actor;
             $release=Yii::App()->session['release'];
         //   echo "about to check";
		if(isset($_POST['Actor']))
		{
                  //   echo "CUNT:<pre>";
            // print_r($_POST['Actor']);
            // echo "</pre>";
                         $new->attributes=$_POST['Actor'];
                         //$new->inherits=$_POST['Actor']['inherits'];
                         $new->project_id=$model->project_id;
                         $new->actor_id=$model->actor_id;
                         $new->release_id=$release;
                         $new->number=$model->number;
                         //$new->inherits=$model->inherits;
			if($new->save())
                        {
			$version=Version::model()->getNextNumber($model->project_id, 4, 2,$new->primaryKey,$model->actor_id);
                        $this->redirect(array('/project/view/tab/actors/'));
                        }        
		}

		$this->render('update',array('model'=>$model,'id'=>$model->project_id));
	}
        
        
	    public function actionRollBack($object_id, $versionid)
	{
	$release=Yii::App()->session['release'];
        Version::model()->rollback($object_id,4,$versionid);
        $this->redirect(array('/rules/view/id/'.$object_id));
        }

      
public function actionDelete($id)
	{
		Yii::App()->session['setting_tab']='actors'; 
            $model=$this->loadModel($id);
            
            // Need to test if it is used.  If so cannot delete. 
            // Instead load a 'replace' actor form.
            
            // query to get any active steps that use this actor.
            
            $actor_step=Actor::model()->getActorParentSteps($id);
            // going to need the same for an UC being rolled back to a point where a deleted actor was used.
            $default_actor=Actor::model()->getActorParentDefaultUC($id);
            // also need to check if this is the default actor
            $number=count($actor_step)+count($default_actor);
            if($number==0){
            
            $version=Version::model()->getNextNumber($model->project_id,4,3,$id,$model->actor_id);  
            $model->save();
            $this->redirect(array('/project/view/tab/actors'));
            //echo 'deleted number is '.$number;
            
            //echo  'number steps '.count($actor_step).'number defaults '.count($default_actor);
            
            //break;
            } ELSE {
              $this->redirect(array('/actor/view/id/'.$model->actor_id));
              
            }

            
        }
	
            
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Actor');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


        
	public function actionAdmin()
	{
		$model=new Actor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Actor']))
			$model->attributes=$_GET['Actor'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


        
	public function loadModel($id)
	{
		$model=Actor::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Actor $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='actor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
