<?php
/* @var $this InterfacetypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Interfacetypes',
);

$this->menu=array(
	array('label'=>'Create Interfacetype', 'url'=>array('create')),
	array('label'=>'Manage Interfacetype', 'url'=>array('admin')),
);
?>

<h1>Interfacetypes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
