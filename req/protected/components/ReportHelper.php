<?php
class ReportHelper {
	public static function processError($message, $url = null) {
		if (User::model()->isDeveloper()) {
			if (is_object($message)) {
				print_r($message);
			}  else {
				echo $message;
			}
	    } else {
	       if ($url == NULL) {
	       	Yii::app()->controller->redirect('/req/site/fail');
		   } else {
		   	Yii::app()->controller->redirect($url);
		   }
	    }
	}
}