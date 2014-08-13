<?php
/* @var $this UsesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Uses',
);

$this->menu=array(
	array('label'=>'Create Uses', 'url'=>array('create')),
	array('label'=>'Manage Uses', 'url'=>array('admin')),
);
?>

<h1>Uses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
