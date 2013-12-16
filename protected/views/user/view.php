<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),

);
?>

<h2><?php echo $model->firstname." ".$model->lastname; ?></h2>
If status is invited, show that an email has been sent.<br />
<?php echo $model->email; ?>
<br />
If status is active and this is the current users page show what?