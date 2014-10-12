<?php 
    /*@var:project_id
    @var:company_id
    @var:document_type
    */
?>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'document-form',
        'enableAjaxValidation'=>false,
        'type'=>'horizontal',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
));
$data = Documenttype::model()->findAllByAttributes(array('company_id'=>$project->company->id));
$docType = CHtml::listData($data, 'id', 'name');
?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model,array('class'=>'span3')); ?>
    <?php //echo $form->errorSummary($version,array('class'=>'span3')); ?>
    
    <?php echo $form->textFieldRow($model, 'name', array('class'=>'span3')); ?>
     <?php 
    echo $form->datepickerRow(
            $version,
            'date',
            array(
                'options' => array('language' => 'en'),
                'hint' => 'Select Date.',
                'prepend' => '<i class="icon-calendar"></i>'
            )
        );
    ?>
    
    
    
    <?php echo $form->fileFieldRow($version,'file'); ?>
    <?php echo $form->textAreaRow($model,'description',array('class'=>'span5', 'rows'=>5)); ?>
    
    <?php if(!empty($docType)): ?>
        <?php echo $form->dropDownListRow($model,'document_type',$docType) ?>
    <?php endif ?>
    
    <div class="row">
        <a class="btn pull-left" id="addDocType" style="margin:10px 0px 20px 69px">new Doctype</a>
    </div>
    <div class="addDocType row well" style="display:none">
        <?php 
            $documentType = new Documenttype;
            $this->renderPartial('../elements/documenttype_create_form',
                                array('form' => $form,
                                'model'=>$documentType,
                                'company_id'=>$project->company->id,
                                'no_ajax' => true));
        ?>
    </div>
    <?php 
        echo $form->hiddenField($model,'foreign_key',array('value'=>$project->id));
        echo '<div class="row offset2"><u>Project:</u> <strong>'.$project->name.'</strong></div>';
    ?>

    <div class="form-actions">
        <?php $submit = $model->isNewRecord ? 'Create' : 'Save' ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary','label'=>$submit)); ?>
    </div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#addDocType').click(function(){
            var status = $('.addDocType').css('display');
            if(status == 'none'){
                $(this).text('new Doctype');
                $('#Document_document_type').parent().parent().hide();
                $('.addDocType').show();
            } else {
                $(this).text('new Doctype');
                $('#Document_document_type').parent().parent().show();
                $('.addDocType').hide();
            }
        });
        
        <?php if(empty($docType)): ?>
            $('#addDocType').click();
        <?php endif ?> 
    });
</script>