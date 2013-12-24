<?php
/* @var $this TestcaseresultController */
/* @var $model Testcaseresult */

$this->breadcrumbs=array(
	'Testcaseresults'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Testcaseresult', 'url'=>array('index')),
	array('label'=>'Create Testcaseresult', 'url'=>array('create')),
	array('label'=>'Update Testcaseresult', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Testcaseresult', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Testcaseresult', 'url'=>array('admin')),
);
?>

<h1>View Testcaseresult #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'testcase_id',
		'testrun_id',
		'status',
		'modified_date',
		'user_id',
	),
)); ?>
