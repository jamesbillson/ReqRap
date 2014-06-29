              <div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'testresult-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($newresult); ?>
	<?php echo $form->hiddenField($newresult,'teststep_id',array('value'=>$teststep_id)); ?>
	
        <div class="row">
	
		<?php echo $form->dropDownList($newresult,'result',  Testresult::$testresult); ?>
	
	</div>

	<div class="row">
		<?php echo $form->labelEx($newresult,'comments'); ?>
		<?php echo $form->textArea($newresult,'comments',array('rows'=>6, 'cols'=>50)); ?>

	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($newresult->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>