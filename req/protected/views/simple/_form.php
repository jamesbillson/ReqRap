

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categoryproperty-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<?php echo $form->hiddenField($model,'category_id',array('value'=>$category_id)); ?>
		<div class="row">
		<?php
               // $number=  Objectproperty::model()->getNextNumber($category_id);
		// echo $form->hiddenField($model,'number',array('value'=>$number)); ?>
          <?php // echo $number; ?>. 
		
	</div>

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
        'name' => 'Simple[description]',
        'value' => $model->description,
    )
                        );?></div>
<br /><br />

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->