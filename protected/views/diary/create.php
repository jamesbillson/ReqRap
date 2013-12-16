<h3>Project Diary Entry</h3>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'diary-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->hiddenField($model,'user_id',array('value'=>Yii::app()->user->id)); ?>        
  		    

        <?php 
        
        $company=User::model()->myCompany();
        if($id==-1){ ?>
        <div class="row">
        <?php 
        echo $form->dropDownList(
            $model,
            'project_id',
            CHtml::listData(Project::model()->findAll('company_id='.$company), 'id', 'name'));    
        ?>
            </div>
        <?php
        } ELSE {
            
        echo $form->hiddenField($model,'project_id',array('value'=>$id));    
        }
        
        ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

  
        

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->