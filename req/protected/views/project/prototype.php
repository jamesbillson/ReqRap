<?php 

$tab=Yii::App()->session['setting_tab'];
if (!isset($tab)) $tab='details';
echo $this->renderPartial('/project/head',array('tab'=>$tab)); ?>

 
<?php // if this company project owner is current viewer
  
    $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;
    $permission=Yii::App()->session['permission'];
    $phase=Yii::App()->session['phase'];

?>

<?php         




               $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Add',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=>array('project/protoifaceadd')
));
    
   ?>

     

<?php $types = Interfacetype::model()->getInterfacetypes(); ?>
       <table>
    <?php foreach($types as $type){
    $data = Iface::model()->getCategoryIfaces($type['interfacetype_id']);
        if (count($data)){?>
            <tr>     

                <td valign="top" class="ifaceDroppable" data-id="<?php echo $type['interfacetype_id']; ?>"><b>
                <?php echo str_pad($type['number'], 2, "0", STR_PAD_LEFT).'-'.$type['name'];?></b>
                <br>
           
                <?php foreach($data as $item){?>
                <a  data-ifacetype="<?php echo $item['interfacetype_id']; ?>" data-iface="<?php echo $item['iface_id']?>" data-id="<?php echo $item['id']?>" style="float:left;" href="<?php echo Yii::app()->getBaseUrl();  ?>/project/protoflowifaceadd/id/<?php echo $item['iface_id']?>/type/12" class="thumbnail ifaceDraggable" rel="tooltip" data-title="UI-<?php echo str_pad($type['number'], 2, "0", STR_PAD_LEFT); ?><?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?>">
                <?php   
                $this->widget('bootstrap.widgets.TbBadge', array(
                'type'=>'info',
                'label'=>$item['name'].' +' ,
                )); 
                 ?>  
                </a>
            
             
                
        
           
     <?php } ?> </div>
     </td>
         <?php } ?> </tr><?php } ?>
                <tr>
                <td valign="top">
                    
                    <b>Forms</b><br>
     <?php
        $data = Form::model()->getProjectForms(Yii::app()->session['project']);
            if (count($data)){
                foreach($data as $item): ?>
                    <a style="float:left;" href="#" class="thumbnail" rel="tooltip" data-title="UF-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?>">              
               
               
           
                <?php   
                 $this->widget('bootstrap.widgets.TbBadge', array(
    'type'=>'warning',
    'label'=>$item['name'].' +' ,
    )); 
     ?>  
                </a>     
                 
            <?php endforeach;
            }?>
   </td>
                
                
                
           </tr>  </table>
                   

                  
<?php                   

// ############## FLOW SECTION ##################


    
    echo $this->renderPartial('_protoflow',array('ucDef'=>$ucDef)); 



   ?>

<?php 
$project=Yii::App()->session['project'];
 $packages = Package::model()->getPackages($project);
foreach($packages as $package){
$packusecases = Usecase::model()->getPackageUsecases($package['package_id']);

 if (count($packusecases)>0){



?>

<div>        
<h3>Package PA-<?php echo $package['number'];?> <?php echo $package['name'];?></h3>

</div>

<?php foreach($packusecases as $uc){ ?>
<br /><a href="<?php echo Yii::app()->getBaseUrl();  ?>/project/protoflowview/id/<?php echo $uc['id'];?>">
UC-<?php echo str_pad($uc['packnumber'], 2, "0", STR_PAD_LEFT).''.str_pad($uc['number'], 3, "0", STR_PAD_LEFT); ?> 
    </a>
        <b><?php echo $uc['name'];?></b>
(<?php 
$actors = Actor::model()->getActors($uc['usecase_id']); // get the requirements with answers

if (count($actors)):?>
                  <?php foreach($actors as $actor) : ?>  
                  <?php echo $actor['name'];?>,  
                  <?php endforeach ?> 
<?php endif; // end count of results ?> ) 
<?php echo $uc['description']; ?>
         

<?php } // End if there are any UC's in this package ?>
<?php } // END LOOP THROUGH USE CASES ?>   
          
 
<?php } // END LOOP THROUGH PACKAGES?>
            
<script type="text/javascript">
var drg;
$(document).ready(function(){
$( ".ifaceDraggable" ).draggable({opacity: 0.6,
                    cursor: 'move',
					revert:"invalid",
					drag: function (event, ui) {
                     drg = $(this);				
					}});

$( ".ifaceDroppable" ).droppable({
			hoverClass: "ui-state-active",
			drop: function( event, ui ) {
				Ifacetype_id=$(this).attr('data-id');
				old_ifacetype=drg.attr('data-ifacetype');
				iface_id=drg.attr('data-id');
				if(Ifacetype_id !=old_ifacetype )
				{
					$.ajax({
						   type:'POST',
						   data:{'Iface[id]':iface_id,'Iface[interfacetype_id]':Ifacetype_id},
						   url:'<?php echo Yii::app()->getBaseUrl();  ?>/iface/update/ucid/-1/id/'+iface_id,
						   success:function(data){
							  
						   }
						   
						   });
					drg.attr('data-ifacetype',Ifacetype_id);
				}
				}
		});


						   
});
</script>