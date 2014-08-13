<?php 
$project=Project::model()->findByPK($id);
$data=Component::model()->findAll('project_id ='.$id);

?>

<h1>View Project Components</h1>

<?php echo $project->name; ?>

<?php
$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Components',
    'headerIcon' => 'icon-gift',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Component',
        'url'=>'/component/create?id='.$project->id,
    ),
    
))); 
    if (count($data)):?>

        <table class="table">
            <thead>
                <tr>
                    
                    <th>Name</th>
                    
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):
             $children=Boqitem::model()->findAll('element_id='.$item['id']);
                ?>
                <tr class="odd">  
                   
                                        <td>   
                        <?php echo $item['name'];?>
                    </td>
                   

                  
                    <td>
                        <a href="/component/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                       <?php   if (empty($children)){ ?>    
                        <a href="/component/delete?id=<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete"></i></a> 
                   <?php } ?>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget(); ?>
