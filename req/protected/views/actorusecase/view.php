<?php
/* @var $this ActorusecaseController */
/* @var $model Actorusecase */

$this->breadcrumbs=array(
	'Actorusecases'=>array('index'),
	$model->actor_id,
);

$this->menu=array(
	array('label'=>'List Actorusecase', 'url'=>array('index')),
	array('label'=>'Create Actorusecase', 'url'=>array('create')),
	array('label'=>'Update Actorusecase', 'url'=>array('update', 'id'=>$model->actor_id)),
	array('label'=>'Delete Actorusecase', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->actor_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Actorusecase', 'url'=>array('admin')),
);
?>

<h1>View Actorusecase #<?php echo $model->actor_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'actor_id',
		'usecase_id',
	),
)); ?>
