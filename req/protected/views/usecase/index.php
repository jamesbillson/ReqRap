<?php
/* @var $this UsecaseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usecases',
);

$this->menu=array(
	array('label'=>'Create Usecase', 'url'=>array('create')),
	array('label'=>'Manage Usecase', 'url'=>array('admin')),
);
?>

<h1>Usecases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
