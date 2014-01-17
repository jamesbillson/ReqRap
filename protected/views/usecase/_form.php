<?php
/* @var $this UsecaseController */
/* @var $model Usecase */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usecase-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	  <?php echo $form->hiddenField($model,'package_id',array('value'=>$package_id)); ?>
	<?php echo $form->errorSummary($model); ?>
<div class="row">
		UC-<?php echo $packnum; ?>-<?php echo $number; ?>
		<?php echo $form->hiddenField($model,'number',array('value'=>$number)); ?>
		
        </div>
    
    Select Actor as default.<br />
    or add new Actor on the fly.<br />
    
    <?php 
    /*
    $forms = Form::model()->findAll('project_id='.$model->package->project->id); ?>   
    <select name="form">
    <?php foreach($forms as $form){?>
    <option value="<?php echo $form['id'];?>"><?php echo $form['name'];?></option>
    <?php } 
     * 
     * */?>
     
    </select>
    
    
    
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
        </div>
	
        <div class="row">  
          <?php echo $form->labelEx($model,'description'); ?>
          <?php echo $form->textArea($model,'description'); ?>
          <?php echo $form->error($model,'description'); ?>
      </div>
             <div class="row">  
          <?php echo $form->labelEx($model,'preconditions'); ?>
          <?php echo $form->textArea($model,'preconditions',array('value'=>'None')); ?>
          <?php echo $form->error($model,'preconditions'); ?>
      </div>


        
        
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->