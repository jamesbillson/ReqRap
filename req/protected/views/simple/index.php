<?php
/* @var $this ObjectpropertyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Objectproperties',
);

$this->menu=array(
	array('label'=>'Create Objectproperty', 'url'=>array('create')),
	array('label'=>'Manage Objectproperty', 'url'=>array('admin')),
);
?>

<h1>Objectproperties</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
