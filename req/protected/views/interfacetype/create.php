<?php
/* @var $this InterfacetypeController */
/* @var $model Interfacetype */

$this->breadcrumbs=array(
	'Interfacetypes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Interfacetype', 'url'=>UrlHelper::getPrefixLink('index')),
	array('label'=>'Manage Interfacetype', 'url'=>UrlHelper::getPrefixLink('admin')),
);
?>

<h1>Create Interfacetype</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>