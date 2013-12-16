<?php
/* @var $this RuleusecaseController */
/* @var $model Ruleusecase */

$this->breadcrumbs=array(
	'Ruleusecases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ruleusecase', 'url'=>array('index')),
	array('label'=>'Manage Ruleusecase', 'url'=>array('admin')),
);
?>

<h1>Create Ruleusecase</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>