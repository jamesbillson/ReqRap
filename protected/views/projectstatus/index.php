<?php
/* @var $this ProjectstatusController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Projectstatuses',
);

$this->menu=array(
	array('label'=>'Create Projectstatus', 'url'=>array('create')),
	array('label'=>'Manage Projectstatus', 'url'=>array('admin')),
);
?>

<h1>Projectstatuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
