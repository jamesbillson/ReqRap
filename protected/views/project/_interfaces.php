 
<?php 

$data = Iface::model()->findAll(array('order'=>'type_id ASC, number ASC', 'condition'=>'project_id=:x', 'params'=>array(':x'=>$model->id)));

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Issues',
    'headerIcon' => 'icon-gift',
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
    
))); 
    if (count($data)):?>




        <table class="table">
            <thead>
                <tr>
                    
                    <th>Name</th>
                   
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                        <?php echo $item['number'];?>
                    </td>
                    <td>   
                        <?php echo $item['name'];?>
                    </td>
                    
                   

                  
                    <td>
                        <a href="/interface/view/id/<?php echo $item['id'];?>"><i class="icon-eye-open" rel="tooltip" title="View"></i></a> 
                        <a href="/interface/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="/interface/delete?id=<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete"></i></a> 
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget(); ?>

