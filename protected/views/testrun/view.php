<?php

$data=  Testrun::model()->getTestRun($id);?>

<table> <thead>
    <th>Test Action</th>
    <th>
     Expected Result   
    </th>
    <th>
       Status 
    </th>
    <th>
      Comment  
    </th>
   </thead>
   
   <tbody>
       <tr>
           <?php
foreach($data as $teststep){
?>
           <td>
          <?php echo $teststep['action'] ; ?>     
           </td>
           <td>
             <?php echo $teststep['result'] ; ?>  
           </td>
            <td>
              <?php echo Testresult::$testresult[$teststep['testresult']] ; ?> 
           </td>
            <td>
              <?php echo $teststep['comments'] ; ?> 
           </td>
       </tr>
       <?php
        }
        ?>
       
   </tbody>
       
</table>






