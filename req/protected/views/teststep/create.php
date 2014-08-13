<?php
/* @var $this TeststepController */
/* @var $model Teststep */

$this->breadcrumbs=array(
	'Teststeps'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Teststep', 'url'=>array('index')),
	array('label'=>'Manage Teststep', 'url'=>array('admin')),
);
?>

<h1>Create Teststep</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>