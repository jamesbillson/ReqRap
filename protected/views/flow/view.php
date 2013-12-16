<?php
/* @var $this FlowController */
/* @var $model Flow */

$this->breadcrumbs=array(
	'Flows'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List Flow', 'url'=>array('index')),
	array('label'=>'Create Flow', 'url'=>array('create')),
	array('label'=>'Update Flow', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Flow', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Flow', 'url'=>array('admin')),
);
?>

<h1>View Flow #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'Name',
		'usecase_id',
		'main',
		'startstep_id',
		'rejoinstep_id',
	),
)); ?>
