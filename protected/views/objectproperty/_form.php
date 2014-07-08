<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'objectproperty-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<?php echo $form->hiddenField($model,'object_id',array('value'=>$model->object_id)); ?>
        <?php  echo $form->hiddenField($model,'type',array('value'=>$type)); ?>
	<div class="row">
            
	<?php  echo $form->hiddenField($model,'number',array('value'=>$model->number)); ?>
        Number: <?php echo $model->number; ?>
		
	</div>
<?php
if ($type==1) {
$description='Description';
?>
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

 <?php
}
ELSE 
{
    $description='Type of Relationship';
    $objects=Object::model()->getProjectObjects();
?>
    
   <select name="Objectproperty[name]">
    <?php foreach($objects as $object)
        {?>
    <?php if($object['object_id'] != $model->object_id) 
                { ?> 
                   <option class="span4" value="<?php echo $object['object_id'];?>">
                   <?php echo $object['name'];?>
                   </option>
     <?php 
                 }
        } ?>
             </select>
            
<?php
 
}
?>        
	<div class="row">
		<?php echo $description; ?><br>
		<?php echo $form->textArea($model,'description',array('rows'=>3, 'class'=>'span8')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->