


<h3 style="text-align:center;margin-bottom:20px"> Rapid Requirements for Web Developers  </h3>
<div class="row">
    <div class="span1"><h2><i class="icon-large icon-pencil" style="margin-top:10px"></i></h2></div>
    <div class="span3"><h4>Produce better development estimates.</h4></div>
    <div class="span1"><h2><i class="icon-large icon-screenshot" style="margin-top:10px"></i></h2></div>
    <div class="span3"><h4>Get client validation and avoid scope creep.</h4></div>
    <div class="span1"><h2><i class="icon-large icon-check" style="margin-top:15px"></i></h2></div>
    <div class="span3"><h4>Automatically generate test plans</h4></div>
</div>
<br />
<br />
<div class="row">
    <div class="span8">
    <img src="<?php echo Yii::app()->themeManager->baseUrl ?>/bootstrap/img/signup_Image.png" width="570px" alt="Signup Image" />
    <br />
    <br />
    <br />
<h3 style="text-align:center;margin-bottom:30px"> <a href="<?php echo UrlHelper::getPrefixLink('/site/benefits')?>">Find out how -></a> </h3>

    
    </div>
     <div class="form" id="signupForm" style="max-width: 320px">  
         
         <?php
  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'contact-form',
                'enableAjaxValidation'=>false,
        )); ?>
            <?php echo $form->errorSummary($model); ?>
            
            <?php echo $form->textFieldRow($model,'firstname',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->textFieldRow($model,'lastname',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->textFieldRow($model,'email',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->passwordFieldRow($model,'password',array('size'=>60,'maxlength'=>255, 'value' => '')); ?> 
            <?php echo $form->passwordFieldRow($model,'password2',array('size'=>60,'maxlength'=>255, 'value' => '')); ?> 
            
            <div class="row buttons">
                <?php echo CHtml::submitButton('Register for Free ',array('class'=>'btn btn-success','style'=>'margin:10px 0px 0px 20px')); ?>
            </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
    <div class="clearfix"></div>
    
   </div> 
 



