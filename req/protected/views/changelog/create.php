<?php
/* @var $this ChangelogController */
/* @var $model Changelog */

$this->breadcrumbs=array(
	'Changelogs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Changelog', 'url'=>array('index')),
	array('label'=>'Manage Changelog', 'url'=>array('admin')),
);
?>

<h1>Create Changelog</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>