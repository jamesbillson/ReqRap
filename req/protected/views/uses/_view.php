<?php
/* @var $this UsesController */
/* @var $data Uses */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('uses')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->uses), array('view', 'id'=>$data->uses)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usedby')); ?>:</b>
	<?php echo CHtml::encode($data->usedby); ?>
	<br />


</div>