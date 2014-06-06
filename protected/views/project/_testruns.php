<?php 

$release=Yii::App()->session['release'];
$project=Yii::App()->session['project'];
$testcases=  Testcase::model()->findAll('release_id='.$release);


?>
<?php 


        
$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Test Cases',
    'headerIcon' => 'icon-check',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Test Case',
        //'visible'=> $permission,
        'url'=>'/testcase/create/',
    ),
   
))); 
?>

<table class="table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Results/status?</th>
   
                </tr>
            </thead>

            <tbody>

<p>
   



          

            <?php foreach($testcases as $testcase){?>
                <tr class="odd">  
                    <td>   
                       
                        
                     <a href="/testcase/view/id/<?php echo $testcase['id'];?>">
                     TC-<?php echo str_pad($testcase['number'], 4, "0", STR_PAD_LEFT) ?>    
                      </a>
                    </td>
                      <td colspan="2">   
                         
                    <?php echo $testcase['name'];?>
                    </td>
                </tr>
                <tr>
                
                    <?php 
                    $testruns=Testrun::model()->findAll('testcase_id='.$testcase['id']);
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
          
       </tr>
       <?php
        }
      }
       
                    ?>
            </tbody>
        </table>

    <?php $this->endWidget(); 



?>


