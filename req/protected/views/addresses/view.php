<?php
/* @var $this AddressesController */
/* @var $model Addresses */

$this->breadcrumbs=array(
	'Addresses'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Addresses', 'url'=>array('index')),
	array('label'=>'Create Addresses', 'url'=>array('create')),
	array('label'=>'Update Addresses', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Addresses', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Addresses', 'url'=>array('admin')),
);
?>

<h1>View Addresses #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'address1',
		'address2',
		'city',
		'postcode',
		'state_id',
		'country_id',
	
	),
)); ?>
