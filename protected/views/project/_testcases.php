<?php 

$release=Yii::App()->session['release'];
$project=Yii::App()->session['project'];
$testcases=  Testcase::model()->findAll('release_id='.$release);


?>
<?php 

 $url='/testcase/create/id/'.$release;


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
        'label'=> 'Add Manual Case',
        'visible'=>in_array($permission,array(1,4)),
        //'visible'=> $permission,
        'url'=>'/testcase/create/',
    ),
           
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Auto Test Case',
        'visible'=>in_array($permission,array(1,4)),
        //'visible'=> $permission,
        'url'=>$url,
       'htmlOptions' => array(
		'name'=>'ActionButton',
		'confirm' => 'This will delete any existing test cases. Are you sure you\'d like to do this?',
	),
    ),
           
))); 
?>

<table class="table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Runs</th>
                    <th>Results</th>
                   <th>Actions</th>
                </tr>
            </thead>

            <tbody>

<p>
   



          

            <?php foreach($testcases as $testcase){
              $testruns=  Testrun::model()->findAll('testcase_id='.$testcase->id);  
              $running=$closed=false;
              $notrun=true;
              $finished = 0;
              foreach($testruns as $testrun){
              if ($testrun->status==3)
                  { 
                  $closed=true;
                  $notrun=false ;
                  $finished++;
                  $scores=Testrun::model()->getScore($testrun->id);
                 // (1=>'Fail', 2=>'Pass',3=>'Block', 4=>'Not Tested')
                  $fail=$scores['1'];
                  $pass=$scores['2'];
                  $block=$scores['3'];
                  $nottested=$scores['4'];
                  $coverage=(($scores['total']-$scores['4'])/$scores['total'])*100;
                  $passrate=($scores['2']/$scores['total'])*100;
                  }
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
                    <?php } ?> 
                    <?php  if ($closed && !$running) { echo 'Complete';} ?>
                    </td> 
                    
                    <td>
                    <?php  if ($closed) { echo $finished ;} ?>
                    </td>
                    
                    <td>
                    <?php if($closed) { ?>
                    <?php echo $passrate;?>%
                    <?php } ?>   
                    </td>
                    
                    <td>
  <a href="/release/delete/id/<?php echo $testcase['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Remove"></i></a> 
                                    
  <?php if($notrun) { ?>
                    <a href="/testcase/run/id/<?php echo $testcase['id'];?>"><i class="icon-check" rel="tooltip" title="Run the Test Case"></i></a> 
                    <?php } ?> 
                    <?php if($closed && !$running) { ?>
                    <a href="/testcase/run/id/<?php echo $testcase['id'];?>"><i class="icon-repeat" rel="tooltip" title="Re-Run the Test Case"></i></a> 
                    <?php
                    }
                    if($closed) { ?>
                    <a href="/testcase/results/id/<?php echo $testcase->id;?>"><i class="icon-eye-open" rel="tooltip" title="View Runs"></i></a>
                    <?php } ?>
                    </td>
                </tr>
            <?php }
       
                    ?>
            </tbody>
        </table>

    <?php $this->endWidget(); ?>


