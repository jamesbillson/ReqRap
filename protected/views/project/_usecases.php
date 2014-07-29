<?php 

$permission=Yii::App()->session['permission']; 
 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;
$data = Package::model()->getPackages($model->id);


$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Usecases',
    'headerIcon' => 'icon-film',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
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
            <?php $pack_counter=0;foreach($data as $item): ?>
              
                
                <tr class="odd">  
                    <td colspan="2">   
                        <a href="/package/view/id/<?php echo $item['package_id'];?>/tab/details"> PA-<?php echo $item['number'];?></a>
                  
                        <?php echo $item['name'];?>
                    </td>
                
                   
                    <td>
                  <?php if($edit){ ?>
                   <a href="/package/update/id/<?php echo $item['id'];?>"><i class="icon-pencil" rel="tooltip" title="Edit Details"></i></a>
                   
 
                      <?php
       echo CHtml::link(
    '<i class="icon-remove-sign text-error" rel="tooltip" title="Delete Package"></i>',
     array('/package/delete','id'=>$item['id']),
     array('confirm' => 'This will delete this package and all its usecases.  Are you sure?')
);
    ?>
                   <a href="/usecase/create/id/<?php echo $item['id'];?>"><i class="icon-plus-sign-alt" rel="tooltip" title="Add another usecase"></i></a> 
                   <a href="/package/history/id/<?php echo $item['package_id'];?>"><i class="icon-calendar" rel="tooltip" title="Version history"></i></a> 
                  
                            <?php if($pack_counter!=0) { ?>
                            <a href="/package/move/dir/2/id/<?php echo $item['id'];?>"><i class="icon-arrow-up" rel="tooltip" title="Move Up"></i></a> 
                            <?php } ELSEIF(count($data)>1) {?>   
                           
                            <i class="icon-flag" rel="tooltip" title="Start"></i>
                            <?php } ?>          
                            <?php if($pack_counter!=count($data)-1) { ?>        
                            <a href="/package/move/dir/1/id/<?php echo $item['id'];?>"><i class="icon-arrow-down" rel="tooltip" title="Move Down"></i></a> 
                            <?php } ELSEIF(count($data)>1) {?>
                             <i class="icon-flag" rel="tooltip" title="End"></i>   
                            <?php } ?> 
                   
                       
                       
                  <?php } ?>
                   </td>
                   <td></td>
                </tr>
               <?php 
        $usecases = Usecase::model()->getPackageUsecases($item['package_id']); // get the requirements with answers
 
        $counter=0;
        foreach($usecases as $uc) : // Go through each un answered question??>

          <tr class="odd">

              <td width="40"></td>
              <td> 
                   <a href="/usecase/view/id/<?php echo $uc['usecase_id'];?>"> UC-<?php echo str_pad($uc['packnumber'], 2, "0", STR_PAD_LEFT).''.str_pad($uc['number'], 3, "0", STR_PAD_LEFT); ?></a>
               </td> 
              <td>
                  <b><?php echo $uc['name'];?></b>
                  
                
              </td> 
              <td>
 
                
                  
              <?php if($edit){ ?>
                  <a href="/usecase/delete/id/<?php echo $uc['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i> </a>
               <a href="/usecase/update/id/<?php echo $uc['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 

               
               
              
               <a href="/usecase/history/id/<?php echo $uc['usecase_id'];?>"><i class="icon-calendar" rel="tooltip" title="Version history"></i></a> 
               
               <?php if($counter!=0) { ?>
               <a href="/usecase/move/dir/2/id/<?php echo $uc['id'];?>"><i class="icon-arrow-up" rel="tooltip" title="Move Up"></i></a> 
               <?php } ELSEIF(count($usecases)>1) {?>   
               <i class="icon-flag" rel="tooltip" title="Start"></i>
               <?php } ?>           
               <?php if($counter!=count($usecases)-1) { ?>        
               <a href="/usecase/move/dir/1/id/<?php echo $uc['id'];?>"><i class="icon-arrow-down" rel="tooltip" title="Move Down"></i></a> 
               <?php } ELSEIF(count($usecases)>1) {?>
               <i class="icon-flag" rel="tooltip" title="End"></i>   
               <?php } ?>  
               <?php } ?> 
               </td></tr>
         
        <?php  $counter++;
        endforeach ?>       

                
                
            <?php $pack_counter++; endforeach; 
            endif;?>
            
            <?php if($edit){ ?> 
               <tr>
                   <td colspan="4"> 
                     
                       <a href="/package/create/"><i class="icon-plus-sign-alt" rel="tooltip" title="Add another step"></i> Add Package</a> 
                    
                   </td>
               </tr>
             <?php } ?>   
            </tbody>
        </table>
<?php 
$this->endWidget(); ?>  




