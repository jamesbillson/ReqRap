<?php
$testruns=Testrun::model()->findbyAttributes(array('testcase_id'=>$id));
?>
<pre>
<?php print_r($testruns); ?> 
</pre>

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
            foreach($testruns as $testrun){
                
               
                
            ?>
           <td>
           
                    <?php// echo $testrun['id']; ?>     
           </td>
           <td>
             
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






