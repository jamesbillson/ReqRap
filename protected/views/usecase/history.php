<?php 
echo $this->renderPartial('/project/head',array('tab'=>'details')); 
?>    
<h3>Version History</h3> 
<h4><?php echo $model->name; ?></h4>
   <?php $collapse = $this->beginWidget('bootstrap.widgets.TbCollapse'); ?>
 <?php 

 

$history=Usecase::model()->getHistory($model->usecase_id);
krsort($history);
?>
   

<?php
foreach($history as $version=>$item){
?>
 <div class="accordion-group">
        <div class="accordion-heading">
            <table>
                <tr><td>
                <?php if($item['active']==0 && $item['action']<3){  ?>
                <a href="/usecase/rollback/uc/<?php echo $item['usecase_id'];?>/id/<?php echo $version;?>">
                <i class="icon-repeat" rel="tooltip" data-placement="right" title="Roll Back to this Version"></i></a> 
                <?php  } 
                if($item['active']==1)
                { ?> 
                        <a href="/usecase/rollback/uc/<?php echo $item['usecase_id'];?>/id/<?php echo $version;?>">
                <i class="icon-circle-arrow-right" rel="tooltip" data-placement="right" title="Current Version"></i> 
                        </a>
                    <?php   }
                if($item['action']==3)
                { 
                    ?>
                 <i class="icon-trash" rel="tooltip" data-placement="right" title="Version Deleted"></i> 
                   
                <?php 
                }
                ?>  
                </td>
                <td width="120px">
                 <?php if(in_array($item['object'],array(9,10,15,16))){  ?>        
                <a class="accordion-toggle" data-toggle="collapse"
                data-parent="#accordion<?php echo $version; ?>" href="#collapse<?php echo $version; ?>">Change #<?php echo $item['number']; ?></a></td>
                <?php  } ELSE { ?> <span class="accordion-toggle">
                 Change #<?php echo $item['number']; ?></span>
                 </td>
                <?php   } ?>
               
                <td> 
                   <?php $this->widget('bootstrap.widgets.TbBadge', array(
                    'type'=>Version::$action_types[$item['action']], // 'success', 'warning', 'important', 'info' or 'inverse'
                    'label'=>Version::$action_labels[$item['action']],
                    )); 
                   ?>
                
                </td>
                <td><?php echo Version::$object_labels[$item['object']]; ?></td> 
                <td><?php echo $item['date']; ?></td>
                <td><?php echo $item['firstname'].' '.$item['lastname']; ?></td>
           
    


    </tr>
 </table>
 </div>
        <div id="collapse<?php echo $version; ?>" class="accordion-body collapse">
            <div class="accordion-inner">
                <strong>Details</strong><br />
                <?php echo $item['name']; ?><br />
                
                <?php echo $item['detail']; ?><br />    
            </div>
        </div>
    </div>
              
<?php
}
$this->endWidget();
   
?>
