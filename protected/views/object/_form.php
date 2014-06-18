<?php
/* @var $this ObjectController */
/* @var $model Object */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'object-form',

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
            <?php $this->widget(
                        'bootstrap.widgets.TbRedactorJs',
                        array(
                            'name' => 'Object[description]',
                            'value' => $model->description,
                        )
                        );?>
        </div>
<br /><br />




	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->