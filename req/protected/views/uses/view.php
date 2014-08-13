<?php
/* @var $this UsesController */
/* @var $model Uses */

$this->breadcrumbs=array(
	'Uses'=>array('index'),
	$model->uses,
);

$this->menu=array(
	array('label'=>'List Uses', 'url'=>array('index')),
	array('label'=>'Create Uses', 'url'=>array('create')),
	array('label'=>'Update Uses', 'url'=>array('update', 'id'=>$model->uses)),
	array('label'=>'Delete Uses', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->uses),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Uses', 'url'=>array('admin')),
);
?>

<h1>View Uses #<?php echo $model->uses; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'uses',
		'usedby',
	),
)); ?>
