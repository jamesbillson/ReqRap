<div class="form">

<?php 
$item=explode('_',$id);


$form=$this->beginWidget('CActiveForm', array(
	'id'=>'actor-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>
        
	<div class="row">
            <?php echo $form->labelEx($model,'text'); ?>
            <?php $this->widget(
                        'bootstrap.widgets.TbRedactorJs',
                        array(
                            'name' => 'Note[text]',
                            'value' => $model->text,
                        )
                        );?>
        </div>
<br /><br />
    	<?php echo $form->hiddenField($model,'meta_type',array('value'=>'analyst')); ?>    
        <?php echo $form->hiddenField($model,'object',array('value'=>$item[1])); ?>
<?php echo $form->hiddenField($model,'instance',array('value'=>$item[2])); ?>
        <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->