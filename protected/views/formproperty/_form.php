<?php
/* @var $this ObjectpropertyController */
/* @var $model Objectproperty */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'objectproperty-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<?php echo $form->hiddenField($model,'form_id',array('value'=>$form_id)); ?>
		

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>80)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

        	<div class="row">
		<?php echo $form->labelEx($model,'valid'); ?>
		<?php echo $form->textArea($model,'valid',array('rows'=>6, 'cols'=>80)); ?>
		<?php echo $form->error($model,'valid'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'required'); ?>
		<?php echo $form->checkBox($model,'required'); ?>
		
	</div>
        <div class="row">
		&nbsp;
		
	</div>     
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->