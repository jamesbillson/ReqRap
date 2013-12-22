<?php
/* @var $this TestresultController */
/* @var $model Testresult */

$this->breadcrumbs=array(
	'Testresults'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Testresult', 'url'=>array('index')),
	array('label'=>'Manage Testresult', 'url'=>array('admin')),
);
?>

<h1>Create Testresult</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>