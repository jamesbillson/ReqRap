<?php
/* @var $this FlowController */
/* @var $data Flow */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usecase_id')); ?>:</b>
	<?php echo CHtml::encode($data->usecase_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('main')); ?>:</b>
	<?php echo CHtml::encode($data->main); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('startstep_id')); ?>:</b>
	<?php echo CHtml::encode($data->startstep_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rejoinstep_id')); ?>:</b>
	<?php echo CHtml::encode($data->rejoinstep_id); ?>
	<br />


</div>