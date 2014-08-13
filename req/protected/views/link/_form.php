<?php
/* @var $this LinkController */
/* @var $model Link */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'link-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->hiddenField($model,'sourcetype',array('value'=>$source)); ?>
        <?php echo $form->hiddenField($model,'source_id',array('value'=>$id)); ?>


Select from Photo, Package, Diary entry, claim, variation, etc.
	<div class="row">
		<?php echo $form->labelEx($model,'targettype'); ?>
		<?php echo $form->textField($model,'targettype'); ?>
		<?php echo $form->error($model,'targettype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'target_id'); ?>
		<?php echo $form->textField($model,'target_id'); ?>
		<?php echo $form->error($model,'target_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->