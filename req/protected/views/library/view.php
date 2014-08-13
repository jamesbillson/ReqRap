<?php 


 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;
$data = Library::model()->findAll('public =1');

 
//echo $this->renderPartial('/project/head',array('tab'=>'usecases')); 

 

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Public Library',
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
                       
                        <?php echo $item->name;?>
                    </td>
                    <td>   
                       
                        <?php echo $item['description'];?><br />
                        Created: <?php echo $item->release->create_date;?> contributed by:
                        <?php echo $item->owner->name;?>
                    </td>                
                   
                    <td>
                  
                        <a href="/release/set/id/<?php echo $item['release_id'];?>"><i class="icon-eye-open" rel="tooltip" title="View project"></i></a> 

                       
                        <a href="/release/copy/id/<?php echo $item['release_id'];?>"><i class="icon-flag text-success" rel="tooltip" title="Copy this project to a new project"></i></a> 
             <?php if($edit){ ?>
                        <a href="/release/import/id/<?php echo $item['release_id'];?>"><i class="icon-download text-success" rel="tooltip" title="Import this project into the current project"></i></a> 
                   <?php } ?>  
                 <?php if((User::model()->myCompany())==(Library::model()->libraryOwner($item['id']))){ ?>    
                         <a href="/library/delete/id/<?php echo $item['id'];?>"><i class="icon-unlink text-error" rel="tooltip" title="Remove from library"></i></a> 
   <a href="/library/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit Details"></i></a> 
                  <?php } ?>        
                   </td>
                   <td></td>
                </tr>
                <?php endforeach; ?> 
          </tbody>
        </table>
<?php 
endif;
$this->endWidget(); ?>       

<?php 
$company=User::model()->myCompany();
$data = Library::model()->findAll('public =0 AND owner_id='.$company);


$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Private Library',
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

                       
                        <a href="/release/copy/id/<?php echo $item['release_id'];?>"><i class="icon-flag text-success" rel="tooltip" title="Copy this project to a new project"></i></a> 
               <?php if($edit){ ?>
                        <a href="/release/import/id/<?php echo $item['release_id'];?>"><i class="icon-download text-success" rel="tooltip" title="Import this project into the current project"></i></a> 
              <?php } ?>
                         <?php if((User::model()->myCompany())==(Library::model()->libraryOwner($item['id']))){ ?>    
                         <a href="/library/delete/id/<?php echo $item['id'];?>"><i class="icon-unlink text-error" rel="tooltip" title="Remove from library"></i></a> 
   <a href="/library/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit Details"></i></a> 
      
                 <?php } ?>   
                   </td>
                   <td></td>
                </tr>
                <?php endforeach; ?> 
          </tbody>
        </table>
<?php 
endif;
$this->endWidget(); ?>       