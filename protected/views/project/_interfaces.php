 
<?php 

$data = Iface::model()->findAll(array('order'=>'type_id ASC, number ASC', 'condition'=>'project_id=:x', 'params'=>array(':x'=>$model->id)));

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Interfaces',
    'headerIcon' => 'icon-picture',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Interface',
        'url'=>'/iface/create/uc/-1/id/'.$model->id,
    ),
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Upload images',
        'url'=>'/project/photo/id/'.$model->id,
    ),
))); 
    if (count($data)):?>




        <table class="table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                   <th>Actions</th>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                       
                        
                     <a href="/iface/view/id/<?php echo $item['id'];?>">
                          
                        UI-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?>
                   </a>
                    </td>
                    <td>   
                          <?php if(empty($item['file'])){ ?>
                         <i class="icon-picture text-warning" rel="tooltip" title="Incomplete Images"></i>
                        <?php
                          }
                         if(!count(Stepiface::model()->findAll('iface_id='.$item['id']))){
                        ?>
                        <i class="icon-exclamation-sign text-warning" rel="tooltip" title="Orphan - this Interface is not used."></i>
                         <?php } ?>
                    <?php echo $item['name'];?>
                        
                       
                   

                  
                    <td>
                        <a href="/iface/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="/iface/delete/ucid/<?php echo $model->id;?>/type/2/id/<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete"></i></a> 
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget(); ?>

