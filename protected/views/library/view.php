<?php 

$data = Library::model()->findAll();


$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Library Projects',
    'headerIcon' => 'icon-book',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
      
    
));
    if (count($data)): ?>

        <table class="table">
            <thead>
                <tr>
                  
       
                    <th>Name</th>
                 
 
                   
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item): ?>
              
                
                <tr class="odd">  
                    <td>   
                       
                        <?php echo $item['name'];?>
                    </td>
                    <td>   
                       
                        <?php echo $item['description'];?>
                    </td>                
                   
                    <td>
                  
                        <a href="/release/set/id/<?php echo $item['release_id'];?>"><i class="icon-eye-open" rel="tooltip" title="View project"></i></a> 

                       
                        <a href="/release/copy/id/<?php echo $item['release_id'];?>"><i class="icon-flag text-success" rel="tooltip" title="Import this project"></i></a> 
                  
                   </td>
                   <td></td>
                </tr>
                <?php endforeach; ?> 
          </tbody>
        </table>
<?php 
endif;
$this->endWidget(); ?>       