<?php
/* @var $this ContactController */
/* @var $model Contact */

$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	'Create',
);
?>

<h1>Create Contact</h1>

<?php echo $this->renderPartial('_form', compact('model','newCompany','addresses')); ?>