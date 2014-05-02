 
<?php 
$permission=(Yii::App()->session['permission']==1)?true : false; 

        
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
        'visible'=> $permission,
        'url'=>'/iface/create/',
    ),
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Upload images',
        'visible'=> $permission,
        'url'=>'/project/photo/id/'.$model->id,
    ),
))); 
?>


  <table class="table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                   <th>Actions</th>
                </tr>
            </thead>

            <tbody>
<?php
$types = Interfacetype::model()->getInterfacetypes();
foreach($types as $type){
$data = Iface::model()->getCategoryIfaces($type['interfacetype_id']);
if (count($data)):?>

                <tr class="odd">  
                    <td colspan="3">   
                    <?php echo $type['name'];?>
                    </td>
                </tr>
      
  

            <?php foreach($data as $item){?>
                <tr class="odd">  
                    <td>   
                       
                        
                     <a href="/iface/view/id/<?php echo $item['iface_id'];?>">
                          
                        IF-<?php echo str_pad($item['typenumber'], 2, "0", STR_PAD_LEFT); ?><?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?>
                   </a>
                    </td>
                    <td>   
                          <?php if(empty($item['file'])){ ?>
                         <i class="icon-picture text-warning" rel="tooltip" title="Incomplete Images"></i>
                        <?php
                          }
                          $uses=Stepiface::model()->getActiveStepifaces($item['itemid']);
                         //echo $uses;
                         if($uses==0){
                        
                             ?>
                        <i class="icon-exclamation-sign text-warning" rel="tooltip" title="Orphan - this Interface is not used."></i>
                         <?php  } ?>
                    <?php echo $item['name'];?>
                        
                       
                   

                  
                    <td>
                          <?php if($permission){ ?>
                        <a href="/iface/update/ucid/-1/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="/iface/delete/ucid/<?php echo $model->id;?>/type/2/id/<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                        <a href="/iface/history/id/<?php echo $item['iface_id'];?>"><i class="icon-calendar" rel="tooltip" title="Version History"></i></a> 
                          <?php } ?>
                    </td>
                </tr>
            <?php }
            endif;
                    }?>
            </tbody>
        </table>

    <?php $this->endWidget(); ?>

  <?php if($permission){ ?>
<?php $deleted = Version::model()->getProjectDeletedVersions($model->id,12);
if (count($deleted)):?>
    

        
<div class="accordion-group">
        <div class="accordion-heading">

         <a class="accordion-toggle" data-toggle="collapse"
          data-parent="#accordionI" href="#collapseI">
          Show Deleted Versions</a>
           
     </div>
    
     <div id="collapseI" class="accordion-body collapse">
        <div class="accordion-inner">
        <table class="table">
        <tbody>
        <?php foreach($deleted as $item) {?>
           <tr class="odd">  
                <td> <a href="/rule/view/id/<?php echo $item['iface_id'];?>"> 
                IF-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?></a> 
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
<?php  endif; ?>
    <?php } ?>