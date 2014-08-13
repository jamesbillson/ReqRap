<?php echo $this->renderPartial('/project/head',array('tab'=>'details')); ?>
 


<h3>Update Rule BR-<?php echo str_pad($model->number, 3, "0", STR_PAD_LEFT); ?></h3>


<?php $this->renderPartial('_form', array('model'=>$model,'project'=>$project)); ?>