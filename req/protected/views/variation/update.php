<?php
/* @var $this VariationController */
/* @var $model Variation */

$this->breadcrumbs=array(
	'Variations'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Variation', 'url'=>array('index')),
	array('label'=>'Create Variation', 'url'=>array('create')),
	array('label'=>'View Variation', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Variation', 'url'=>array('admin')),
);
?>

<h1>Update Variation <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>