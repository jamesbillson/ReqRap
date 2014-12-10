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
    $data = Iface::model()->getCategoryIfaces($type['interfacetype_id']);?>
        <tr>     

                <td id="Ifacetype_<?php echo $type['interfacetype_id']; ?>" valign="top" class="ifaceDroppable" data-id="<?php echo $type['interfacetype_id']; ?>"><b>
                <?php echo str_pad($type['number'], 2, "0", STR_PAD_LEFT).'-'.$type['name'];?></b>
                <br>
	  <?php  if (count($data)){?>
          
           <ul>
                <?php foreach($data as $item){?>
                <li data-ifacetype="<?php echo $item['interfacetype_id']; ?>" data-iface="<?php echo $item['iface_id']?>" data-id="<?php echo $item['id']?>" style="float:left;text-align:center; list-style:none;" class="ifaceDraggable">
                <a   href="<?php echo Yii::app()->getBaseUrl();  ?>/project/protoflowifaceadd/id/<?php echo $item['iface_id']?>/type/12" class="thumbnail " rel="tooltip" data-title="UI-<?php echo str_pad($type['number'], 2, "0", STR_PAD_LEFT); ?><?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?>">
               <span style=" text-align:center"><i class="icon-file icon-4x"></i><br />
                <?php   
				echo $item['name'];
               /* $this->widget('bootstrap.widgets.TbBadge', array(
                'type'=>'info',
                'label'=>$item['name'].' +' ,
                )); */
                 ?></span>  
                </a></li>
            
             
                
        
           
     <?php } ?></ul> </div>
     
         <?php } ?> </td></tr><?php } ?>
                <tr>
                <td valign="top">
                    
                    <b>Forms</b><br>
     <?php
        $data = Form::model()->getProjectForms(Yii::app()->session['project']);
            if (count($data)){
                foreach($data as $item): ?>
                    <a style="float:left;text-align:center;" href="#" class="thumbnail" rel="tooltip" data-title="UF-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?>">              
               
                 <span style=" text-align:center"><i class="icon-file-text icon-4x" style="color:#f89406;"></i><br />
           
                <?php   
				echo $item['name'];
                /* $this->widget('bootstrap.widgets.TbBadge', array(
    'type'=>'warning',
    'label'=>$item['name'].' +' ,
    )); */
     ?>  
            </span>    </a>     
                 
            <?php endforeach;
            }?>
   </td>
                
                
                
           </tr>  </table>
                   

                  
<?php                   

// ############## FLOW SECTION ##################


    
    echo $this->renderPartial('_protoflow',array('ucDef'=>$ucDef)); 



   ?>

<div id="packageTabs">
<ul id="yw9" class="nav nav-tabs">
<?php 
$project=Yii::App()->session['project'];
 $packages = Package::model()->getPackages($project);
 $pi=0;
 foreach($packages as $package){
	 $class='';
	if($pi==0)
	{
		$class='active';
	}
	$pi++;
	echo '<li class="'.$class.'"><a data-toggle="tab" href="#package_'.$package['id'].'">PA-'.$package['number'].' '.$package['name'].'</a></li>';	
}
 ?>
</ul> 
<div class="tab-content">
<?php 
$pi=0; 
foreach($packages as $package){
$packusecases = Usecase::model()->getPackageUsecases($package['package_id']);
 $class='';
	if($pi==0)
	{
		$class='active in';
	}
	$pi++;
?>
<div id="package_<?php echo $package['id'];  ?>" class="tab-pane fade <?php echo $class; ?>">

<?php
if (count($packusecases)>0){
echo '<div class="span4">';	
foreach($packusecases as $uc){ ?>
<br /><a href="<?php echo Yii::app()->getBaseUrl();  ?>/project/protoflowview/id/<?php echo $uc['id'];?>">
UC-<?php echo str_pad($uc['packnumber'], 2, "0", STR_PAD_LEFT).''.str_pad($uc['number'], 3, "0", STR_PAD_LEFT); ?> 
    </a>
        <b><?php echo $uc['name'];?></b>

<?php // echo $uc['description']; ?>
         

<?php } 
echo '</div> <div class="span8">';
$this->renderPartial('/package/printdiagram',array('package'=>$package)); 
echo "</div>";
// End if there are any UC's in this package ?>
<?php } // END LOOP THROUGH USE CASES ?>  

</div>          
 
<?php } // END LOOP THROUGH PACKAGES?>
</div>
</div>            
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