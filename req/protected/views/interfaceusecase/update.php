<?php
/* @var $this InterfaceusecaseController */
/* @var $model Interfaceusecase */

$this->breadcrumbs=array(
	'Interfaceusecases'=>array('index'),
	$model->interface_id=>array('view','id'=>$model->interface_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Interfaceusecase', 'url'=>UrlHelper::getPrefixLink('index')),
	array('label'=>'Create Interfaceusecase', 'url'=>UrlHelper::getPrefixLink('create')),
	array('label'=>'View Interfaceusecase', 'url'=>UrlHelper::getPrefixLink('view/?id=').$model->interface_id),
	array('label'=>'Manage Interfaceusecase', 'url'=>UrlHelper::getPrefixLink('admin')),
);
?>

<h1>Update Interfaceusecase <?php echo $model->interface_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>