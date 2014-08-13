<?php
/* @var $this ActorusecaseController */
/* @var $data Actorusecase */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('actor_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->actor_id), array('view', 'id'=>$data->actor_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usecase_id')); ?>:</b>
	<?php echo CHtml::encode($data->usecase_id); ?>
	<br />


</div>