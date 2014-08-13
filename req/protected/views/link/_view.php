<?php
/* @var $this LinkController */
/* @var $data Link */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sourcetype')); ?>:</b>
	<?php echo CHtml::encode($data->sourcetype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('source_id')); ?>:</b>
	<?php echo CHtml::encode($data->source_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('targettype')); ?>:</b>
	<?php echo CHtml::encode($data->targettype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('target_id')); ?>:</b>
	<?php echo CHtml::encode($data->target_id); ?>
	<br />


</div>