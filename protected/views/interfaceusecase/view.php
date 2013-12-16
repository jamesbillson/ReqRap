<?php
/* @var $this InterfaceusecaseController */
/* @var $model Interfaceusecase */

$this->breadcrumbs=array(
	'Interfaceusecases'=>array('index'),
	$model->interface_id,
);

$this->menu=array(
	array('label'=>'List Interfaceusecase', 'url'=>array('index')),
	array('label'=>'Create Interfaceusecase', 'url'=>array('create')),
	array('label'=>'Update Interfaceusecase', 'url'=>array('update', 'id'=>$model->interface_id)),
	array('label'=>'Delete Interfaceusecase', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->interface_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Interfaceusecase', 'url'=>array('admin')),
);
?>

<h1>View Interfaceusecase #<?php echo $model->interface_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'interface_id',
		'usecase_id',
	),
)); ?>
