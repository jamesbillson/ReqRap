 <?php echo $this->renderPartial('/project/head',array('tab'=>'usecases')); 

 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE; 
$packages = Package::model()->getPackages($model->id);
$model_package=Package::model()->findbyPK(Version::model()->getVersion($model->package_id,5));   
   
?>
<h2>Change Package </h2>
<h3>UC-<?php echo str_pad($model_package['number'], 2, "0", STR_PAD_LEFT)
        .str_pad($model->number, 3, "0", STR_PAD_LEFT).
        '-'.$model->name; ?>
</h3>
<?php if($edit){ ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usecase-form',
	'enableAjaxValidation'=>false,
)); ?>

	
	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'usecase_id',array('value'=>$model->usecase_id)); ?>

    	<div class="row">
         <?php echo $form->labelEx($model,'package_id'); ?>
         <?php     
               $select = array();
               foreach($packages as $package)
                      $select[$package['package_id']]=$package['name'];
               echo $form->dropdownlist($model,'package_id',$select,array('prompt'=>'select')); ?> 
               </div>          
                        
                        
                        
                    
                      
    <br />



        
        
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php } ?> 


