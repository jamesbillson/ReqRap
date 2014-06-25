<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'messages-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textAreaRow($model,'message',array('class'=>'span8','rows'=>5)); ?>

	<?php echo $form->textFieldRow($model,'scope',array('class'=>'span5','maxlength'=>100, 'hint' => 'Example: *.*, controller/view, controller/*')); ?>

	<?php echo $form->textFieldRow($model,'exclude',array('class'=>'span5','maxlength'=>100, 'hint' => 'Example: *.*, controller/view, controller/*')); ?>

        <?php echo $form->dropDownListRow($model,'type', Messages::getTypes(), array('class'=>'span5', 'hint' => 'Select validation type')); ?>
        
        <div style="display: none;">
	<?php echo $form->textAreaRow($model,'condition',array('rows'=>6, 'cols'=>50, 'class'=>'span8', 'hint' => 'Use php code and always return a boolean value')); ?>
        </div>

	<?php echo $form->dropDownListRow($model,'show_once',array('' => '--', 1 => 'Yes', 0 => 'No'), array('class'=>'span5', 'hint' => 'Is this message to showed once')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(function() {
        
        $('#Messages_type').change(function(e) {
            
            if($(this).val() == 2)
               $('#Messages_condition').parent('div').slideDown('slow');
            else
               $('#Messages_condition').parent('div').slideUp('slow');
        }).trigger('change'); //trigger change
    });
</script>