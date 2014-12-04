<?php 
$flows = Flow::model()->getUCFlow($usecase); // get flows
foreach($flows as $flow) { // LOOP THRU FLOWS
$steps= Step::model()->getFlowSteps($flow['flow_id']); // get steps
if($flow['main']==1){
    $name = '<strong>Scenario Text</strong> ';
} ELSE {
    $name = '<strong>Alternate Course '.$flow['name'].
            '</strong><br />Start after main step '.$flow['start'].
            ' re-join at main step '.$flow['rejoin'];
}
?>
         <tr> 
             
             <td <?php if (count($steps)>1) echo 'rowspan="'.count($steps).'"'; ?>>
               <?php echo $name;?>
             </td>    
                    
                        
               
         <?php   
         $counter=0;
         foreach($steps as $step) { 
                 $counter++;
         if($counter>1) echo '<tr>';
         
         
         $actorname =(count($actors)>1)?'('.$step['actor'].')':''; 
         ?>
                   
            <td>
                <b><?php echo $step['number'];?>.</b>               <?php echo $actorname;?>
               <?php echo Version::model()->wikiOutput($step['text'],1)." <br />".Version::model()->wikiOutput($step['result'],1)."</td> "; ?>
            </td>

             <?php }  ?>
            
           </tr>   
             <?php  } ?>
     

