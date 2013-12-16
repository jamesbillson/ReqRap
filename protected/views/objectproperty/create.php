<?php
/* @var $this ObjectpropertyController */
/* @var $model Objectproperty */

$this->breadcrumbs=array(
	'Objectproperties'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Objectproperty', 'url'=>array('index')),
	array('label'=>'Manage Objectproperty', 'url'=>array('admin')),
);
?>

<h1>Create Objectproperty</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'id'=>$id)); ?>