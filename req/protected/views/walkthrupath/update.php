<?php
/* @var $this TestcaseController */
/* @var $model Testcase */

$this->breadcrumbs=array(
	'Testcases'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Testcase', 'url'=>array('index')),
	array('label'=>'Create Testcase', 'url'=>array('create')),
	array('label'=>'View Testcase', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Testcase', 'url'=>array('admin')),
);
?>

<h1>Update Testcase <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>