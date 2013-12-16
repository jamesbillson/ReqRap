<?php

class AddressesController extends Controller
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
				'actions'=>array('index','view','dynamicstates','stateoptions','quickAdd'),
				//'roles'=>array('author'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('remove','create','update','admin','delete','dynamicstates'),
				//'roles'=>array('editor'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'roles'=>array('admin'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id,$type)
	{
		$model=new Addresses;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Addresses']))
		{
			$model->attributes=$_POST['Addresses'];
			if($model->save())
			$this->redirect(array('/'.  Addresses::$destination[$model->type].'/id/'.$model->foreign_key));
		}

		$this->render('create',array(
			'model'=>$model,'id'=>$id ,'type'=>$type,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id,$type)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Addresses']))
		{
                    
                    
                    if (isset($_POST['country_id']))
              
              
                        {
                        $model->country_id=$_POST['country_id'];
                        }
                            if (isset($_POST['state_id']))
                        {
			$model->state_id=$_POST['state_id'];
                        
                        } 
                    
                    
                    
			$model->attributes=$_POST['Addresses'];
			if($model->save())
                        $this->redirect(array('/'.Addresses::$destination[$model->type].'/id/'.$model->foreign_key));
		}

		$this->render('update',array(
			'model'=>$model,'type'=>$type,'id'=>$id
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
			$this->redirect(isset($_GET['returnUrl']) ? $_GET['returnUrl'] : array('admin'));
	}
	public function actionRemove($id)
	{
		$model = $this->loadModel($id);
                $fk=$model->foreign_key;
                $type=$model->type;
                $model->delete();
              	$this->redirect(array('/'.Addresses::$destination[$type].'/id/'.$fk));
		
         }
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Addresses');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Addresses('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Addresses']))
			$model->attributes=$_GET['Addresses'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Addresses the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Addresses::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Addresses $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='addresses-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
    public function actionDynamicStates()
	{
    $data=States::model()->findAll('country_id=:country_id', 
					  array(':country_id'=>(int) $_POST['country_id']));
	 
		$data=CHtml::listData($data,'id','name');
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					   array('value'=>$value),CHtml::encode($name),true);
		}
	}
    
    function actionStateOptions(){
        $states = States::model()->findAll("country_id = ".$_GET['country_id'], array('order' => 'name'));
        foreach ($states as $state)
            echo '<option value="'.$state->id.'">'.$state->name.'</option>';
    }
	
    
    
    public function actionQuickAdd(){
        if(isset(Yii::app()->request->isAjaxRequest)){
            if(count($_POST) ){
                $data = $_POST;
                $address = new Addresses;
                $address->attributes = $data;
                if($address->save(false)){
                    $result = array('id'=>$address->id,
                                    'name'=>$address->name,
                                    'address1'=>$address->address1,
                                    'address2'=>$address->address2,
                                    'city'=>$address->city,
                                    'country_id'=>$address->country_id,
                                    'state_id'=>$address->state_id,
                    );
                    echo json_encode($result);
                    Yii::app()->end();
                }else{
                    return false;
                }
            }
            return false;
        }
        return false;
    } 
}
