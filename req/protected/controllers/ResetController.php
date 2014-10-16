<?php

class ResetController extends Controller
{
	public $layout='//layouts/column2';
	public function actionIndex() {
		if ($_POST) {
			$password = @$_POST['password'];
			$email = @$_POST['email'];
			$depassoword = md5($password);
			$user = User::model()->findByAttributes(array('email' => $email));
			wp_set_password( $password, $user->id );
			$sql="UPDATE user
            SET password = '".$depassoword."'
            WHERE `id`=".$user->id;
     		$connection=Yii::app()->db;
        	$command = $connection->createCommand($sql);
        	$command->execute();
			$this->redirect('reset/success');
		}
		$this->render('index',array());
	}

	public function actionSuccess() {
		$this->render('success',array());
	}
}
