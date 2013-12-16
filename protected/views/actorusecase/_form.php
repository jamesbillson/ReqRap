<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'actorusecase-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'actor_id'); ?>
            
            <?php 
            $actors = Actor::model()->getCandidateActors($id);
			//print_r($models);
			$data = array();
			foreach ($actors as $actor)
				$data[$actor['id']] = $actor['name'] ;     
			
			echo $form->dropDownList($model, 'actor_id', $data ,array('prompt' => 'Select'));
             ?>
   
     
		<?php echo $form->error($model,'actor_id'); ?>
	</div>

	<div class="row">
	
		<?php echo $form->hiddenField($model,'usecase_id',array('value'=>$id)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->