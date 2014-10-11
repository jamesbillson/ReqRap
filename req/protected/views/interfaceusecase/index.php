<?php
/* @var $this InterfaceusecaseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Interfaceusecases',
);

$this->menu=array(
	array('label'=>'Create Interfaceusecase', 'url'=>UrlHelper::getPrefixLink('create')),
	array('label'=>'Manage Interfaceusecase', 'url'=>UrlHelper::getPrefixLink('admin')),
);
?>

<h1>Interfaceusecases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
