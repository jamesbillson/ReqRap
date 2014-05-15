<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>



<div class="well " style="width:300px; margin: 0 auto;">
    <strong>Sign in:</strong>    
    <div class="form">

        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'login-form',
            'type' => 'horizontal',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>
        <div class="row" style="margin-top: 10px;">
            <div class="span1">email: </div>
            <div class="span2">    
                <?php echo $form->textField($model, 'username'); ?>
                <?php echo $form->error($model, 'username'); ?>
            </div>
        </div>

        <div class="row" style="margin-top: 10px;">
            <div class="span1">password: </div>
            <div class="span2">
                <?php
                echo $form->passwordField($model, 'password', array(
                    'hint' => '',
                ));
                ?>
                <?php echo $form->error($model, 'password'); ?>
            </div>
        </div>
        <div class="row"style="margin-top: 10px;"> 
            <div class="span3">
                <?php echo $form->checkBox($model, 'rememberMe'); ?> Remember me on this computer<br />
            </div>
        </div>
        <div class="row" style="margin-top: 15px;">
            <div class="span3">
                
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Forgot Password',
                    'type'=>'primary',
                    'htmlOptions'=>array(
                        'data-toggle'=>'modal',
                        'data-target'=>'#myModal',
                        ),
                    )); 
                ?>
            </div>
        </div>
        <div class="row">
            <div class="span3"></div>
            <div class="span1">	<?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType' => 'submit',
                    'type' => 'primary',
                    'label' => 'Login',
                ));
                ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>

    </div><!-- form -->
</div>
</div>
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Forgot Password</h4>
</div>
 
<div class="modal-body">
    <?php $this->renderPartial("forgot_password",  array('model'=>$model)) ?>
</div>
 
 
<?php $this->endWidget(); ?>
