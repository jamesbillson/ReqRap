<?php
/* @var $this FlowController */
/* @var $model Flow */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usecase_id'); ?>
		<?php echo $form->textField($model,'usecase_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'main'); ?>
		<?php echo $form->textField($model,'main'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'startstep_id'); ?>
		<?php echo $form->textField($model,'startstep_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rejoinstep_id'); ?>
		<?php echo $form->textField($model,'rejoinstep_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->