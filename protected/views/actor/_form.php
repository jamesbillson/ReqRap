<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'actor-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'project_id',array('value'=>$id)); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>4, 'class'=>'span8')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
        
        <div class="row">
         Actor inherits:<br />
            <?php  $actors = array();
                  $actors[-1]['name']='None';
                  $actors[-1]['actor_id']='-1';
                  $actors[-1]['inherits']='-1';
                  $actors = $actors + Actor::model()->getProjectActors();
                    //echo "<pre>";
                // print_r($actors);
                 ?>
                       <select name="Actor[inherits]">
                  <?php     
                  foreach($actors as $actor){
                  if ($actor['actor_id']!=$model->actor_id && $actor['inherits']!=$model->actor_id)
                      {
                  
                  echo '<option value="'.$actor['actor_id'].'"';
                  if ($actor['actor_id']==$model->inherits) {
                      echo 'SELECTED';
                  }
                  echo'>'.$actor['name'].'</option>';
                  }  }  
                  ?>
                   <select>
                  
                  <?php //echo $form->dropdownlist($model,'actor_id',$data,array('prompt'=>'None')); ?> 
         </div>          
                        
                      
        
        <div class="row">
		<?php echo $form->labelEx($model,'pretest'); ?>
		<?php echo $form->textArea($model,'pretest',array('rows'=>4, 'class'=>'span8')); ?>
		<?php echo $form->error($model,'pretest'); ?>
	</div>
        	<div class="row">
		<?php echo $form->labelEx($model,'alias'); ?>
		<?php echo $form->textArea($model,'alias',array('rows'=>4, 'class'=>'span8')); ?>
		<?php echo $form->error($model,'alias'); ?>
	</div>
	</div>
        	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',array(0=>'Person',1=>'External System')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
        
        <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->