<?php
/* @var $this FlowController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Flows',
);

$this->menu=array(
	array('label'=>'Create Flow', 'url'=>array('create')),
	array('label'=>'Manage Flow', 'url'=>array('admin')),
);
?>

<h1>Flows</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
