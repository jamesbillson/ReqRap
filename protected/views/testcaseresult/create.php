<?php
/* @var $this TestcaseresultController */
/* @var $model Testcaseresult */

$this->breadcrumbs=array(
	'Testcaseresults'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Testcaseresult', 'url'=>array('index')),
	array('label'=>'Manage Testcaseresult', 'url'=>array('admin')),
);
?>

<h1>Create Testcaseresult</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>