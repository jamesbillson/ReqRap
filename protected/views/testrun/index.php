<?php
/* @var $this TestrunController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Testruns',
);

$this->menu=array(
	array('label'=>'Create Testrun', 'url'=>array('create')),
	array('label'=>'Manage Testrun', 'url'=>array('admin')),
);
?>

<h1>Testruns</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
