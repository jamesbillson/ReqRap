<?php
/* @var $this ActorusecaseController */
/* @var $model Actorusecase */

$this->breadcrumbs=array(
	'Actorusecases'=>array('index'),
	$model->actor_id=>array('view','id'=>$model->actor_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Actorusecase', 'url'=>array('index')),
	array('label'=>'Create Actorusecase', 'url'=>array('create')),
	array('label'=>'View Actorusecase', 'url'=>array('view', 'id'=>$model->actor_id)),
	array('label'=>'Manage Actorusecase', 'url'=>array('admin')),
);
?>

<h1>Update Actorusecase <?php echo $model->actor_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>