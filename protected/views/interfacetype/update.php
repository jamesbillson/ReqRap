<?php
/* @var $this InterfacetypeController */
/* @var $model Interfacetype */

$this->breadcrumbs=array(
	'Interfacetypes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Interfacetype', 'url'=>array('index')),
	array('label'=>'Create Interfacetype', 'url'=>array('create')),
	array('label'=>'View Interfacetype', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Interfacetype', 'url'=>array('admin')),
);
?>

<h1>Update Interfacetype <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>