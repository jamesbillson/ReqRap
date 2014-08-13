<?php
/* @var $this RuleusecaseController */
/* @var $model Ruleusecase */

$this->breadcrumbs=array(
	'Ruleusecases'=>array('index'),
	$model->rule_id=>array('view','id'=>$model->rule_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Ruleusecase', 'url'=>array('index')),
	array('label'=>'Create Ruleusecase', 'url'=>array('create')),
	array('label'=>'View Ruleusecase', 'url'=>array('view', 'id'=>$model->rule_id)),
	array('label'=>'Manage Ruleusecase', 'url'=>array('admin')),
);
?>

<h1>Update Ruleusecase <?php echo $model->rule_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>