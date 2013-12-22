 
<?php 

$data = Form::model()->findAll(array('order'=>'id ASC', 'condition'=>'project_id=:x', 'params'=>array(':x'=>$model->id)));

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Forms',
    'headerIcon' => 'icon-list-alt',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Form',
        'url'=>'/form/create/uc/-1/id/'.$model->id,
    ),
    
))); 
    if (count($data)):?>




        <table class="table">
            <thead>
                <tr>
                    
                    <th>Name</th>
                   
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):
                $fields=  Formproperty::model()->find('form_id='.$item['id']);
                ?>
                
                <tr class="odd">  
                    <td>   
                        UF-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?> 
                    </td>
                    <td>   
                        <?php echo $item['name'];
                        if (count($fields)==0 ){
                        ?>
                        <i class="icon-list-alt text-warning" rel="tooltip" title="Incomplete Form"></i>
                        <?php } 
                          if(!count(Stepform::model()->findAll('form_id='.$item['id']))){
                        ?>
                        <i class="icon-exclamation-sign text-warning" rel="tooltip" title="Orphan - this Form is not used."></i>
                         <?php } ?>
                        
                    </td>
                    
                   

                  
                    <td>
                        <a href="/form/view/id/<?php echo $item['id'];?>"><i class="icon-eye-open" rel="tooltip" title="View"></i></a> 
                        <a href="/form/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="/form/delete/ucid/<?php echo $model->id;?>/type/2/id/<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete"></i></a> 
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget(); ?>

