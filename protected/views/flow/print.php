<?php 
$flows = Flow::model()->getUCFlow($usecase); // get flows
foreach($flows as $flow) { // LOOP THRU FLOWS
$steps= Step::model()->getFlowSteps($flow['flow_id']); // get steps
$name = ($flow['main']==1)?'<strong>Scenario Text</strong> ':'<strong>Alternate Course '.$flow['name'].
        '</strong><br />Start after main step '.$flow['start'].
        ' re-join at main step '.$flow['rejoin'];
?>
         <tr> 
             <td rowspan="<?php echo count($steps);?>">
               <?php echo $name;?>
             </td>    
                    
                        
               
         <?php   
         
         foreach($steps as $step) { 
                 
         if($step['number']!=1) echo '<tr>';
         
         
         $actorname =(count($actors)>1)?'('.$step['actor'].')':''; 
         ?>
                   
            <td>
               Step 
               <?php echo $step['number'];?><?php echo $actorname;?>
               <?php echo Version::model()->wikiOutput($step['text'])." <br />".Version::model()->wikiOutput($step['result'])."</td> "; ?>
            </td>

             <?php }  ?>
            
           </tr>   
             <?php  } ?>
     

