<?php echo $this->renderPartial('/project/head',array('tab'=>'details')); ?>
 


<h3>Update Interface Type: <?php echo $model->name; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>