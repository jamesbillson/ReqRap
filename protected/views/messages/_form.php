<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'messages-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textAreaRow($model,'message',array('class'=>'span8','rows'=>5)); ?>

	<?php echo $form->textFieldRow($model,'scope',array('class'=>'span5','maxlength'=>100, 'hint' => 'Example: *.*, controller/view, controller/*')); ?>

	<?php echo $form->textFieldRow($model,'exclude',array('class'=>'span5','maxlength'=>100, 'hint' => 'Example: *.*, controller/view, controller/*')); ?>       
        <div>
	<?php echo $form->textAreaRow($model,'condition',array('rows'=>6, 'cols'=>50, 'class'=>'span8', 'hint' => 'Use php code and always return a boolean value')); ?>
        </div>

	<?php echo $form->dropDownListRow($model,'show_once',array('' => '--', 1 => 'Yes', 0 => 'No'), array('class'=>'span5', 'hint' => 'Is this message to showed once')); ?>
        
        <?php echo $form->dropDownListRow($model,'message_type',array('' => '--', 'success' => 'success', 'info' => 'info', 'warning' => 'warning', 'error' => 'error'), array('class'=>'span5', 'hint' => 'Select type of message')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>