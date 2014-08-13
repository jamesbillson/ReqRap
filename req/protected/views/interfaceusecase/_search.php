<?php
/* @var $this InterfaceusecaseController */
/* @var $model Interfaceusecase */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'interface_id'); ?>
		<?php echo $form->textField($model,'interface_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usecase_id'); ?>
		<?php echo $form->textField($model,'usecase_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->