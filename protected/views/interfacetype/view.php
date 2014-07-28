<?php
echo $this->renderPartial('/project/head',array('tab'=>'usecases')); 
?>
<h3>Interface Type: <?php echo $model->name; ?></h3>



       <h4>Traceability</h4>
        
        <?php 
 //$steprule=(Steprule::model()->findAll('rule_id='.$model->rule_id));
 $interfaces=  Interfacetype::model()->getInterfacesForType($model->id);
 if(!count($interfaces)){
  
 ?>
       <div class="row offset1">
 This Interface Type is not used by any interfaces.
       </div>
 <?php } ELSE {?>
 The following interfaces have this Type:<br />
   <?php foreach($interfaces as $item){?>
 <a href="/iface/view/id/<?php echo $item['iface_id'];?>">
       <?php  echo 'UI-'.str_pad($model['number'], 2, "0", STR_PAD_LEFT).str_pad($item['number'], 3, "0", STR_PAD_LEFT);?>
   </a>  
         <?php echo $item['name'];?> 
    
 <?php } ?>
 <?php } ?>
    
<h3>Version History</h3>    
        
   
        <?php $collapse = $this->beginWidget('bootstrap.widgets.TbCollapse'); ?>
   <?php if (count($versions)){?>
        <?php foreach($versions as $item) {?>   
<div class="accordion-group">
        <div class="accordion-heading">
            <table>
                <tr>
                    <td>
                <?php if ($item['active'] != 1 && $item['action']!=3){    ?> 
                <a href="/version/rollback/id/<?php echo $item['versionid'];?>"><i class="icon-repeat" rel="tooltip" data-placement="right" name="Roll Back to this Version"></i></a> 
                <?php  } ELSE { ?> 
                <i class="icon-circle-arrow-right" rel="tooltip" data-placement="right" name="Current Version"></i> 
                <?php   } ?>  
               </td>
               <td>
                <a class="accordion-toggle" data-toggle="collapse"
               data-parent="#accordion<?php echo $item['ver_numb']; ?>" href="#collapse<?php echo $item['ver_numb']; ?>">
                Change #<?php echo $item['ver_numb']; ?> </a>
                </td>
                <td>
            
                <?php echo $item['create_date']; ?> 
                <?php echo $item['firstname'].' '.$item['lastname']; ?> 
                </td>
                <td> 
                Action:  <?php echo Version::$actions[$item['action']]; ?>   
                </td>
                </tr>
            </table>   
        </div>
        <div id="collapse<?php echo $item['ver_numb']; ?>" class="accordion-body collapse">
            <div class="accordion-inner">
                <strong><?php echo $item['name']; ?></strong><br />
                  
            </div>
        </div>
    </div>
  <?php } } ?>
<?php $this->endWidget(); ?>

