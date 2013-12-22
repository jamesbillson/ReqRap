

<h1>Update Object <?php echo $model->number; ?><?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'id'=>$id)); ?>