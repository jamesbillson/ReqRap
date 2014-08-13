<?php
/* @var $this StepController */
/* @var $model Step */

$this->breadcrumbs=array(
	'Steps'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Step', 'url'=>array('index')),
	array('label'=>'Manage Step', 'url'=>array('admin')),
);
?>

<h3>Create a Use Case Step</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>