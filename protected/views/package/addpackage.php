<?php
/* @var $this PackageController */
/* @var $model Package */

$this->breadcrumbs=array(
	'Packages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Package', 'url'=>array('index')),
	array('label'=>'Manage Package', 'url'=>array('admin')),
);
?>

<h1>Add Package</h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'package-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

    	<div class="row">
		<?php echo $form->labelEx($model,'sequence'); ?>
		<?php echo $form->textField($model,'sequence',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'sequence'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

        	<div class="row">
		<?php echo $form->labelEx($model,'budget'); ?>
		<?php echo $form->textField($model,'budget',array('size'=>10,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'budget'); ?>
	</div>
    
        	<?php echo $form->hiddenField($model,'project_id',array('value'=>$id)); ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->