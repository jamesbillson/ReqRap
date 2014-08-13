<?php
/* @var $this DocumentversionController */
/* @var $model Documentversion */

$this->breadcrumbs=array(
	'Documentversions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Documentversion', 'url'=>array('index')),
	array('label'=>'Create Documentversion', 'url'=>array('create')),
	array('label'=>'View Documentversion', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Documentversion', 'url'=>array('admin')),
);
?>

<h1>Update Documentversion <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>