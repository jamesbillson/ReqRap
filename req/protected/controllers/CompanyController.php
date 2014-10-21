<?php

class CompanyController extends Controller
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
				'actions'=>array('Logoupload','mycreate','mycompanies','create','update','mycompany', 'addmeta'),
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
	public function actionView($id) {

        $model = $this->loadModel($id);
        $mycompany = User::model()->myCompany();

		if ($mycompany == $id) {	
	            $this->render('mycompany',array(
				'model'=>$model,
			));
		} else if ($model->companyowner_id == $mycompany) {
	        $this->render('view',array(
				'model'=>$model,
			));
	    } else {
	    	ReportHelper::processError('Company Controller, View Action Error');
	    }
    } 

        
        
	public function actionCreate()
	{
		$model=new Company;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Company']))
		{
			$model->attributes=$_POST['Company'];
                        $model->owner_id=Yii::app()->user->id;
                        $model->type=2;
                        $model->companyowner_id=User::model()->myCompany();
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionmyCreate()
	{
		$model=new Company;
		$user = User::model()->findbyPK(Yii::app()->user->id);
		
		if ($user->active==0)$this->redirect(array('/site/verify'));
		
		if(isset($_POST['Company']))
		{
			$model->attributes=$_POST['Company'];
                        $model->owner_id=Yii::app()->user->id;
                        $model->type=1; // hard code all to be type 1
                        
			if($model->save()){
                            $cid=$model->primaryKey;
                            //need to update the user so they own this company
                        User::model()->setcompanyowner($cid);
                            //setup the trades .

                        Documenttype::model()->preload();
                            
                //$user=User::model()->findbyPK($model->owner_id);
                //$user->admin=1;
                //$user->save();
                            
                            
			$this->redirect(UrlHelper::getPrefixLink('site/index'));
                }}

		$this->render('mycreate',array(
			'model'=>$model,
		));
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
	$id=User::model()->myCompany();	
            $model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Company']))
		{
			$model->attributes=$_POST['Company'];
                        
                        $model->type=1; // hard coded for now
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
		$dataProvider=new CActiveDataProvider('Company');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Company('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Company']))
			$model->attributes=$_GET['Company'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

        public function actionMyCompanies()
	{
		$model=new Company('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Company']))
			$model->attributes=$_GET['Company'];

		$this->render('mycompanies',array(
			'model'=>$model,
		));
	}
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Company::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='company-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        	public function actionmyCompany()
	{
		 $id=User::model()->MyCompany();
                    
                    $this->render('mycompany',array(
			'model'=>$this->loadModel($id),
		));
	}
        
    public function actionLogoupload($id) {
    	if (isset($id) && Company::model()->findByPk($id)) {
			Yii::import("ext.EAjaxUpload.qqFileUploader");
			$folder = Yii::getPathOfAlias("webroot") . Yii::app()->params['photo_folder'];
			if (!file_exists($folder)) {
				if (mkdir($folder, 0755, true)) {
				  return false;
				}
			}
			$allowedExtensions = array("jpg", "jpeg", "gif", "png", "PNG", "JPG", "GIF", "JPEG"); //array("jpg","jpeg","gif","exe","mov" and etc...
			$sizeLimit = 2 * 1024 * 1024; // maximum file size in bytes
			$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);

			$result = $uploader->handleUpload($folder);
			if ($result) {
			$project = Yii::App()->session['project'];
			$release = Yii::App()->session['release'];
			$mycompany = User::model()->myCompany();

			$file_name = Utils::uniqueFile($result['filename']);
			$file_name = 'logo'.$mycompany.'-'.$file_name;
			$path = Yii::getPathOfAlias("webroot").Yii::app()->params['photo_folder'];
			rename($path.$result['filename'], $path.$file_name);
			 


			//persist into database
			$model=$this->loadModel($id);
			$model->logo_id = $file_name;

			if ($model->save()) {
			  // Add image to interface
			}
			}
			$return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
			echo $return;
    }
  }

  public function actionAddmeta() {
  	if ( isset($_POST) && isset($_POST['Companymetaform']) ) {
  		$data = $_POST['Companymetaform'];
  		$id   = $data['company_id'];
  		foreach ($data as $key => $meta) {
  			if ( $key != 'company_id') {
  				$companyMeta = Company::model()->findByPk($id);
  				$companyMeta->setEavAttribute($key, $meta);
  				$companyMeta->save();
  			}
  		}
  		if ( !isset($_POST['Companymetaform']['html_output']) ) {
  			$companyMeta = Company::model()->findByPk($id);
  			$companyMeta->setEavAttribute('html_output', 0);
  			$companyMeta->save();
  		}
  	}
  	$this->redirect(UrlHelper::getPrefixLink('company/mycompany'));
  }
}
