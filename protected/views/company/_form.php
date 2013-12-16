<?php
/* @var $this CompanyController */
/* @var $model Company */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'company-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>


		<?php echo $form->hiddenField($model,'owner_id',array('value'=>$model->owner_id)); ?>
		<?php echo $form->hiddenField($model,'organisationtype',array('value'=>$model->organisationtype)); ?>
		<?php echo $form->hiddenField($model,'trade_id',array('value'=>$model->trade_id)); ?>
        
<div class="row">
		<?php echo $form->labelEx($model,'foreignid'); ?>
		<?php echo $form->textField($model,'foreignid',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'foreignid'); ?>
	</div>
        
<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropdownlist($model,'type',Company::$companytype); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>		
		

		

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->