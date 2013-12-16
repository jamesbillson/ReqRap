/package/_follower    <br />

todo:  add invited tenderers. Only show tenderers. No need to add consultant to a package.

<?php 

$status = array('invited','confirmed');
$data = Follower::model()->getTenderers($model->id, 2);




$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Subcontractors',
	'headerIcon' => 'icon-user',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
           'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButton',
                    'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'label'=> 'Invite Bidder',
                    'url'=>'/follower/addFollower/id/'.$model->id.'/type/2',
                    
                      ),
     
)));  


// IS THIS PACKAGE ALREADY AWARDED

?>

<table class="table">
	<thead>
	<tr>
		<th>Name</th>
		<th>Email</th>
                <th>Status</th>
		<th>Actions</th>
	
	</tr>
	</thead>
        <tbody>

        <?php if (count($data)):
            foreach($data as $item) {?>
        <tr class="odd">  
        <td>   
        <a href="/contact/view/id/<?php echo $item['id'];?>"><?php echo $item['firstname']." ".$item['lastname'];?></a> - <?php echo $item['companyname'];?>
        </td>
         <td>
            <?php echo $item['email'];?>
      </td>
        <td> 
            <?php
            $price=Tenderans::model()->followerBidStatus($item['id'], $model->id); //follower id and package id
            if($price>0){ ?>
            
            Submitted price $ <?php echo number_format($price, 2, '.', ',');   ?>
            
        </td>
        

     <?php   } ELSE { ?>
        Invited
          </td>
        
     
      <?php   } ?>
        </td>

            <td>
   <?php  if($price>0 && !$let){ ?> 
         <a href="/package/subcontractview/bidderid/<?php echo $item['user_id'];?>/packid/<?php echo $model->id;?>"><i class="icon-eye-open" rel="tooltip" title="View Bid Detail"></i></a> 
      <a href="/subcontract/award?id=<?php echo $item['id'];?>&package_id=<?php echo $model->id;?>"><i class="icon-check text-success" rel="tooltip" title="Award to this subcontractor"></i></a> 
                
    <?php } ?>
      <?php  if(!$let){ ?> 
      <a href="/subcontract/manual?id=<?php echo $item['id'];?>&package_id=<?php echo $model->id;?>"><i class="icon-plus-sign" rel="tooltip" title="Add Manual Bid"></i></a> 
    <?php } ?>
      <?php  if($price<0){ ?> 
      <a href="/follower/remove?id=<?php echo $item['follower_id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Remove/Uninvite"></i></a> 
       <?php } ?>  
             
            </td>
        </tr>
       <?php }
       endif;?>
       
        
             <?php       
        $data = Follower::model()->getTendererPendingInvites($model->id, 2);      
        if (count($data)):
            foreach($data as $item): ?>
                <tr class="odd">  
                    <td>   
                        <?php echo $item['firstname']." ".$item['lastname'];?>
                    </td>
                    <td>
                        <?php echo $item['email'];?>
                    </td>
                    <td>   
                        <?php echo $status[$item['confirmed']];?>
                    </td>
                    <td>
                        <a href="/contact/view/id/<?php echo $item['id'];?>"><i class="icon-eye-open" rel="tooltip" title="View"></i></a> 
                        <a href="/follower/remove?id=<?php echo $item['follower_id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Remove/Uninvite"></i></a> 
                        <a href="/follower/resendinvite?id=<?php echo $item['follower_id'];?>"><i class="icon-envelope" rel="tooltip" title="Reinvite"></i></a> 
                    </td>
                </tr>
            <?php endforeach ?>
        <?php endif; ?>
        </tbody>
    </table>
        
        
   	</tbody>
</table>

<?php

$this->endWidget();

?>

