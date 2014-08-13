<?php
/* @var $this TeststepController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Teststeps',
);

$this->menu=array(
	array('label'=>'Create Teststep', 'url'=>array('create')),
	array('label'=>'Manage Teststep', 'url'=>array('admin')),
);
?>

<h1>Teststeps</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
