<?php
/* @var $this FlowController */
/* @var $model Flow */

$this->breadcrumbs=array(
	'Flows'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Flow', 'url'=>UrlHelper::getPrefixLink('index')),
	array('label'=>'Manage Flow', 'url'=>UrlHelper::getPrefixLink('admin')),
);
?>

<h1>Create Flow</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>