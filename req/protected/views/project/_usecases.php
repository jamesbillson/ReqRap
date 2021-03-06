<?php 

$permission=Yii::App()->session['permission']; 
 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;
$data = Package::model()->getPackages($model->id);


$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Usecases by Package',
    'headerIcon' => 'icon-film',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    
    'headerButtons' => array(
              
     array(
            'class' => 'bootstrap.widgets.TbButton',
            'type' => 'link', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'icon'=> 'calendar',
            'visible'=>$edit,
            'url'=> UrlHelper::getPrefixLink('/usecase/deleted'),
             ),
        /*
      array(
            'class' => 'bootstrap.widgets.TbButton',
            'type'=>'link',
            'icon'=> 'question-sign',
            'url'=>'/help/popview/scope/usecase',
            'htmlOptions' => array('id' => 'popup',),
    ),
          */        
)
    
    
    
    
    
));
    if (count($data)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Package</th>
       
                    <th>Number</th>
                 <th>Name</th>
 
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tbody>
            <?php $pack_counter=0;foreach($data as $item):
              $usecases = Usecase::model()->getPackageUsecases($item['package_id']); // get the requirements with answers
    
             ?>
              
                
                <tr class="odd">  
                    <td colspan="2">   
                        <a href="<?php echo UrlHelper::getPrefixLink('/package/view/id/') ?><?php echo $item['package_id'];?>/tab/details"> PA-<?php echo $item['number'];?></a>
                  
                        <?php echo $item['name'];?>
                    </td>
                
                   
                    <td>
                  <?php if($edit){ ?>
                   <a href="<?php echo UrlHelper::getPrefixLink('/package/update/id/'); ?><?php echo $item['id'];?>"><i class="icon-pencil" rel="tooltip" title="Edit Details"></i></a>
                   
 
                      <?php
                      if(count($usecases)==0){
                            echo CHtml::link(
                            '<i class="icon-remove-sign text-error" rel="tooltip" title="Delete Package"></i>',
                            array('/package/delete','id'=>$item['id']),
                            array('confirm' => 'This will delete the package. Are you sure?')
                            );
                            } ELSE {
                                
                            echo CHtml::link(
                            '<i class="icon-remove-sign text-warning" rel="tooltip" title="Delete not available, package has Use Cases"></i>',
                            array(''),
                            array('confirm' => 'You cannot delete the package while it has Use Cases.')
                            );   
                                
                                
                            }
                        ?>
                   <a href="<?php echo UrlHelper::getPrefixLink('/usecase/create/id/') ?><?php echo $item['id'];?>"><i class="icon-plus-sign-alt" rel="tooltip" title="Add another usecase"></i></a> 
                   <a href="<?php echo UrlHelper::getPrefixLink('/package/history/id/') ?><?php echo $item['package_id'];?>"><i class="icon-calendar" rel="tooltip" title="Version history"></i></a> 
                  
                            <?php if($pack_counter!=0) { ?>
                            <a href="<?php echo UrlHelper::getPrefixLink('/package/move/dir/2/id/') ?><?php echo $item['id'];?>"><i class="icon-arrow-up" rel="tooltip" title="Move Up"></i></a> 
                            <?php } ELSEIF(count($data)>1) {?>   
                           
                            <i class="icon-flag" rel="tooltip" title="Start"></i>
                            <?php } ?>          
                            <?php if($pack_counter!=count($data)-1) { ?>        
                            <a href="<?php echo UrlHelper::getPrefixLink('/package/move/dir/1/id/') ?><?php echo $item['id'];?>"><i class="icon-arrow-down" rel="tooltip" title="Move Down"></i></a> 
                            <?php } ELSEIF(count($data)>1) {?>
                             <i class="icon-flag" rel="tooltip" title="End"></i>   
                            <?php } ?> 
                   
                       
                       
                  <?php } ?>
                   </td>
                   <td></td>
                </tr>
               <?php 
      
        $counter=0;
        foreach($usecases as $uc) : // Go through each un answered question??>

          <tr class="odd">

              <td width="40"></td>
              <td> 
                   <a href="<?php echo UrlHelper::getPrefixLink('/usecase/view/id/') ?><?php echo $uc['usecase_id'];?>"> UC-<?php echo str_pad($uc['packnumber'], 2, "0", STR_PAD_LEFT).''.str_pad($uc['number'], 3, "0", STR_PAD_LEFT); ?></a>
               </td> 
              <td>
                  <b><?php echo $uc['name'];?></b>
                  
                
              </td> 
              <td>
 
                
                  
              <?php if($edit){ ?>
                  <a href="<?php echo UrlHelper::getPrefixLink('/usecase/delete/id/') ?><?php echo $uc['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i> </a>
               <a href="<?php echo UrlHelper::getPrefixLink('/usecase/update/id/') ?><?php echo $uc['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 

               
               
              
               <a href="<?php echo UrlHelper::getPrefixLink('/usecase/history/id/') ?><?php echo $uc['usecase_id'];?>"><i class="icon-calendar" rel="tooltip" title="Version history"></i></a> 
               
               <?php if($counter!=0) { ?>
               <a href="<?php echo UrlHelper::getPrefixLink('/usecase/move/dir/2/id/') ?><?php echo $uc['id'];?>"><i class="icon-arrow-up" rel="tooltip" title="Move Up"></i></a> 
               <?php } ELSEIF(count($usecases)>1) {?>   
               <i class="icon-flag" rel="tooltip" title="Start"></i>
               <?php } ?>           
               <?php if($counter!=count($usecases)-1) { ?>        
               <a href="<?php echo UrlHelper::getPrefixLink('/usecase/move/dir/1/id/') ?><?php echo $uc['id'];?>"><i class="icon-arrow-down" rel="tooltip" title="Move Down"></i></a> 
               <?php } ELSEIF(count($usecases)>1) {?>
               <i class="icon-flag" rel="tooltip" title="End"></i>   
               <?php } ?>  
               <?php } ?> 
               <a href="<?php echo UrlHelper::getPrefixLink('/usecase/clone/id/') ?><?php echo $item['package_id'];?>/usecase/<?php echo $uc['usecase_id'];?>"><i class="icon-pencil" rel="tooltip" title="Clone"></i> </a>
               </td></tr>
         
        <?php  $counter++;
        endforeach ?>       

                
                
            <?php $pack_counter++; endforeach; 
            endif;?>
            
            <?php if($edit){ ?> 
               <tr>
                   <td colspan="4"> 
                     
                       <a href="<?php echo UrlHelper::getPrefixLink('/package/create/') ?>"><i class="icon-plus-sign-alt" rel="tooltip" title="Add another step"></i> Add Package</a> 
                    
                   </td>
               </tr>
             <?php } ?>   
            </tbody>
        </table>
<?php 
$this->endWidget(); ?>  




