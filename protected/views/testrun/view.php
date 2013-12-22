<?php
/* @var $this TestrunController */
/* @var $model Testrun */

$this->breadcrumbs=array(
	'Testruns'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Testrun', 'url'=>array('index')),
	array('label'=>'Create Testrun', 'url'=>array('create')),
	array('label'=>'Update Testrun', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Testrun', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Testrun', 'url'=>array('admin')),
);
?>

<h1>View Testrun #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'teststep_id',
		'status',
	),
)); ?>
