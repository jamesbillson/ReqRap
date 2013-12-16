<?php
/* @var $this FlowController */
/* @var $model Flow */

$this->breadcrumbs=array(
	'Flows'=>array('index'),
	$model->Name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Flow', 'url'=>array('index')),
	array('label'=>'Create Flow', 'url'=>array('create')),
	array('label'=>'View Flow', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Flow', 'url'=>array('admin')),
);
?>

<h1>Update Flow <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>