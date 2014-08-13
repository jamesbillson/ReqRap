<?php
/* @var $this UsesController */
/* @var $model Uses */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'uses'); ?>
		<?php echo $form->textField($model,'uses'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usedby'); ?>
		<?php echo $form->textField($model,'usedby'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->