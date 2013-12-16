<?php
/* @var $this ObjectpropertyController */
/* @var $model Objectproperty */

$this->breadcrumbs=array(
	'Objectproperties'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Objectproperty', 'url'=>array('index')),
	array('label'=>'Create Objectproperty', 'url'=>array('create')),
	array('label'=>'Update Objectproperty', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Objectproperty', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Objectproperty', 'url'=>array('admin')),
);
?>

<h1>View Objectproperty #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'object_id',
		'name',
		'description',
	),
)); ?>
