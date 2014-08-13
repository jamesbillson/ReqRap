<?php
/* @var $this RuleusecaseController */
/* @var $data Ruleusecase */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('rule_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->rule_id), array('view', 'id'=>$data->rule_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usecase_id')); ?>:</b>
	<?php echo CHtml::encode($data->usecase_id); ?>
	<br />


</div>