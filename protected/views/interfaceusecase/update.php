<?php
/* @var $this InterfaceusecaseController */
/* @var $model Interfaceusecase */

$this->breadcrumbs=array(
	'Interfaceusecases'=>array('index'),
	$model->interface_id=>array('view','id'=>$model->interface_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Interfaceusecase', 'url'=>array('index')),
	array('label'=>'Create Interfaceusecase', 'url'=>array('create')),
	array('label'=>'View Interfaceusecase', 'url'=>array('view', 'id'=>$model->interface_id)),
	array('label'=>'Manage Interfaceusecase', 'url'=>array('admin')),
);
?>

<h1>Update Interfaceusecase <?php echo $model->interface_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>