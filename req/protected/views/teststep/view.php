<?php
/* @var $this TeststepController */
/* @var $model Teststep */

$this->breadcrumbs=array(
	'Teststeps'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Teststep', 'url'=>array('index')),
	array('label'=>'Create Teststep', 'url'=>array('create')),
	array('label'=>'Update Teststep', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Teststep', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Teststep', 'url'=>array('admin')),
);
?>

<h1>View Teststep #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'action',
		'result',
	),
)); ?>
