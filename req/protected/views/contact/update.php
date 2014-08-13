<?php
/* @var $this ContactController */
/* @var $model Contact */

$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Contacts', 'url'=>array('mycontacts')),
	array('label'=>'Create New Contact', 'url'=>array('create')),


);
?>

<h1>Update Contact <?php echo $model->firstname." ".$model->lastname; ?></h1>

<?php echo $this->renderPartial('_form', compact('model','newCompany','addresses','address')); ?>