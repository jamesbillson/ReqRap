<?php

echo $this->renderPartial('/project/head',array('tab'=>'testcases'));



$testruns=Testrun::model()->findAll('testcase_id='.$id);
Yii::App()->session['setting_tab']='testcases';
?>
<a href="<?php echo UrlHelper::getPrefixLink('/project/view')?>">Back to testcases</a>
<?php 


        
$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Test Results',
    'headerIcon' => 'icon-check',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
      )); 
?>
<table> <thead>
        <th>
    Run   
    </th>
    <th>Results</th>
   

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
             </td> </tr>
      
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
            echo '<tr><td></td><td>'.$testresult['action'].'<br>';
            echo $testresult['result'].'</td><td>';
               echo Testcaseresult::$status[$testresult['testresult']].'</td></tr>'; 
            }
            $passing = ($passing/count($testresults))*100;
            $coverage = ($coverage/count($testresults))*100;
            //print_r($testresult);
            ?>
      
       <tr>
                   <td>
            Coverage: <?php   echo $coverage; ?>%     
           </td>
           
           <td>
            Pass result: <?php   echo $passing; ?>  %  
           </td>


       </tr>
       <?php
        }
            
        ?>
       
   </tbody>
       
</table>

    <?php $this->endWidget(); ?>


        
              


