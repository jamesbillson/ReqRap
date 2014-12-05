<?php

class StepifaceController extends Controller
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
				'actions'=>array('unlink','associate','create','update','createinline','delete'),
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

	
        
	public function actionCreate()
	{
		$model=new Steprule;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Steprule']))
		{
			$model->attributes=$_POST['Steprule'];
                        $model->steprule_id=Version::model()->getNextID(15);
			$model->project_id= Yii::app()->session['project'];
                        $model->release_id=Release::model()->currentRelease($model->project_id);
                        if($model->save())
                        $version=Version::model()->getNextNumber($project->id,1,15,$model->primaryKey,$model->steprule_id);
                      
				$this->redirect(array('view','id'=>$model->step_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        
        
     public function actionAssociate()
	{
	        $project=Yii::App()->session['project'];	
                $model=new Stepiface;

		if(isset($_POST['step_id']))
		{
                $model->stepiface_id=Version::model()->getNextID(15);
		$model->project_id= $project;
                $model->release_id=Release::model()->currentRelease($project);
                $model->step_id=$_POST['step_id'];
                $model->iface_id=$_POST['iface'];
                
                if($model->save()){
                    Version::model()->getNextNumber($project,15,1,$model->primaryKey,$model->stepiface_id);
                $this->redirect(array('/req/iface/view/id/'.$model->iface_id));
                 }
                 
                }
           
        
           
        }
        
        
           public function actionCreateInline()
	{
		$project=Yii::App()->session['project'];
                $model=new Stepiface;
                $model->stepiface_id=Version::model()->getNextID(15);
                $model->project_id= $project;
                $model->release_id=Release::model()->currentRelease($project);
                       
                
		if(isset($_POST['step_id']))
		{
                 $model->step_id=$_POST['step_id'];
   
                    
                            if(!empty($_POST['new_interface']))
                            {

                                 $iface=new Iface;

                                 $iface->number=Iface::model()->getNextIfaceNumber($project);
                                 $iface->iface_id=Version::model()->getNextID(12);
                                 $iface->project_id= $project;
                                 $iface->release_id=Release::model()->currentRelease($project);
                                 $iface->name=$_POST['new_interface'];
                                 $iface->interfacetype_id=Interfacetype::model()->getUnclassified($project);
                                 $iface->project_id=$project;
                                 $iface->save(false);
                                 $version=Version::model()->getNextNumber($project,12,1,$iface->primaryKey,$iface->iface_id);
                                 $model->iface_id=$iface->iface_id;
                            }	
                            else 
                            {
								
                                 $model->iface_id=$_POST['interface'];
                            }
                        
                  $model->save(false);
                  $version=Version::model()->getNextNumber($project,15,1,$model->primaryKey,$model->stepiface_id);
                  /***
				  Code For Handing Ajax Requests
				  */
				  if(Yii::app()->request->isAjaxRequest)
				  {
					 if(!isset($iface)){
						$iface = Iface::model()->findByPk($_POST['ifid']);
					 }
					  $response['status']=1;
					  $response['id']=$model->iface_id;
					  $response['title']=Version::$numberformat[12]['prepend'].'- '.str_pad($iface->interfacetype_id, 2, "0", STR_PAD_LEFT ).str_pad($iface->number, Version::$numberformat[12]['padding'], "0", STR_PAD_LEFT).' '.$iface->name;
					  $response['name']=$iface->name;
					  $response['code']=Version::$numberformat[12]['prepend'].'- '.str_pad($iface->interfacetype_id, 2, "0", STR_PAD_LEFT ).str_pad($iface->number, Version::$numberformat[12]['padding'], "0", STR_PAD_LEFT);
					  $response['xid']= $model->id;
					  echo json_encode($response);
					  die;
					  
				  }
                }
          	  if(Yii::app()->request->isAjaxRequest)
			  {
				  $response['status']=0;
		 		  echo json_encode($response);
		 		  die;
			  }
             $step = Step::model()->with('flow')->findByPk($_POST['step_db_id']);
             
             $this->redirect(array('/step/update/id/'.$step->id.'/flow/'.$step->flow->id));
		
	}
        
        
	
	
                  public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
            $release=Yii::App()->session['release'];
            $project=Yii::App()->session['project'];
		
		if(isset($_POST['Stepiface']))
		{
			$new=new Stepform;
                    
                        $new->attributes=$_POST['Stepiface']; 
                        $new->project_id=$project;
                        $new->release_id=$release;
                        $new->stepiface_id=$model->stepiface_id;
                        if($new->save())
			$version=Version::model()->getNextNumber($project->id,2,15,$model->id,$model->stepiface_id);
                
                        $this->redirect(array('view','id'=>$model->step_id));
                        
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
	
         public function actionUnlink($id,$ucid)
	
        {
            $project=Yii::App()->session['project'];
            $model=Stepiface::model()->findByPK($id);
            $version=Version::model()->getNextNumber($project,15,3,$model->id,$model->stepiface_id);
            $this->redirect(array('/req/usecase/view/id/'.$ucid));
                
	} 

	
        public function actionDelete($id)
	{
             	$project=Yii::App()->session['project'];   
                $model=Stepiface::model()->findbyPK($id);
               
               $step=Step::model()->findByPK(Version::model()->getVersion($model->step_id,9));
               $flow=Step::model()->getStepParentFlowByStepID($step->step_id);
               
               $version=Version::model()->getNextNumber($project,15,3,$model->id,$model->stepiface_id);
    			 if(Yii::app()->request->isAjaxRequest)
				  {
					  die;
				  }
               
$this->redirect(array('/req/step/update/flow/'.$flow['id'].'/id/'.$step['id']));
                
	}
        
        
        
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Stepiface');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Stepiface('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Stepiface']))
			$model->attributes=$_GET['Stepiface'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Stepiface the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Stepiface::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Stepiface $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='stepiface-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
