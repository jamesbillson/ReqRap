
<div class="row">
    <h3> <a href="/project/view/tab/usecases/id/<?php echo $model->package->project->id; ?>"><?php echo $model->package->project->name; ?></a></h3>
</div>

<div class="row"> 
    <?php 
$testcases = Testcase::model()->findAll('usecase_id='.$model->id); // get the requirements with answers
$run=Testrun::model()->getCurrentRun($model->package->project->id);


$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Test Cases',
	'headerIcon' => 'icon-user',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
           'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButton',
                    'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'label'=> 'Auto Add Test Cases',
                    'url'=>'/testcase/make/id/'.$model->id,
                    
                      ),
     
)));  
  if (count($testcases)):?>

  <table class="table">
  	<thead>
    	<tr>
          <th>Name</th>

          <th>Actions</th>
    	</tr>
  	</thead>
      <tbody>
  
        <?php foreach($testcases as $item) : // Go through each un answered question??>
<?php   

$result=Testcaseresult::model()->find('testrun_id='.$run.' AND testcase_id='.$item['id']);

?>
          <tr class="odd">

              <td>   
                  <b><a href="/testcase/view/id/<?php echo $item['id'];?>"><?php echo $item['name'];?></a></b>
                
              </td> 
               <td>   
                 <?php // echo Testcaseresult::$status[$result->status];?>
                
              </td> 
                <td>
                  <a href="/testcase/delete/ucid/<?php echo $model->id;?>/id/<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                  <a href="/testcase/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
              </td>
         
        <?php endforeach ?>       
    </tbody>
  </table>

  <?php endif; // end count of results
  
  $this->endWidget();
  ?>
      </div>


 <div class="row"> 
    <?php

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => 'Use Case : UC-'.str_pad($model->package->sequence, 2, "0", STR_PAD_LEFT).str_pad($model->number, 3, "0", STR_PAD_LEFT).'-'.$model->name,
        'htmlOptions' => array('class'=>'bootstrap-widget-table'),
          ));  
?>

  <table class="table">

      <tbody>

          <tr class="odd">

              <td>  <b>Package</b> 
              </td>
              <td>   <a href="/package/view/tab/usecases/id/<?php echo $model->package->id; ?>"><?php echo $model->package->name ; ?></a>
              </td>
                  
          </tr>

         <tr class="odd">

             <td> <b> Description </b>
              </td>
              <td>   <?php echo $model->description; ?>
              </td>
               
          </tr>
          
          <tr class="odd">

              <td> <b> Preconditions</b> 
              </td>
              <td>   <?php echo $model->preconditions; ?>
              </td>
               
          </tr>
      </tbody>
  </table>

      <?php 
  
  $this->endWidget();
  ?>  </div>

 <div class="row"> 
    <?php 
$actors = Actor::model()->getActors($model->id); // get the requirements with answers



$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Actors',
	'headerIcon' => 'icon-user',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
           'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButton',
                    'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'label'=> 'Add +',
                    'url'=>'/actorusecase/create/id/'.$model->id,
                    
                      ),
     
)));  
  if (count($actors)):?>

  <table class="table">
  	<thead>
    	<tr>
          <th>Name</th>

          <th>Actions</th>
    	</tr>
  	</thead>
      <tbody>
  
        <?php foreach($actors as $item) : // Go through each un answered question??>

          <tr class="odd">

              <td>   
                  <b><a href="/actor/view/id/<?php echo $item['id'];?>"><?php echo $item['name'];?></a></b>
                
              </td> 
              <td>
                  <a href="/actor/update/id/"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                    <a href="/actorusecase/delete/usecase_id/<?php echo $model->id;?>/actor_id/<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Remove Actor"></i></a> 
                         
              </td>
         
        <?php endforeach ?>       
    </tbody>
  </table>

  <?php endif; // end count of results
  
  $this->endWidget();
  ?>
      </div>


      
    
      
      <div class="row"> 
  

      
        <?php 
        $data = Step::model()->getSteps($model->id); // get the requirements with answers
  // ##############################     

$flow=0;
$step=0;
$steps_total= 0;
$last_flow = '';
$uc=array();
$item=0;
foreach($data as $line) {
$item++;   

if($last_flow != $line['flow']) {
            $flow ++;
            $uc[$flow]['total']= 0;
            $uc[$flow]['flow']=$line['flow'];
            $uc[$flow]['main']=$line['main'];
            $uc[$flow]['start']=$line['start'];
            $uc[$flow]['rejoin']=$line['rejoin'];
            $uc[$flow]['id']=$line['flowid'];
            $step=0;
            
  }             
  $step++;
  
                $uc[$flow][$step]['step'] = $line['number'];
                $uc[$flow][$step]['position'] = $line['number']+$line['start'];
                $uc[$flow][$step]['text']= $line['text'];
                $uc[$flow][$step]['result']= $line['result'];
                $uc[$flow][$step]['id']= $line['id'];
                 $steps_total=$steps_total+1;
                $uc[$flow]['total']=$uc[$flow]['total']+1;
         $last_flow=$line['flow'];
  }
 //echo "<pre>";
 //echo 'Rows in total '.count($data).'
 //    ';
// print_r($uc);
 //echo "</pre>";
//  ##########################################

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
     
        <?php if($uc[$w]['main']==0) { ?>
        
        <td> <b>Alternate Flow <?php echo $uc[$w]['flow'];?></b> 
        <a href="/step/update/id/-1/flow/<?php echo $uc[$w]['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit Flow Steps"></i></a>
        </td>
       <td colspan="3"> Start at Main Flow step <?php echo $uc[$w]['start'] ;?> and finish at step <?php echo $uc[$w]['rejoin'] ;?></td>

 <?php } ELSE {?>
       <td colspan="3"> 
           <b>Main Flow</b> 
            <a href="/step/update/id/-1/flow/<?php echo $uc[$w]['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit Flow Steps"></i></a>
       
       </td>
       
        <?php } ?>
          </tr>
            <?php $x=1; 
            $number_ucs=count($uc[$w])-6;
            while($x <= $number_ucs) { ?>
        <tr>
            <td></td>
            <td> <b>step&nbsp;<?php echo $uc[$w][$x]['step'];?></b> </td>
          
            <td>    <?php  echo $uc[$w][$x]['text'];?> <br /> 
               <?php  echo $uc[$w][$x]['result'];?> </td> 
        <td>  
             <?php if($uc[$w]['main']==1) { ?>
             
              <a href="/flow/create/start/<?php echo $uc[$w][$x]['id'];?>/id/<?php echo $model->id;?>"><i class="icon-random" rel="tooltip" title="Start Alternate Flow Here"></i></a> 
              <?php } ELSE {?>
             
              
               <?php } ?>
        </td>
        </tr>
           <?php           
          $x++;
          } ?>
         <tr><td colspan="5">   <a href="/step/create/id/<?php echo $uc[$w]['id'];?>"><i class="icon-plus-sign-alt" rel="tooltip" title="Add another step"></i></a> 
           </td></tr>
    <?php           
    $w++;
    }
?>
   </tbody>  
</table>
 
 <?php           
     $this->endWidget();
?>
      
   
       <?php 
$rules = Rule::model()->getRules($model->id); // get the requirements with answers



$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Business Rules',
	'headerIcon' => 'icon-cogs',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       
               ));  
  if (count($rules)):?>

  <table class="table">

      <tbody>
  
        <?php foreach($rules as $item) : // Go through each un answered question??>

          <tr class="odd">

              <td>  <a href="/rule/view/id/<?php echo $item['id'];?>"> BR-<?php echo str_pad($item['number'], 4, "0", STR_PAD_LEFT); ?> </a>
                 <?php if ($item['text']=='stub')echo '<i class="icon-exclamation-sign text-warning" rel="tooltip" title="Incomplete Rule"></i>';?>
             <b><?php echo $item['title'];?></b>
                  </td>
              <td>
                  <a href="/rule/delete/id/<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                  <a href="/rule/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
              </td>
         
        <?php endforeach ?>       
    </tbody>
  </table>

  <?php endif; // end count of results
  
  $this->endWidget();
  ?>
         </div>
<div class="row"> 
      
   
       <?php 
$interfaces = Iface::model()->getIfaces($model->id); // get the requirements with answers



$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Interfaces',
	'headerIcon' => 'icon-picture',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
           'headerButtons' => array(
              
     
)));  
  if (count($interfaces)):
      $lastcat='';
      ?>

  <table class="table">

      <tbody>
  
        <?php foreach($interfaces as $item) : // Go through each un answered question??>
             <?php 
              if($lastcat!=$item['type']){ ?>
          
          <tr class="odd">
              <td colspan="2">
            <?php  echo $item['type']; ?>
              </td>
          </tr>
          
              <?php }
          $lastcat=$item['type'];
          ?>
          
          <tr>
              <td>   
                  <a href="/iface/view/id/<?php echo $item['id'];?>"><?php echo 'UI-'.str_pad($item['typenum'], 2, "0", STR_PAD_LEFT).'-'.str_pad($item['number'], 3, "0", STR_PAD_LEFT);?> </a>
                  <b><?php echo $item['name'];?></a>
                
              </td> 
              <td>
                  <a href="/iface/delete/id/<?php echo $item['id'];?>/ucid/<?php echo $model->id;?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                  <a href="/iface/update/id/<?php echo $item['id'];?>/ucid/<?php echo $model->id;?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
              </td>
         
        <?php endforeach ?>       
    </tbody>
  </table>

  <?php endif; // end count of results
  
  $this->endWidget();
  ?>
     
       <?php 
$forms = Form::model()->getForms($model->id); // get the requirements with answers



$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Forms',
	'headerIcon' => 'icon-list-alt',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
           'headerButtons' => array(
              
     
)));  
  if (count($interfaces)):?>

  <table class="table">
  
      <tbody>
  
        <?php foreach($forms as $item) : // Go through each un answered question??>

          <tr class="odd">

              <td>   
                  <a href="/form/view/id/<?php echo $item['id'];?>"><?php echo 'UF-'.str_pad($item['number'], 3, "0", STR_PAD_LEFT);?> </a>
                  <b><?php echo $item['name'];?></b>
                
              </td> 
              <td>
                  <a href="/form/delete/id/<?php echo $item['id'];?>/ucid/<?php echo $model->id;?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                  <a href="/form/update/id/<?php echo $item['id'];?>/ucid/<?php echo $model->id;?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
              </td>
         
        <?php endforeach ?>       
    </tbody>
  </table>

  <?php endif; // end count of results
  
  $this->endWidget();
  ?>    
           </div>
      


</div><!-- form -->