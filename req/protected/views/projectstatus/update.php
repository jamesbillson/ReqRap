<?php
/* @var $this ProjectstatusController */
/* @var $model Projectstatus */

$this->breadcrumbs=array(
	'Projectstatuses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Projectstatus', 'url'=>array('index')),
	array('label'=>'Create Projectstatus', 'url'=>array('create')),
	array('label'=>'View Projectstatus', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Projectstatus', 'url'=>array('admin')),
);
?>

<h1>Update Projectstatus <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>