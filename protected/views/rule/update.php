<?php
/* @var $this RuleController */
/* @var $model Rule */

$this->breadcrumbs=array(
	'Rules'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Rule', 'url'=>array('index')),
	array('label'=>'Create Rule', 'url'=>array('create')),
	array('label'=>'View Rule', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Rule', 'url'=>array('admin')),
);
?>

<h1>Update Rule BR-<?php echo str_pad($model->number, 3, "0", STR_PAD_LEFT); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'project'=>$project)); ?>