<?php


?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rule-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	 <?php echo $form->hiddenField($model,'project_id',array('value'=>$project)); ?>
	<?php echo $form->errorSummary($model); ?>


	
	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60, 'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
	<div class="row">

		<?php echo $form->labelEx($model,'text'); ?>
    <?php $this->widget('application.extensions.tinymce.ETinyMce',
                        array('model'=>$model,
                              'attribute'=>'text',
                              'editorTemplate'=>'full',
                              'htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'tinymce'),
                               'options' => array(
//                                   'plugins' => 'jbimages,filemanager,save,media',
                                   'mode' =>"textareas",
    'theme_advanced_disable' => "image",
                                   'mceRemoveControl'=>true,
                                   //'cleanup' => false,
                                    'language'=>"en",
                                    'theme_advanced_buttons1'=>"save,filemanager,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                                    'theme_advanced_buttons2'=> "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,jbimages,insertfile,media,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                                    'theme_advanced_buttons3'=>"tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                                    'theme_advanced_buttons4'=>"insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
                                    'theme_advanced_toolbar_location' => 'top',
                                    'theme_advanced_toolbar_align' => 'left',
//                                    'theme_advanced_statusbar_location' => 'bottom',
                                    'theme_advanced_resizing' => true,
                                    'relative_urls' => false,
                                   'media_strict' => true,
                                    'document_base_url' => Yii::app()->getBaseUrl(true),
                                    'theme_advanced_font_sizes' => "10=10pt,11=11pt,12=12pt,13=13pt,14=14pt,15=15pt,16=16pt,17=17pt,18=18pt,19=19pt,20=20pt",
//                                   'extended_valid_elements'=> "iframe[src|class|width|height|name|align]",
                                   'extended_valid_elements' => "iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder]",
                                   ),
                            )); 
?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<style>
  #Rule_text_switch{display:none;}
  </style>