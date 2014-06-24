<?php echo $this->renderPartial('/project/head',array('tab'=>'usecases')); ?>
<h1>Create Package</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>