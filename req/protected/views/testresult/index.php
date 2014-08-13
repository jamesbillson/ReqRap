<?php
/* @var $this TestresultController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Testresults',
);

$this->menu=array(
	array('label'=>'Create Testresult', 'url'=>array('create')),
	array('label'=>'Manage Testresult', 'url'=>array('admin')),
);
?>

<h1>Testresults</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
