<?php echo $this->renderPartial('/project/head',array('tab'=>'details')); ?>
 

<h3>Create Business Rule</h3>

<?php $this->renderPartial('_form', array('model'=>$model,'id'=>$id,'project'=>$project)); ?>