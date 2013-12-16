<div class="control-group">
    <?php echo $form->textAreaRow(
        $comp,
        'description',
        array(
            'width' => '400',
            'height' => '200',
            'labelOptions'=>array('class'=>'control-label','style'=>'margin-right:20px')
        )
    )?>
</div>
<?php echo $form->hiddenField($comp,'companyowner_id',array('value'=>User::model()->myCompany())); ?>
<?php echo $form->hiddenField($comp,'organisationtype',array('value'=>2)) ?>
<?php echo $form->hiddenField($comp,'type',array('value'=>2)) ?>

<?php if($comp->isNewRecord): ?>
    <div class="control-group">
        <?php 
        echo $form->dropDownListRow(
            $comp,
            'trade_id',
            CHtml::listData(Trade::model()->findAll('companyowner_id='.User::model()->myCompany()),'id','name'),
            array(
                'class'=>'controls span3',
                'style'=>'margin-right:20px',
                'labelOptions'=>array('class'=>'control-label','style'=>'margin-right:20px'))
        )?>
    </div>
<?php endif ?>
<?php $contact = new Contact ?>
<?php if(!empty($comp->contact)):?>
    <!-- $listContact =  CHtml::listData($model->contact),'id','name'); -->
    <div class="control-group">
        <?php 
        echo $form->dropDownListRow(
            $model,
            'contact_id',
            CHtml::listData($comp->contact,'id','contactName'),
            array(
                'class'=>'controls span3',
                'style'=>'margin-right:20px',
                'labelOptions'=>array('class'=>'control-label','style'=>'margin-right:20px'))
        )?>
    </div>
<?php else: ?>
    <div class="control-group">
        Add new contact for this company
    </div>
    <div class="control-group">
        <?php echo $form->textFieldRow(
            $contact,
            'firstname',
            array(
                'class'=>'controls span3',
                'style'=>'margin-right:20px',
                'labelOptions'=>array('class'=>'control-label','style'=>'margin-right:20px'),
                'size'=>60,'maxlength'=>255
        ))?>
    </div>
    <div class="control-group">
        <?php echo $form->textFieldRow(
            $contact,
            'lastname',
            array(
                'class'=>'controls span3',
                'style'=>'margin-right:20px',
                'labelOptions'=>array('class'=>'control-label','style'=>'margin-right:20px'),
                'size'=>60,'maxlength'=>255
        ))?>
    </div>
    <div class="control-group">
        <?php echo $form->textFieldRow(
            $contact,
            'email',
            array(
                'class'=>'controls span3',
                'style'=>'margin-right:20px',
                'labelOptions'=>array('class'=>'control-label','style'=>'margin-right:20px'),
                'size'=>60,'maxlength'=>255
        ))?>
    </div>
    <div class="control-group">
        <?php echo $form->textFieldRow(
            $contact,
            'phone',
            array(
                'class'=>'controls span3',
                'style'=>'margin-right:20px',
                'labelOptions'=>array('class'=>'control-label','style'=>'margin-right:20px'),
                'size'=>50,'maxlength'=>50
        ))?>
    </div>
    <div class="control-group">
        <?php echo $form->textFieldRow(
            $contact,
            'mobile',
            array(
                'class'=>'controls span3',
                'style'=>'margin-right:20px',
                'labelOptions'=>array('class'=>'control-label','style'=>'margin-right:20px'),
                'size'=>50,'maxlength'=>50
        ))?>
    </div>
<?php endif ?>
