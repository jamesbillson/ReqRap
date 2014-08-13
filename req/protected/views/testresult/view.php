<?php
/* @var $this TestresultController */
/* @var $model Testresult */

$this->breadcrumbs=array(
	'Testresults'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Testresult', 'url'=>array('index')),
	array('label'=>'Create Testresult', 'url'=>array('create')),
	array('label'=>'Update Testresult', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Testresult', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Testresult', 'url'=>array('admin')),
);
?>

<h1>View Testresult #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'teststep_id',
		'user_id',
		'date',
		'result',
		'comments',
	),
)); ?>
