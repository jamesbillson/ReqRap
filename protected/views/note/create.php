<?php echo $this->renderPartial('/project/head',array('tab'=>'details')); ?>


<h3>Create Note</h3>

<?php $this->renderPartial('_form', array('model'=>$model,'id'=>$id)); ?>