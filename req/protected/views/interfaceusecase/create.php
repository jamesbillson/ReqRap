<?php
/* @var $this InterfaceusecaseController */
/* @var $model Interfaceusecase */

$this->breadcrumbs=array(
	'Interfaceusecases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Interfaceusecase', 'url'=>array('index')),
	array('label'=>'Manage Interfaceusecase', 'url'=>array('admin')),
);
?>

<h1>Create Interfaceusecase</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>