<div class="form">
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'contact-form',
        'enableAjaxValidation'=>false,
        'type'=>'horizontal',
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->errorSummary($newCompany); ?>

    <?php echo $form->textFieldRow($model,'firstname',array('size'=>60,'maxlength'=>255)); ?>
    <?php echo $form->textFieldRow($model,'lastname',array('size'=>60,'maxlength'=>255)); ?>
    <?php echo $form->textFieldRow($model,'email',array('size'=>60,'maxlength'=>255)); ?>
    <?php echo $form->textFieldRow($model,'phone',array('size'=>50,'maxlength'=>50)); ?>
    <?php echo $form->textFieldRow($model,'mobile',array('size'=>50,'maxlength'=>50)); ?>

    <?php $foreign_key = isset($model->id)?$model->id:''; ?>
    
    <!-- ADDRESS -->
    <?php $this->renderPartial('/elements/address-quick-form',
                            array('form' => $form,
                            'model'=>$addresses,
                            'foreign_key' => $foreign_key,
                            'no_ajax' => true,
                            'type' => Addresses::TYPE_CONTACT))?>
    
        <?php if(!empty($address)):?>
            <div class="row" style="margin-bottom:20px">
                <?php $this->widget('zii.widgets.CListView', array(
                    'dataProvider'=>$address,
                    'itemView'=>'../elements/_address-item',
                )); ?>
            </div>
        <?php endif ?>

    
    <!-- END ADDRESS -->
<?php $mycompany = User::model()->myCompany()?>
    <!-- COMPANY -->
    <div class="row">
        <?php $dataCompany = CHtml::listData(Company::model()->findAll('type=2 AND companyowner_id='.$mycompany),'id', 'name');
                //print_r($dataCompany);
                ?>
        <?php $dataJson = json_encode(array_values($dataCompany)) ?>
        <?php $dataJson = str_replace("'","\'",$dataJson); ?>

        <label class="control-label" style="margin-right:20px">Company</label>
        <?php $select = isset($newCompany->id)?$newCompany->id:''; ?>
        <?php $this->widget('bootstrap.widgets.TbTypeahead', array(
            'name'=>'Company[name]',
            'options'=>array(
                'source'=>array_values($dataCompany),
                'items'=>10,
                'matcher'=>"js:function(item) {
                    return ~item.toLowerCase().indexOf(this.query.toLowerCase());
                }",
            ),
            'htmlOptions'=>array("class"=>"span3")
        )); ?>
        <div id="newCompany" style="display:none; margin-top:20px">
            <?php  echo $this->renderPartial('/company/_miniform',array('form' => $form,'model'=>$newCompany)) ?>
        </div>
    </div>

    <div class="form-actions">
        <?php $submit = $model->isNewRecord ? 'Create' : 'Save' ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary','label'=>$submit)); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    $(document).ready(function(){
        var data = <?php echo $dataJson ?>;
 
        $( "#Company_name" ).bind( "change", function() {
            var input = $(this).val();

            if($.inArray(input, data) == -1){
                $('#newCompany').parent().addClass('well');
                $('#newCompany').css('display','block');
            } else {
                $('#newCompany').parent().removeClass('well');
                $('#newCompany').css('display','none');
            }
        });

        $('.publish').parent().parent().css({ float: "left",width: "410px"});
        $('.publish').change(function(){
            $('.sttNote').show();
        });

        $('#addDres').click(function(){
            var status = $('.addDres').css('display');
            if(status == 'none'){
                $('.addDres').show();
            } else {
                $('.addDres').hide();
            }
        });

        <?php if(isset($newCompany->name)): ?>
            $('#Company_name').val('<?php echo $newCompany->name ?>');
        <?php endif ?>
    });
</script>