<?php
/* @var $this DocumentversionController */
/* @var $model Documentversion */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'contact-form',
        'enableAjaxValidation'=>false,
        'type'=>'horizontal',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>
        <p class="note">Fields with <span class="required">*</span> are required.</p>
            <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldRow($model,'version',array('class'=>'span3','size'=>30,'maxlength'=>30)); ?>
             <?php 
    echo $form->datepickerRow(
            $model,
            'date',
            array(
                'options' => array('language' => 'en'),
                'hint' => 'Select Date.',
                'prepend' => '<i class="icon-calendar"></i>'
            )
        );
    ?>
                <?php echo $form->fileFieldRow($model,'file'); ?>
        <br />
        <input type="checkbox" name="Documentversion['notify']" checked> Send notifications to all project and package followers.
        
        <div class="form-actions">
            <?php $submit = $model->isNewRecord ? 'Create' : 'Save' ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary','label'=>$submit)); ?>
        </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->