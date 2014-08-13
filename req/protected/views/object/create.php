<?php echo $this->renderPartial('/project/head',array('tab'=>'details')); ?>


<h3>Create Business Object</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>