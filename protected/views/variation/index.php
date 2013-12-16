<?php
/* @var $this VariationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Variations',
);

$this->menu=array(
	array('label'=>'Create Variation', 'url'=>array('create')),
	array('label'=>'Manage Variation', 'url'=>array('admin')),
);
?>

<h1>Variations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
