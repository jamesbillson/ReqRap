<?php $canToggleTender = isset($canToggleTender)?$canToggleTender:0 ?>

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
   
                    
                    <?php if($canToggleTender==1){ // user can pick between tenderer and follower
	    		$type = array('0'=>'Consultant','1'=>'Tenderer');
	    		echo $form->dropDownListRow($model, 'tenderer', $type);
                          $upload = array('0'=>'View Only','1'=>'Upload');
                echo $form->dropDownListRow($model, 'upload', $upload);
                        
		} ?>

            <?php if($canToggleTender==2){
	    		echo $form->hiddenField($model,'tenderer',array('value'=>1));
                        echo $form->hiddenField($model,'upload',array('value'=>0));
		} ?>
                
	    <div class="form-actions">
	        <?php $submit = $model->isNewRecord ? 'Create' : 'Save' ?>
	        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary','label'=>$submit)); ?>
	    </div>	    

	    <?php $this->endWidget(); ?>
 	</div>
</div>
<!-- form -->
<div class="row">
    <a href="contact/createfollow?id=<?php echo $fk; ?>&type=<?php echo $type; ?>">Create contact and invite</a>
</div>

Need to be able to pick the potential  bidders by company name, contact name or by trade.<br />
<br />
I think two paths 1. choose trade and get suggestions, or try to find a company/contact.<br />
<br />
One search box - if you pick a trade, returns all matching contacts.<br />
If you pick a name, returns all matching contacts and companies.<br />
If you select a contact, I guess the subcontract is with the related company<br />
and the contact is added as the subcontract contact.

