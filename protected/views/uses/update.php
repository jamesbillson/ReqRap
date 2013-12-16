<?php
/* @var $this UsesController */
/* @var $model Uses */

$this->breadcrumbs=array(
	'Uses'=>array('index'),
	$model->uses=>array('view','id'=>$model->uses),
	'Update',
);

$this->menu=array(
	array('label'=>'List Uses', 'url'=>array('index')),
	array('label'=>'Create Uses', 'url'=>array('create')),
	array('label'=>'View Uses', 'url'=>array('view', 'id'=>$model->uses)),
	array('label'=>'Manage Uses', 'url'=>array('admin')),
);
?>

<h1>Update Uses <?php echo $model->uses; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>