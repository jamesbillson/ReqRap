<?php 

Yii::App()->session['setting_tab']='settings';
echo $this->renderPartial('/project/head'); ?>


<h1>Update Project Settings</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>