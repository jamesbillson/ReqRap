<?php
/* @var $this ProjectstatusController */
/* @var $model Projectstatus */

$this->breadcrumbs=array(
	'Projectstatuses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Projectstatus', 'url'=>array('index')),
	array('label'=>'Create Projectstatus', 'url'=>array('create')),
	array('label'=>'Update Projectstatus', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Projectstatus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Projectstatus', 'url'=>array('admin')),
);
?>

<h1>View Projectstatus #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'created',
		'createdby',
		'note',
		'status',
	),
)); ?>
