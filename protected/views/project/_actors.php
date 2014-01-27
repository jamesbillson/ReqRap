
<?php 
$data = Actor::model()->findAll('project_id='.$model->id);

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
        'label'=> 'Add Actor',
        'url'=>'/actor/create/id/'.$model->id,
    ),
    
))); 
    if (count($data)):?>

        <table class="table">
            <thead>
                <tr>
                    
                    <th>Name</th>
                    <th>Description</th>
                    <th>Alias</th>
                    <th>Inherits</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                        <a href="/actor/view/id/<?php echo $item['id'];?>">
                            <?php echo $item['name'];?>
                        </a>
                    </td>
                    <td>   
                        <?php echo $item['description'];?>
                    </td>   
                       <td>   
                        <?php echo $item['alias'];?>
                    </td>                  
                    <td>   
                        <?php echo $item['inherits'];?>
                    </td>   
  

                  
                    <td>
                        <a href="/actor/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="/actor/delete/id/<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete"></i></a> 
                     <a href="/actor/history/id/<?php echo $item['id'];?>"><i class="icon-calendar" rel="tooltip" title="Version History"></i></a> 
                    
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget(); ?>

