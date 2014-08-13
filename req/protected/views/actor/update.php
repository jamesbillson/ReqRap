<?php echo $this->renderPartial('/project/head'); ?>
   <h3> Update Actor: <?php echo $model->name; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model,'id'=>$id)); ?>