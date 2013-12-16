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
		<?php echo $form->dropdownlist($model,'stage',Project::$buildstagecreatebuilder); ?>
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
	<div class="row">
		<?php echo $form->labelEx($model,'budget'); ?>
		<?php echo $form->textField($model,'budget',array('size'=>10,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'budget'); ?>
	</div>	

        	<div class="row">
		<?php echo $form->labelEx($model,'claimtype'); ?>
		<?php echo $form->dropdownlist($model,'claimtype',$claimtype); ?>
		<?php echo $form->error($model,'claimtype'); ?>
	</div>	
        
        <div class="row">
		<?php echo $form->labelEx($model,'subcontractterms'); ?>
		<?php echo $form->textArea($model,'subcontractterms',array('value'=>'30 Days after end of month of invoice','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'subcontractterms'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'subcontractretention'); ?>
		<?php echo $form->textArea($model,'subcontractretention',array('value'=>'5% held for 45 days','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'subcontractretention'); ?>
	</div>

       
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->