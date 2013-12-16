<?php
/* @var $this ActorusecaseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Actorusecases',
);

$this->menu=array(
	array('label'=>'Create Actorusecase', 'url'=>array('create')),
	array('label'=>'Manage Actorusecase', 'url'=>array('admin')),
);
?>

<h1>Actorusecases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
