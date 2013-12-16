 <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'address-form',
        'enableAjaxValidation'=>false,
        'type'=>'horizontal',
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>

    
    <div class="addDres clearfix well" >
        <?php echo $form->textFieldRow($model, 'name', array('class'=>'span3')); ?>
        <?php echo $form->textFieldRow($model, 'address1', array('class'=>'span3')); ?>
        <?php echo $form->textFieldRow($model, 'address2', array('class'=>'span3')); ?>
        <?php echo $form->textFieldRow($model, 'city', array('class'=>'span3')); ?>
        <?php echo $form->textFieldRow($model, 'postcode', array('class'=>'span3')); ?>
        <div class="control-group ">
            <label class="control-label" for="Addresses_country_id">Country:</label>
            <div class="controls">
                <?php echo $form->dropDownList($model, 'country_id',CHtml::listData(Countries::model()->findAll(), 'id', 'country'), array('class'=>'span2')); ?>
            </div>
        </div> 
        <div class="control-group ">
            <label class="control-label" for="Addresses_state_id">State:</label>
            <div class="controls">
                <?php echo $form->dropDownList($model, 'state_id', array(), array('class'=>'span2')); ?>
            </div>
        </div>  
        
        <input type="hidden" id="Addresses_type" name="Addresses[type]" value="<?php echo $type?>" />
       <?php $fk = $model->isNewRecord ? $id : $model->foreign_key ?>
        <input type="hidden" id="Addresses_type" name="Addresses[foreign_key]" value="<?php echo $fk?>" />
        
           <div class="form-actions">
        <?php $submit = $model->isNewRecord ? 'Create' : 'Save' ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary','label'=>$submit)); ?>
    </div>

    </div>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    //
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
    $('#Addresses_country_id').change();
</script>


<?php
/* @var $this AddressesController */
/* @var $model Addresses */
/* @var $form CActiveForm 
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
</script>*/