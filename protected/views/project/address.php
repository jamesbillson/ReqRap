<?php
/* @var $this AddressesController */
/* @var $model Addresses */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'addresses-form',
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
		<?php echo $form->labelEx($model,'address1'); ?>
		<?php echo $form->textField($model,'address1',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address2'); ?>
		<?php echo $form->textField($model,'address2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'postcode'); ?>
	</div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'country_id'); ?>
        <?php echo $form->dropDownList($model, 'country_id',CHtml::listData(Countries::model()->findAll(), 'id', 'country'), array('class'=>'span2')); ?>
        <?php echo $form->error($model,'country_id'); ?>
    </div> 
    <div class="row">
        <?php echo $form->labelEx($model,'state_id'); ?>
        <?php echo $form->dropDownList($model, 'state_id', CHtml::listData(States::model()->findAll("country_id=".$model->country_id), 'id', 'name'), array('class'=>'span2')); ?>
        <?php echo $form->error($model,'country_id'); ?>
    </div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
$(document).ready(function(){
    $('#Addresses_country_id').change(function(){
        $('#Addresses_state_id').html('<option>Loading ...</option>');
        $.ajax({
            url: '<?php echo CController::createUrl("/addresses/stateOptions?country_id=")?>' + this.value,
            type: 'GET',
            success: function(response) {
                $('#Addresses_state_id').html(response);
            }
        });
    })
});
</script>