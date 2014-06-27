<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
   
    
)); 

    $claimtype = array(1=>'stage claims', 2=>'progress claims' ); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<?php

If (User::model()->myCompanyType()==1){
// The user is a BUILDER so we let them choose bid or construction.
?>
         <div class="row">
		What type of project is this?<br />
		<?php echo $form->dropdownlist($model,'stage',Project::$projectstage); ?>
		<?php echo $form->error($model,'stage'); ?>
	</div>	
<?php

} 

If (User::model()->myCompanyType()==3){
// The user is a PM so we specify its a tender.
    ?>
    <div class="row">
		What type of project is this?<br />
		<?php echo $form->dropdownlist($model,'stage',Project::$buildstagecreatepm); ?>
		<?php echo $form->error($model,'stage'); ?>
	</div>	
		
<?php
}
?> 
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	

        
        
       

       
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->