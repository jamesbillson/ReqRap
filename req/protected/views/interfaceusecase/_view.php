<?php
/* @var $this InterfaceusecaseController */
/* @var $data Interfaceusecase */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('interface_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->interface_id), array('view', 'id'=>$data->interface_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usecase_id')); ?>:</b>
	<?php echo CHtml::encode($data->usecase_id); ?>
	<br />


</div>