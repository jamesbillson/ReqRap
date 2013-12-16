<?php
/* @var $this ProjectstatusController */
/* @var $model Projectstatus */

$this->breadcrumbs=array(
	'Projectstatuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Projectstatus', 'url'=>array('index')),
	array('label'=>'Manage Projectstatus', 'url'=>array('admin')),
);
?>

<h1>Create Projectstatus</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>