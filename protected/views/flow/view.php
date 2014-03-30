   <?php 
 $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Steps',
	'headerIcon' => 'icon-list-ol',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
          ));  
 $permission=(Yii::App()->session['permission']==1)?true : false; 
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
                       <strong>Main Flow</strong> <?php if($permission){ ?>
                       <a href="/step/update/id/-1/flow/<?php echo $line['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit Flow Steps"></i></a>
             <?php } ?> 
                        </td>    
                        </tr>
                        <?php
                        }ELSE { // THIS IS AN ALT FLOW SO SHOW THE ALT HEADING
                         ?>
                        <td>
                          
                       <strong>Alternate Flow <?php echo $line['name'];?></strong>
                       <?php if($permission){ ?>

                       <a href="/step/update/id/-1/flow/<?php echo $line['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit Flow Steps"></i></a>
                        <?php } ?> 
                        </td>
                        <td colspan="2">
                       Start after main step  <?php echo $line['start'];?> rejoin at main step   <?php echo $line['rejoin'];?>
                       
                        </td>
                        </tr> 
               
                        <?php   
                        }
         
         
  
          
          $steps= Step::model()->getFlowSteps($line['id']); // get steps
       
                        foreach($steps as $step) { // LOOP THRU STEPS
                          ?>
                        <tr>
                            <td>
                             
                            <strong>Step <?php echo $step['number'];?></strong> 
                            </td>
                            <td>
                            <?php
                                echo $step['text']."
                                <br />".$step['result']."</td> ";
                        
                                if ($line['main']==1) { // THIS IS THE MAIN FLOW so show the Fork link
                              ?>
                        <td colspan="2">
                        <?php if($permission){ ?>
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
                   <?php if($permission){ ?>

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
       
       
       
  // ##############################     
/*
$flow=0;
$step=0;
$steps_total= 0;
$last_flow = '';
$uc=array();
$item=0;
foreach($data as $line) {
$item++;   

if($last_flow != $line['flow_id']) {
            $flow ++;
            $uc[$flow]['total']= 0;
            $uc[$flow]['flow']=$line['flow'];
            $uc[$flow]['main']=$line['main'];
            $uc[$flow]['start']=$line['start'];
            $uc[$flow]['rejoin']=$line['rejoin'];
            $uc[$flow]['id']=$line['flowid'];
            $uc[$flow]['flow_id']=$line['flow_id'];
            $step=0;
            
  }             
  $step++;
  
                $uc[$flow][$step]['step'] = $line['number'];
                $uc[$flow][$step]['position'] = $line['number']+$line['start'];
                $uc[$flow][$step]['actor']=$line['actor'];
                $uc[$flow][$step]['text']= $line['text'];
                $uc[$flow][$step]['result']= $line['result'];
                $uc[$flow][$step]['id']= $line['id'];
                $uc[$flow][$step]['step_id']= $line['step_id'];
                 $steps_total=$steps_total+1;
                $uc[$flow]['total']=$uc[$flow]['total']+1;
         $last_flow=$line['flow_id'];
  }
 echo "<pre>";
 echo 'Rows in total '.count($data).'
     ';
 print_r($uc);
 echo "</pre>";
 
 
 

 $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Steps',
	'headerIcon' => 'icon-list-ol',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
          ));  
 ?>
            <tbody>
 <table class="table">

<tr>

    <?php 
    
 $w=1;
  $number_flows=count($uc);  
   while($w <= $number_flows) 
   {   ?> 
        <tr class="odd">
     
        <?php if($uc[$w]['main']==0) { // ALTERNATE FLOW  ?>
        
        <td colspan="2"> <b>Alternate Flow <?php echo $uc[$w]['flow'];?></b> 
        <a href="/step/update/id/-1/flow/<?php echo $uc[$w]['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit Flow Steps"></i></a>
        
        </td>
       <td colspan="3"> Start at Main Flow step <?php echo $uc[$w]['start'] ;?> and finish at step <?php echo $uc[$w]['rejoin'] ;?></td>

 <?php } ELSE {   //   MAIN FLOW  ?>
       <td colspan="2"> 
           <b>Main Flow</b> 
            <a href="/flow/view/id/<?php echo $uc[$w]['flow_id'];?>"><i class="icon-edit" rel="tooltip" title="Edit Flow Steps"></i></a>
        
       </td>
       
        <?php } ?>
          </tr>
            <?php $x=1; 
            $number_ucs=count($uc[$w])-7;
            while($x <= $number_ucs) { ?>
        <tr>
            <td></td>
            <td> <b>step&nbsp;<?php echo $uc[$w][$x]['step'];?></b>
                <a href="/step/update/id/<?php echo $uc[$w][$x]['id'];?>/flow/<?php echo $uc[$w]['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit This Step"></i></a>
       
                <br />
            <?php  echo $uc[$w][$x]['actor'];?></td>
          
            <td>   <?php  echo $uc[$w][$x]['text'];?> <br /> 
               <?php  echo $uc[$w][$x]['result'];?> </td> 
        <td>  
             <?php if($uc[$w]['main']==1) { ?>
             
              <a href="/flow/create/start/<?php echo $uc[$w][$x]['step_id'];?>/id/<?php echo $model->usecase_id;?>"><i class="icon-random" rel="tooltip" title="Start Alternate Flow Here"></i></a> 
              <?php } ELSE {?>
             
              
               <?php } ?>
        </td>
        </tr>
           <?php           
          $x++;
          } ?>
         <tr><td colspan="5">   <a href="/step/create/id/<?php echo $uc[$w]['flow_id'];?>"><i class="icon-plus-sign-alt" rel="tooltip" title="Add another step"></i></a> 
           </td></tr>
    <?php           
    $w++;
    }
?>
   </tbody>  
</table>
 
 <?php           
     $this->endWidget();
 * 
 */
?>
     
   
     
