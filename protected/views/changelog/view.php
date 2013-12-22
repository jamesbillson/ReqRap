<?php
/* @var $this ChangelogController */
/* @var $model Changelog */

$this->breadcrumbs=array(
	'Changelogs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Changelog', 'url'=>array('index')),
	array('label'=>'Create Changelog', 'url'=>array('create')),
	array('label'=>'Update Changelog', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Changelog', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Changelog', 'url'=>array('admin')),
);
?>

<h1>View Changelog #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'project_id',
		'object',
		'action',
		'data',
		'modified_user',
		'modified_date',
	),
)); ?>
