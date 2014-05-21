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
                   <th>Actions</th>
                </tr>
            </thead>

            <tbody>

<p>
   



          

            <?php foreach($testcases as $testcase){
              $testruns=  Testrun::model()->findAll('testcase_id='.$testcase->id);  
              $running=$closed=false;
              $notrun=true;
              foreach($testruns as $testrun){
              if ($testrun->status==3){ $closed=true;$notrun=false ;}
                  if ($testrun->status==2){ $running=true;$notrun=false ;}
          
              
              }
              
                ?>
                <tr class="odd">  
                    <td>   
                       
                        
                     <a href="/testcase/view/id/<?php echo $testcase->id;?>">
                     TC-<?php echo str_pad($testcase['number'], 4, "0", STR_PAD_LEFT) ?>    
                      </a>
                    </td>
                    <td>   
                         
                    <?php echo $testcase['name'];?>
                    </td>
                    
                    <td>
                       <?php if($notrun) { ?>
                        
                      Not Run
                       <?php }
                       if($running) { ?>
                    <a href="/testcase/viewrun/id/<?php echo $testcase->id;?>">Running</a>
                    <?php } 
                    if ($closed) { echo 'Completed '.count($testruns).' runs.';?>
                    <a href="/testcase/results/id/<?php echo $testcase->id;?>">view runs</a> Last Run score.
                    <?php } ?>
                        
                    </td> 
                   

                  
                    <td>
                           <?php if($notrun) { ?>
                        
                       <a href="/testcase/run/id/<?php echo $testcase['id'];?>"><i class="icon-check" rel="tooltip" title="Run the Test Case"></i></a> 
                    
                       <?php } ?> 
                        <?php if($closed) { ?>
                        
                       <a href="/testcase/run/id/<?php echo $testcase['id'];?>"><i class="icon-repeat" rel="tooltip" title="Re-Run the Test Case"></i></a> 
                    
                       <?php } ?> 
                       
                       <a href="/release/delete/id/<?php echo $testcase['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Remove"></i></a> 
                    
                       </td>
                </tr>
            <?php }
       
                    ?>
            </tbody>
        </table>

    <?php $this->endWidget(); 



/*
$teststeps=  Teststep::model()->findAll('testcase_id='.$testcase['id']);
foreach($teststeps as $teststep){

?>
<blockquote>
Step Action: <?php echo $teststep['action'] ?><br />
Step Result: <?php echo $teststep['result'] ?><br />
</blockquote>
</p>
<?php
}

 * 
 * 
 */


?>


