<?php
/* @var $this DocumentversionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Documentversions',
);

$this->menu=array(
	array('label'=>'Create Documentversion', 'url'=>array('create')),
	array('label'=>'Manage Documentversion', 'url'=>array('admin')),
);
?>

<h1>Documentversions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
