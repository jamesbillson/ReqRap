<?php
/* @var $this TestcaseresultController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Testcaseresults',
);

$this->menu=array(
	array('label'=>'Create Testcaseresult', 'url'=>array('create')),
	array('label'=>'Manage Testcaseresult', 'url'=>array('admin')),
);
?>

<h1>Testcaseresults</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
