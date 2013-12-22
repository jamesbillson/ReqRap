<?php
/* @var $this TeststepController */
/* @var $model Teststep */

$this->breadcrumbs=array(
	'Teststeps'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Teststep', 'url'=>array('index')),
	array('label'=>'Create Teststep', 'url'=>array('create')),
	array('label'=>'View Teststep', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Teststep', 'url'=>array('admin')),
);
?>

<h1>Update Teststep <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>