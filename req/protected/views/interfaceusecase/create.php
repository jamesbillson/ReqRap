<?php
/* @var $this InterfaceusecaseController */
/* @var $model Interfaceusecase */

$this->breadcrumbs=array(
	'Interfaceusecases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Interfaceusecase', 'url'=>UrlHelper::getPrefixLink('index')),
	array('label'=>'Manage Interfaceusecase', 'url'=>UrlHelper::getPrefixLink('admin')),
);
?>

<h1>Create Interfaceusecase</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>