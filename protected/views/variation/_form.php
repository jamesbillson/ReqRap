<?php
/* @var $this VariationController */
/* @var $model Variation */
/* @var $form CActiveForm */
?>

        
        
        
        
        
 <div class="form">       
 <?php       
        $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id' => 'variation-form',
        'type'=> 'vertical',
        'htmlOptions' => array('class' => 'well'), // for inset effect
    )
);
 
echo $form->textFieldRow($model, 'name', array('class' => 'span3'));
echo $form->hiddenField($model, 'project_id',array('value'=>$id));
echo $form->hiddenField($model, 'contract',array('value'=>$contract));
echo $form->dropDownListRow(
            $model,
            'status',
            Variation::$status);

echo $form->textAreaRow(
            $model,
            'description',
            array('class' => 'span4', 'rows' => 5)
        ); 
echo $form->datepickerRow(
            $model,
            'date',
            array(
                'options' => array('language' => 'en'),
                'hint' => 'Select Date.',
                'prepend' => '<i class="icon-calendar"></i>'
            )
        );

$this->widget(
    'bootstrap.widgets.TbButton',
    array('buttonType' => 'submit', 'type'=>'primary','label' => 'Create Variation')
);
 
$this->endWidget();
unset($form);
        
      ?>  
        
        
        
</div><!-- form -->