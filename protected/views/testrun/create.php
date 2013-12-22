<?php
/* @var $this TestrunController */
/* @var $model Testrun */

$this->breadcrumbs=array(
	'Testruns'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Testrun', 'url'=>array('index')),
	array('label'=>'Manage Testrun', 'url'=>array('admin')),
);
?>

<h1>Create Testrun</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>