<?php
/* @var $this ChangelogController */
/* @var $model Changelog */

$this->breadcrumbs=array(
	'Changelogs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Changelog', 'url'=>array('index')),
	array('label'=>'Create Changelog', 'url'=>array('create')),
	array('label'=>'View Changelog', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Changelog', 'url'=>array('admin')),
);
?>

<h1>Update Changelog <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>