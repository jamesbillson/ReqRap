

<div class="form">
	<div class="row">
		<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		        'id'=>'follower-form',
		        'enableAjaxValidation'=>false,
		        'type'=>'horizontal',
		)); ?>
		
		<?php echo $form->errorSummary($model); ?>
		<?php echo $form->hiddenField($model,'type',array('value'=>$type)); ?>
		<?php echo $form->hiddenField($model,'foreign_key',array('value'=>$fk)); ?>

	    <p>Choose an existing contact:<p>
	 	
                    <?php 
			$followers = Contact::model()->getNonFollowers($fk,$type);
			//print_r($models);
			$data = array();
			foreach ($followers as $follower)
			$data[$follower['id']] = $follower['firstname'] . ' '. $follower['lastname'];     
			echo $form->dropDownListRow($model, 'contact_id', $data ,array('prompt' => 'Select'));?>
   
                    
                    <?php  // user can pick between approver, contributor and tester
	    		//$type = array('3'=>'Contributor','3'=>'Viewer','2'=>'Approver','4'=>'Tester');
	    		
                        echo $form->dropDownListRow($model, 'role', Follower::$type);
                        //$upload = array('0'=>'View Only','1'=>'Document Upload');
                        //echo $form->dropDownListRow($model, 'upload', $upload);
                       ?>


                
	    <div class="form-actions">
	        <?php $submit = $model->isNewRecord ? 'Create' : 'Save' ?>
	        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary','label'=>$submit)); ?>
	    </div>	    

	    <?php $this->endWidget(); ?>
 	</div>
</div>
<!-- form -->
<div class="row">
    <a href="<?php echo UrlHelper::getPrefixLink('contact/create/follow?id=')?><?php echo $fk; ?>">Create contact and invite</a>
</div>



