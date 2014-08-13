<?php
/* @var $this TestcaseresultController */
/* @var $model Testcaseresult */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'testcaseresult-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'testcase_id'); ?>
		<?php echo $form->textField($model,'testcase_id'); ?>
		<?php echo $form->error($model,'testcase_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'testrun_id'); ?>
		<?php echo $form->textField($model,'testrun_id'); ?>
		<?php echo $form->error($model,'testrun_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified_date'); ?>
		<?php echo $form->textField($model,'modified_date'); ?>
		<?php echo $form->error($model,'modified_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->