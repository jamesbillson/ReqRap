<?php echo $this->renderPartial('/project/head',array('tab'=>'details')); ?>


<h3>Update Object <?php echo $model->number; ?> <?php echo $model->name; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model,'project_id'=>Yii::app()->session['project'])); ?>