<?php

class VersionController extends Controller
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
				'actions'=>array('wiki','create','update','rollback', 'move','link'),
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

        public function actionWiki()
	{
		$this->render('wiki');
	}
        
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Version;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Version']))
		{
			$model->attributes=$_POST['Version'];
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

		if(isset($_POST['Version']))
		{
			$model->attributes=$_POST['Version'];
			if($model->save())
				$this->redirect(('/req/view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

        /*
        	public function actionLink($id)
	{
	        $link =  explode("_", $id);     
               
		$this->redirect(array('/'.Version::$objects[$link[0]].'/view/id/'.$link[1]));
		
	}
*/
        
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : '/req/admin/');
	}

                public function actionLink($link)
	{
	 
        $linkbits=  explode("_", $link);            
        $object=$linkbits[1];
        $release=$linkbits[0];
        $object_id=$linkbits[2];
        $thisrelease=Release::model()->findbyPK($release);
       
        $permissiontoview=0;
           
          $mycompany=User::model()->myCompany();
          if ($thisrelease->project->company_id==$mycompany)$permissiontoview=1;
          $follower=Follower::model()->getProjectFollowerDetails($thisrelease->project->id);
          if(!empty($follower)) $permissiontoview=1;
          if ($permissiontoview==0)$this->redirect(('/req/site/fail/condition/permission_fail'));
          
          Yii::App()->session['release']=$release;
         
          $this->redirect(('/req'.Version::$objects[$object].'/view/id/'.$object_id));
        }
        
                public function actionRollBack($id)
	{
	 $model=Version::model()->findbyPK($id);
         Version::model()->rollback($model->foreign_id, $model->object, $id);
         $url=Version::$display[$model->object]['url'];
         $object_id=$model->foreign_id;
         if (Version::$display[$model->object]['parent'] !='none') $object_id=Version::model()->getParent($model->object, $id);
         $url=str_replace('#', $object_id, $url);
        $this->redirect(('/req/'.$url));
        }
	        public function actionRenumber($object,$id)
	{
	 
                    
                    
                    
                    $model=Version::model()->findbyPK($id);
         Version::model()->rollback($model->foreign_id, $model->object, $id);
         $url=Version::$display[$model->object]['url'];
         $object_id=$model->foreign_id;
         if (Version::$display[$model->object]['parent'] !='none') $object_id=Version::model()->getParent($model->object, $id);
         $url=str_replace('#', $object_id, $url);
        $this->redirect(('/req/'.$url));
        }
        
              public function actionMove($dir, $id, $object) //down 1, up 2
	{
            $object_model= Version::$objects[$object];
            $object_model=ucfirst($object_model);
            $model = $object_model::model()->findbyPK($id);
            $parent=Version::$display[$object]['parent'].'_id';
            $oldnum=$model->number;
            $objects=Version::model()->getChildObjects($model->$parent,$object);
            //$objects=Simple::model()->getCategorySimple($model->category_id);
            
            //echo "<pre>";
            //print_r($objects);
            //echo "</pre>";
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
                
          //$model2 = $this->loadmodel($nextid);
          $model2 = $object_model::model()->findbyPK($nextid);
          $model->number = $model2->number;
          $model2->number=$oldnum;
            
          $model->save(false);
          $model2->save(false);
          
         // get the url to load after operation is done
         $url=Version::$display[$object]['url'];
         
         // get the parent_id based on the display parent 
         $object_id=$model->$parent;
         
         // check if we are displaying an object with a parent and set.
         if (Version::$display[$object]['parent'] !='project') 
             $url=str_replace('#', $object_id, $url);
         // redirect to the url
         $this->redirect(('/req/'.$url));
         
         // $this->redirect(array('/category/view/id/'.$model->category_id));
	
	}
        
	/**
	 * Lists all models.
	 */
	public function actionIndex($id)
	{
            $model=Project::model()->findbyPK(Yii::app()->session['project']);
            $dataProvider=new CActiveDataProvider('Version' ,
                        array('criteria'=>array(
                        'condition'=>'`release`='.$id, 'order'=>'number DESC')));
                
		$this->render('changelog',array(
			'dataProvider'=>$dataProvider,'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Version('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Version']))
			$model->attributes=$_GET['Version'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Version the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Version::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Version $model the model to be validated
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
