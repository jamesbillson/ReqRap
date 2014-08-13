<?php
/* @var $this UsesController */
/* @var $model Uses */

$this->breadcrumbs=array(
	'Uses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Uses', 'url'=>array('index')),
	array('label'=>'Manage Uses', 'url'=>array('admin')),
);
?>

<h1>Create Uses</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>