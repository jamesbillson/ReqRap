
<h1>Support</h1>

If you need to get in contact with ReqRap,<br />
we are at: <br />
10 Rochester St,<br />
Kew, 3101<br />
Australia<br />
T: +61 (3) 9014 9540<br />
E: info@ReqRap.com<br />
Fax: its not 1985 any more<br />
<br />
<br />



<?php if(Yii::app()->user->hasFlash('contact')): ?>

    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'alerts'=>array('contact'),
    )); ?>

<?php else: ?>

<p>
If you have business inquiries or other questions, please fill out the
following form to contact us. Thank you.
</p>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'contact-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'name'); ?>

    <?php echo $form->textFieldRow($model,'email'); ?>

    <?php echo $form->textFieldRow($model,'subject',array('size'=>60,'maxlength'=>128)); ?>

    <?php echo $form->textAreaRow($model,'body',array('rows'=>6, 'class'=>'span8')); ?>

	<?php /*if(CCaptcha::checkRequirements()): ?>
		<?php echo $form->captchaRow($model,'verifyCode',array(
            'hint'=>'Please enter the letters as they are shown in the image above.<br/>Letters are not case-sensitive.',
        )); ?>
	<?php endif; */?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton',array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Submit',
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php endif ?>