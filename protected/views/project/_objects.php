 
<?php 
$data = Object::model()->findAll('project_id='.$model->id);

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Objects',
    'headerIcon' => 'icon-gift',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Object',
        'url'=>'/object/create/id/'.$model->id,
    ),
    
))); 
    if (count($data)):?>

        <table class="table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                     <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):?>
                <tr class="odd">  
                   
                    <td>
                    OB-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?>
                    </td>
                    <td>
                        <?php echo $item['name'];?>
                    </td>
                    <td>
                        <?php echo $item['description'];?>
                    </td>            
                    <td>
                        <a href="/object/view/id/<?php echo $item['id'];?>"><i class="icon-eye-open" rel="tooltip" title="View"></i></a> 
                        <a href="/object/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="/object/delete?id=<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete"></i></a> 
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget(); ?>

