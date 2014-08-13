<?php
/* @var $this TestcaseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Testcases',
);

$this->menu=array(
	array('label'=>'Create Testcase', 'url'=>array('create')),
	array('label'=>'Manage Testcase', 'url'=>array('admin')),
);
?>

<h1>Testcases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
