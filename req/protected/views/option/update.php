<?php
/* @var $this OptionController */
/* @var $model Option */

$this->breadcrumbs=array(
	'Options'=>array('index'),
	$model->option=>array('view','id'=>$model->option),
	'Update',
);

$this->menu=array(
	array('label'=>'List Option', 'url'=>array('index')),
	array('label'=>'Create Option', 'url'=>array('create')),
	array('label'=>'View Option', 'url'=>array('view', 'id'=>$model->option)),
	array('label'=>'Manage Option', 'url'=>array('admin')),
);
?>

<h1>Update Option <?php echo $model->option; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>