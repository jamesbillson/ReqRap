

<h3>My Contacts</h3>


<div class="row">
<div class="span9"></div>
    <div class="span2">
    
        <?php
        
    $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Add a contact',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=>array('contact/create')
));
      ?>  
</div>

</div>
<?php 


 $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$model->myContacts(),
     'filter'=>$model,
    'template'=>"{items}\n{pager}",
    'columns'=>array(
         array('name'=>'lastname',
                'type'=>'raw',
               //'value'=>'$data->firstname." ".$data->lastname',
                'value'=>'CHtml::link($data->firstname." ".$data->lastname,Yii::app()->createUrl("contact/view", array("id"=>$data["id"])))',
                'header'=>'Name'
            ),
         array('name'=>'worksfor',
                'type'=>'raw',
                //'value'=>'$data->worksfor->name',
                'value'=>'CHtml::link($data->worksfor->name,Yii::app()->createUrl("company/view", array("id"=>$data["company_id"])))',
                // 'htmlOptions'=>array('width'=>'40'),
                'header'=>'Company'
            ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
    ),
));  
 
 ?>
 