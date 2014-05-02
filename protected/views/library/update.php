<?php 

echo $this->renderPartial('/project/head',array('tab'=>'usecases')); 

?>

<h2>Update Library <?php echo $model->name; ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>