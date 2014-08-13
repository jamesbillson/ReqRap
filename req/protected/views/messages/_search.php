<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'message',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'scope',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'exclude',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textAreaRow($model,'condition',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

		<?php echo $form->textFieldRow($model,'show_once',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
