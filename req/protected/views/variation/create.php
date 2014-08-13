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

<h3>Add Variation</h3>

<?php $this->renderPartial('_form', array('model'=>$model,'id'=>$id,'contract'=>0)); ?>