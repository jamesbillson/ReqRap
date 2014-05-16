
<?php 

$permission=(Yii::App()->session['permission']==1)?true : false; 

$data = Object::model()->getProjectObjects(Yii::app()->session['project']);
$counter=0;

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
         'visible'=> $permission,
        'url'=>'/object/create/id/'.$model->id,
    ),
    
))); 
    if (count($data)):?>

        <table class="table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th></th>
                    <th>Name</th>
                     <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):
                
                ?>
                <tr class="odd">  
                   
                    <td>
                        <a href="/object/view/id/<?php echo $item['object_id'];?>">OB-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?></a>
                    </td>
                    <td>
                        <?php if(Version::model()->objectChildCount(7,$item['object_id'])==0)
                                echo '<i class="icon-exclamation-sign text-warning" rel="tooltip" title="This Object has no Properties."></i>' ?>
                     </td>
                    <td>    
                        <b><?php echo $item['name'];?></b>
                    </td>
                    <td>
                        <?php echo $item['description'];?>
                    </td>            
                    <td>
                         <?php if($permission){ ?>
                        <a href="/object/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="/object/delete?id=<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                        <a href="/object/convert/id/<?php echo $item['object_id'];?>"><i class="icon-list-alt" rel="tooltip" title="Make a Form for this Object"></i></a> 
              
                        <a href="/object/history/id/<?php echo $item['object_id'];?>"><i class="icon-calendar" rel="tooltip" title="Version history"></i></a> 
                        

                            <?php if($counter!=0) { ?>
                            <a href="/version/move/object/6/dir/2/id/<?php echo $item['id'];?>"><i class="icon-arrow-up" rel="tooltip" title="Move Up"></i></a> 
                           
                            <?php } ELSEIF(count($data)>1) {?>   
                           
                            <i class="icon-flag" rel="tooltip" title="Start"></i>
                            <?php } ?>          
                            <?php if($counter!=count($data)-1) { ?>        
                            <a href="/version/move/object/6/dir/1/id/<?php echo $item['id'];?>"><i class="icon-arrow-down" rel="tooltip" title="Move Down"></i></a> 
                            <?php } ELSEIF(count($data)>1) {?>
                             <i class="icon-flag" rel="tooltip" title="End"></i>   
                            <?php } ?> 

                         <?php } ?>
                    </td>
                </tr>
            <?php $counter++; endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget(); ?>
   <?php if($permission){ ?>
<?php $deleted = Version::model()->getProjectDeletedVersions($model->id,6);
if (count($deleted)):?>
    

        
<div class="accordion-group">
        <div class="accordion-heading">

         <a class="accordion-toggle" data-toggle="collapse"
          data-parent="#accordionF" href="#collapseF">
          Show Deleted Versions</a>
           
     </div>
    
     <div id="collapseF" class="accordion-body collapse">
        <div class="accordion-inner">
        <table class="table">
        <tbody>
        <?php foreach($deleted as $item) {?>
           <tr class="odd">  
                <td> <a href="/rule/view/id/<?php echo $item['object_id'];?>"> 
                OI-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?></a> 
                </td>
   
                <td> 
                <?php echo $item['name']; ?>
                </td>
    
           </tr>
        <?php }?>
    	</tbody>
        </table>   
            </div>
        </div>
    </div>
<?php  endif; ?>  <?php } ?>