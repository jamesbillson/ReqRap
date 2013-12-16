<?php
/* @var $this ActorController */
/* @var $model Actor */

$this->breadcrumbs=array(
	'Actors'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Actor', 'url'=>array('index')),
	array('label'=>'Create Actor', 'url'=>array('create')),
	array('label'=>'View Actor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Actor', 'url'=>array('admin')),
);
?>

<h1>Update Actor <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'id'=>$id)); ?>