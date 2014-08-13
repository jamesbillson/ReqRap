<?php
/* @var $this TestcaseresultController */
/* @var $model Testcaseresult */

$this->breadcrumbs=array(
	'Testcaseresults'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Testcaseresult', 'url'=>array('index')),
	array('label'=>'Create Testcaseresult', 'url'=>array('create')),
	array('label'=>'View Testcaseresult', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Testcaseresult', 'url'=>array('admin')),
);
?>

<h1>Update Testcaseresult <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>