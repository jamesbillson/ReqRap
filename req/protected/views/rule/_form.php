<?php


?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rule-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	 <?php echo $form->hiddenField($model,'project_id',array('value'=>$project)); ?>
	<?php echo $form->errorSummary($model); ?>


	
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60, 'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<div class="row">


	<?php echo $form->labelEx($model,'text'); ?>
		<?php $this->widget(
                'bootstrap.widgets.TbRedactorJs',
                array(
                    'name' => 'Rule[text]',
                    'value' => $model->text,
                )
                        );?>
                            <?php echo $form->error($model,'text'); ?>
<br /><br />
		
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
