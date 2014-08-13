<?php
/* @var $this RuleusecaseController */
/* @var $model Ruleusecase */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ruleusecase-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'rule_id'); ?>
		<?php echo $form->textField($model,'rule_id'); ?>
		<?php echo $form->error($model,'rule_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usecase_id'); ?>
		<?php echo $form->textField($model,'usecase_id'); ?>
		<?php echo $form->error($model,'usecase_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->