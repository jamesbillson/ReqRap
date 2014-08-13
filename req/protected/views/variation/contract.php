<?php
/* @var $this VariationController */
/* @var $model Variation */

$this->breadcrumbs=array(
	'Variations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Variation', 'url'=>array('index')),
	array('label'=>'Manage Variation', 'url'=>array('admin')),
);
?>

<h1>Create Contract</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'id'=>$id,'contract'=>1)); ?>