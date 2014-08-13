<?php
/* @var $this TestrunController */
/* @var $model Testrun */

$this->breadcrumbs=array(
	'Testruns'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Testrun', 'url'=>array('index')),
	array('label'=>'Create Testrun', 'url'=>array('create')),
	array('label'=>'View Testrun', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Testrun', 'url'=>array('admin')),
);
?>

<h1>Update Testrun <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>