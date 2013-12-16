<?php
/* @var $this DocumentversionController */
/* @var $model Documentversion */

$this->breadcrumbs=array(
	'Documentversions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Documentversion', 'url'=>array('index')),
	array('label'=>'Create Documentversion', 'url'=>array('create')),
	array('label'=>'Update Documentversion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Documentversion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Documentversion', 'url'=>array('admin')),
);
?>

<h1>View Documentversion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'document_id',
		'version',
		'file',
		'modified',
		'modified_date',
	),
)); ?>
