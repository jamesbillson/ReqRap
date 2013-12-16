<?php
/* @var $this OptionController */
/* @var $data Option */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('option')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->option), array('view', 'id'=>$data->option)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('value')); ?>:</b>
	<?php echo CHtml::encode($data->value); ?>
	<br />


</div>