<?php
/* @var $this InterfacetypeController */
/* @var $model Interfacetype */

$this->breadcrumbs=array(
	'Interfacetypes'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Interfacetype', 'url'=>array('index')),
	array('label'=>'Create Interfacetype', 'url'=>array('create')),
	array('label'=>'Update Interfacetype', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Interfacetype', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Interfacetype', 'url'=>array('admin')),
);
?>

<h1>View Interfacetype #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
