<?php
/* @var $this StepController */
/* @var $data Step */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usecase_id')); ?>:</b>
	<?php echo CHtml::encode($data->usecase_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flow')); ?>:</b>
	<?php echo CHtml::encode($data->flow); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number')); ?>:</b>
	<?php echo CHtml::encode($data->number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />


</div>