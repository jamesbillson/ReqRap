

<?php 
$data = Package::model()->getPackages($model->id);

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Packages',
    'headerIcon' => 'icon-gift',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Package',
            'url'=>'/package/create',
    ),
     array(
        'class' => 'bootstrap.widgets.TbButton',
        'type'=>'link',
        'icon'=> 'question-sign',
         'url'=>'/help/popview/scope/packages',
        'htmlOptions' => array('id' => 'popup',),
    ),
)));
    if (count($data)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Sequence</th>
       
                    <th>Name</th>
                 
 
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):

        
            
            ?>
              
                
                <tr class="odd">  
                    <td>   
                        <a href="/package/view/id/<?php echo $item['package_id'];?>/tab/details"> PA-<?php echo $item['number'];?></a>
                    </td>
 <td>   
                        <?php echo $item['name'];?>
                    </td>
                
                   
                    <td>
                  
                        <a href="/package/update/id/<?php echo $item['id'];?>"><i class="icon-pencil" rel="tooltip" title="Edit Details"></i></a> 

                       
                        <a href="/package/remove?id=<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    <?php elseif(!count($data)):
     
   
  
    ?>
<br /><br />






 <?php    
    
    endif;
 $this->endWidget(); ?>  
