<?php
/* @var $this ObjectpropertyController */
/* @var $model Objectproperty */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categoryproperty-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<?php echo $form->hiddenField($model,'category_id',array('value'=>$category_id)); ?>
		<div class="row">
		<?php
                $number=  Objectproperty::model()->getNextNumber($category_id);
		 echo $form->hiddenField($model,'number',array('value'=>$number)); ?>
           Number: <?php echo $number; ?>. 
		
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
    [
        'name' => 'Simple[description]',
        'value' => $model->description,
    ]
                        );?></div>
<br /><br />

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->