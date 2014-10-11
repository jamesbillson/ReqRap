<?php
/* @var $this FlowController */
/* @var $model Flow */

$this->breadcrumbs=array(
	'Flows'=>array('index'),
	$model->Name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Flow', 'url'=>UrlHelper::getPrefixLink('index')),
	array('label'=>'Create Flow', 'url'=>UrlHelper::getPrefixLink('create')),
	array('label'=>'View Flow', 'url'=>UrlHelper::getPrefixLink('view/?id=').$model->id),
	array('label'=>'Manage Flow', 'url'=>UrlHelper::getPrefixLink('admin')),
);
?>

<h1>Update Flow <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>