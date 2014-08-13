<?php echo $this->renderPartial('/project/head',array('tab'=>'images')); ?>
   <h3> Update Image</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>