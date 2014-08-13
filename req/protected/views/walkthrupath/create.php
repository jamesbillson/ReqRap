<?php
/* @var $this TestcaseController */
/* @var $model Testcase */

$this->breadcrumbs=array(
	'Testcases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Testcase', 'url'=>array('index')),
	array('label'=>'Manage Testcase', 'url'=>array('admin')),
);
?>

<h1>Create Testcase</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>