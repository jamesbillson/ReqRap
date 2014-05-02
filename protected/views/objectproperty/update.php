<?php echo $this->renderPartial('/project/head',array('tab'=>'details')); ?>
<h3>Update Property <?php echo $model->name; ?> for <?php echo $object->name; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model,'object'=>$object)); ?>