<?php
/* @var $this ObjectpropertyController */
/* @var $model Objectproperty */

$this->breadcrumbs=array(
	'Objectproperties'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Objectproperty', 'url'=>array('index')),
	array('label'=>'Create Objectproperty', 'url'=>array('create')),
	array('label'=>'View Objectproperty', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Objectproperty', 'url'=>array('admin')),
);
?>

<h1>Update Objectproperty <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>