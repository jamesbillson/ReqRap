<?php

class UsecaseController extends Controller
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
				'actions'=>array('create','update','delete','move','history'),
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
		$versions=Version::model()->getVersions($id,10);
                $model=$this->loadModel($versions[0]['id']);
                $package=Package::model()->findbyPK(Version::model()->getVersion($model->package_id,5));
       
               // $model = Usecase::model()->with('package')->findByPk($versions[0]['id']);
               // $foo = $bar->foo;
                
                $this->render('view',array('model'=>$model,
			'versions'=>$versions,'package'=>$package
        	));
	}
       public function actionHistory($id) // Note that this is form_id
	{
             	$versions=Version::model()->getVersions($id,10,'usecase_id');
                $model=$this->loadModel($versions[0]['id']);
                $this->render('history',array('model'=>$model,
			'versions'=>$versions
        	));
	} 
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id)
	{
		$model=new Usecase;
  $project=Yii::app()->session['project'];
		
                $number=Usecase::model()->getNextNumber($id);
                $package=Package::model()->findbyPK($id);
               $description=Usecase::$default_description;
		if(isset($_POST['Usecase']))
		{
			$description=$model->description;
                    $model->attributes=$_POST['Usecase'];
                    $model->package_id=$package->package_id;
                    $model->project_id= $project;
                    $model->release_id=Release::model()->currentRelease($project);
                    // set usecase_id
                    $model->usecase_id=Version::model()->getNextID(10);
			if($model->save()){
                        $version=Version::model()->getNextNumber($project,10,1,$model->primaryKey,$model->usecase_id);   
                        $flow=new Flow;
                        $flow->name='Main';
                        $flow->main=1;
                        $flow->startstep_id=0;
                        $flow->rejoinstep_id=0;
                        $flow->usecase_id=$model->usecase_id;
                        $flow->flow_id=Version::model()->getNextID(8);
                        $flow->project_id= $project;
                        $flow->release_id=Release::model()->currentRelease($project);
                        $flow->save(false);
                        $version=Version::model()->getNextNumber($project,8,1,$flow->primaryKey,$flow->flow_id);
                        //make version
                        $step=new Step;
                          $step->flow_id=$flow->flow_id;
                          $step->number=  Step::model()->getNextNumber($id);
                          $step->text='Actor action.';
                          $step->actor_id=$model->actor_id;
                          $step->result='System result.';
                          $step->step_id=Version::model()->getNextID(9);
                          $step->project_id= Yii::app()->session['project'];
                        $step->release_id=Release::model()->currentRelease($project);
                          $step->save(false);
                          // make version
                          $version=Version::model()->getNextNumber($project,9,1,$step->primaryKey,$step->step_id);
			$this->redirect(array('/project/view/tab/usecases/'));
                }}

		$this->render('create',array(
			'model'=>$model,'package'=>$package,'number'=>$number,'description'=>$description
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		                
                
            $release=Yii::App()->session['release'];
            $project=Yii::App()->session['project'];
                $model=$this->loadModel($id);
                //$package=Package::model()->findbyPK($model->package->id);
                $number=$model->number;
               
                $description=$model->description;
                $new= new Usecase;
			
                if(isset($_POST['Usecase']))
		{
                 $new->attributes=$_POST['Usecase'];
                 $description=$new->description;  
		 $new->number=$model->number;
                 $new->package_id=$model->package_id;
                 $new->usecase_id=$model->usecase_id;
                 $new->project_id=$project;
                 $new->release_id=$release;	
                 if($new->save()){
                      $version=Version::model()->getNextNumber($project,10,2,$new->primaryKey,$new->usecase_id);   
                      $this->redirect(array('/usecase/view/id/'.$new->usecase_id));
                 }
				
		}
                
		$this->render('update',array(
			'model'=>$model,'id'=>$id,'number'=>$number,'description'=>$description
                            
		));
	}

        public function actionMove($dir, $id)
	{
		
            // UP
            // load this one, and the next one.
            // 
           // $model=$this->loadModel($id);
            $model = Usecase::model()->findByPk($id);
            $oldnum=$model->number;
            //echo 'moving old number'.$oldnum.'<br />';
            $ucs=Usecase::model()->getPackageUsecases($model->package_id);
            //echo 'getting them for '.$model->package_id.'<br />';
            //echo 'number of results: '.count($ucs);
            //echo '<pre>';
            //print_r($ucs);
            //echo '</pre>'.'<br />';
          
            $nextid=0;
            
            if($dir==1){
                    for ($i = 0; $i <= count($ucs)-1; $i++) 
                    {
                  //     echo 'going up'.$i.'<br />';
                    if ($ucs[$i]['number']==$oldnum) $nextid=$ucs[$i+1]['id'];
                    }
                } 
          // echo '$nextid down ='.$nextid.'<br />';
            if($dir==2){
                    for ($i = count($ucs)-1; $i > 0; $i--) 
                    {
                 //      echo 'going down'.$i.'<br />';
                    if ($ucs[$i]['number']==$oldnum) $nextid=$ucs[$i-1]['id'];
                    }
                } 
                
               //    echo '$nextid up ='.$nextid.'<br />';     
                
      $model2 = $this->loadmodel($nextid);
            
            $model->number = $model2->number;
            $model2->number=$oldnum;
            
          //  echo 'moved to  number'.$model->number.'<br />';
          //  echo 'moved from number'.$model2->number.'<br />';
           $model->save(false);
          $model2->save(false);
           
            
            
            // 
            // get the next one, and make it have this one's number
            // get this one and make it have the old number.
            // save them both
            
          
		$this->redirect(array('/project/view/tab/usecases'));
	
	}
        
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
	
        $project=Yii::app()->session['project'];
        $model = $this->loadModel($id);
        $version=Version::model()->getNextNumber($project,10,3,$model->id,$model->usecase_id);  
	Usecase::model()->Renumber();
      	$this->redirect(array('/project/view/tab/usecases/id/'.$project));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Usecase');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Usecase('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usecase']))
			$model->attributes=$_GET['Usecase'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Usecase the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Usecase::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Usecase $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='usecase-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
