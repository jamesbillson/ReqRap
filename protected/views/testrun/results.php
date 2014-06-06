<?php
$testruns=Testrun::model()->findAll('testcase_id='.$id);
?>


<table> <thead>
        <th>
    Run   
    </th>
    <th>Coverage</th>
    <th>Result</th>

    <th>
        
    </th>
   </thead>
   
   <tbody>
       <tr>
           <?php
           
            // print_r($testruns);
            foreach($testruns as $testrun){ 
              
                ?>  
             <td>
         
                    Run <?php   echo $testrun['number']; ?>     
                   </td> 
               <?php    
            $testresults=Testrun::model()->getTestRun($testrun['id']);  
            $coverage=0;
            $passing=0;
            $steps=0;
            // 1=>'Fail', 2=>'Pass',3=>'Block', 4=>'Not Tested'
            foreach($testresults as $testresult){  
            $steps++;
            if ($testresult['testresult']==2) $passing++;
            if ($testresult['testresult']!=4) $coverage++;
            if ($testresult['testresult']==3) break;
                
            }
            $passing = ($passing/count($testresults))*100;
            $coverage = ($coverage/count($testresults))*100;
            //print_r($testresult);
            ?>
           <td>
           
                    <?php   echo $coverage; ?>%     
           </td>
           <td>
             <?php   echo $passing; ?>  %  
           </td>
            <td>
                   
               
             
           </td>
            <td>
            
                
        
           </td>
       </tr>
       <?php
        }
            
        ?>
       
   </tbody>
       
</table>






