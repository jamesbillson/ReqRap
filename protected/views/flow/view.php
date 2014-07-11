   <?php 
 $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Steps',
	'headerIcon' => 'icon-list-ol',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
          ));  
 $permission=Yii::App()->session['permission'];
 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;
 ?>
            
 <table class="table">
<tbody>

   <?php //echo 'model id: '.$model->id.' project'.$model->package->project_id?>
    <?php 
     $data = Flow::model()->getUCFlow($model->id); // get flows
     foreach($data as $line) { // LOOP THRU FLOWS
         ?>
         <tr> 
         <?php
                 if ($line['main']==1) { // THIS IS THE MAIN FLOW so show main heading
                        ?>
                       <td colspan="2">
                       <strong>Main Flow</strong> <?php if($edit){ ?>
                       <a href="/step/update/id/-1/flow/<?php echo $line['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit Flow Steps"></i></a>
     
            <?php } ?> 
                        </td>    
                        </tr>
                        <?php
                        }ELSE { // THIS IS AN ALT FLOW SO SHOW THE ALT HEADING
                         ?>
                        <td>
                          
                       <strong>Alternate Flow <?php echo $line['name'];?></strong>
                       <?php if($edit){ ?>

                       <a href="/step/update/id/-1/flow/<?php echo $line['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit Flow Steps"></i></a>
                        <a href="/flow/delete/id/<?php echo $line['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete Flow"></i></a>
                   
                       <?php } ?> 
                        </td>
                        <td colspan="2">
                       Start after main step  <?php echo $line['start'];?> rejoin at main step   <?php echo $line['rejoin'];?>
                       
                        </td>
                        </tr> 
               
                        <?php   
                        }
         
         
  
          
          $steps= Step::model()->getFlowSteps($line['flow_id']); // get steps
       
                        foreach($steps as $step) { // LOOP THRU STEPS
                          ?>
                        <tr>
                            <td>
                             
                            <strong>Step <?php echo $step['number'];?></strong> 
                            <a href="/step/update/flow/1/id/<?php echo $step['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a>
                            </td>
                            <td>
                            <?php
                                echo $step['text']."
                                <br />".$step['result']."</td> ";
                        
                                if ($line['main']==1) { // THIS IS THE MAIN FLOW so show the Fork link
                              ?>
                        <td colspan="2">
                        <?php if($edit){ ?>
                        <a href="/flow/create/start/<?php echo $step['step_id'];?>/id/<?php echo $model->usecase_id;?>"><i class="icon-random" rel="tooltip" title="Start Alternate Flow Here"></i></a>
                        <?php } ?> 
                        </td>    
                        </tr>
                        <?php
                        }
                        } 
                    if ($line['main']!=1) { // THIS IS NOT MAIN FLOW so show rejoin
                        ?>
                       
                        <?php
                        }  
                        
                        
                        ?>
           <tr>
               <td colspan="5">
                   <?php if($edit){ ?>

                   <a href="/step/create/id/<?php echo $line['id'];?>"><i class="icon-plus-sign-alt" rel="tooltip" title="Add another step"></i></a> 
           <?php } ?> 
               </td>
           </tr>
     
     <?php
     } // END FLOW LOOP 
      ?>
       </tbody>  
</table>
 
 <?php           
     $this->endWidget();
       

?>
     
   
     
