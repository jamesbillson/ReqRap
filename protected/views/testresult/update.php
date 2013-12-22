<?php
/* @var $this TestresultController */
/* @var $model Testresult */

$this->breadcrumbs=array(
	'Testresults'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Testresult', 'url'=>array('index')),
	array('label'=>'Create Testresult', 'url'=>array('create')),
	array('label'=>'View Testresult', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Testresult', 'url'=>array('admin')),
);
?>

<h1>Update Testresult <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>