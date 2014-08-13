<?php
/* @var $this RuleusecaseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ruleusecases',
);

$this->menu=array(
	array('label'=>'Create Ruleusecase', 'url'=>array('create')),
	array('label'=>'Manage Ruleusecase', 'url'=>array('admin')),
);
?>

<h1>Ruleusecases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
