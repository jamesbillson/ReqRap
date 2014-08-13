<?php
/* @var $this RuleusecaseController */
/* @var $model Ruleusecase */

$this->breadcrumbs=array(
	'Ruleusecases'=>array('index'),
	$model->rule_id,
);

$this->menu=array(
	array('label'=>'List Ruleusecase', 'url'=>array('index')),
	array('label'=>'Create Ruleusecase', 'url'=>array('create')),
	array('label'=>'Update Ruleusecase', 'url'=>array('update', 'id'=>$model->rule_id)),
	array('label'=>'Delete Ruleusecase', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->rule_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ruleusecase', 'url'=>array('admin')),
);
?>

<h1>View Ruleusecase #<?php echo $model->rule_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'rule_id',
		'usecase_id',
	),
)); ?>
