<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usecase-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	 <?php // echo $form->hiddenField($model,'package_id',array('value'=>$package->id)); ?>
	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'number',array('value'=>$number)); ?>

    	<div class="row">
         <?php echo $form->labelEx($model,'actor_id'); ?>
            <?php $actors = Actor::model()->getProjectActors();    
                        $data = array();
                    foreach($actors as $actor)
                                        $data[$actor['actor_id']]=$actor['name'];
                            echo $form->dropdownlist($model,'actor_id',$data,array('prompt'=>'select')); ?> 
                  </div>          
                        
                        
                        
                    
                      
    <br />
     

    
    
    
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
        </div>
	
        <div class="row">  
          <?php echo $form->labelEx($model,'description'); ?>
          <?php echo $form->textArea($model,'description',array('value'=>$description,'rows'=>4, 'class'=>'span8')); ?>
          <?php echo $form->error($model,'description'); ?>
      </div>
             <div class="row">  
          <?php echo $form->labelEx($model,'preconditions'); ?>
          <?php echo $form->textArea($model,'preconditions',array('value'=>'None','rows'=>2, 'class'=>'span8')); ?>
          <?php echo $form->error($model,'preconditions'); ?>
      </div>


        
        
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->