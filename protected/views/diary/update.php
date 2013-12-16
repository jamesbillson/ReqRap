<?php
/* @var $this DiaryController */
/* @var $model Diary */

$this->breadcrumbs=array(
	'Diaries'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Diary', 'url'=>array('index')),
	array('label'=>'Create Diary', 'url'=>array('create')),
	array('label'=>'View Diary', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Diary', 'url'=>array('admin')),
);
?>

<h1>Update Diary <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>