
<div class="row">
    <h3> <a href="/project/view/tab/details/id/<?php echo $model->package->project->id; ?>"><?php echo $model->package->project->name; ?></a></h3>
</div>



 <div class="row"> 
    <?php

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => 'Use Case : '.$model->number.''.$model->name,
        'htmlOptions' => array('class'=>'bootstrap-widget-table'),
          ));  
?>

  <table class="table">

      <tbody>

          <tr class="odd">

              <td>  <b>Package</b> 
              </td>
              <td>   <a href="/package/view/tab/details/id/<?php echo $model->package->id; ?>"><?php echo $model->package->name ; ?></a>
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
                  <a href="/actor/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                    <a href="/actor/remove/id/<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Remove Actor"></i></a> 
                         
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
$uses = Uses::model()->getUses($model->id); // get the requirements with answers



$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Uses',
	'headerIcon' => 'icon-user',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
           'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButton',
                    'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'label'=> 'Add +',
                    'url'=>'/actor/create/id/'.$model->id,
                    
                      ),
     
)));  
  if (count($uses)):?>

  <table class="table">
  	<thead>
    	<tr>
          <th>Name</th>

          <th>Actions</th>
    	</tr>
  	</thead>
      <tbody>
  
        <?php foreach($uses as $item) : // Go through each un answered question??>

          <tr class="odd">

              <td>   
                  <b><?php echo $item['name'];?></b>
                
              </td> 
              <td>
                  <a href="/usecase/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
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
	'headerIcon' => 'icon-user',
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
        
        <td> <b>Alternate Flow <?php echo $uc[$w]['flow'];?></b> </td>
       <td colspan="3"> Start at Main Flow step <?php echo $uc[$w]['start'] ;?> and finish at step <?php echo $uc[$w]['rejoin'] ;?></td>

 <?php } ELSE {?>
       <td> <b>Main Flow</b> </td>
       
        <?php } ?>
          </tr>
    <?php
       $x=1; 
        $number_ucs=count($uc[$w])-6;
       
        while($x <= $number_ucs)
          {
    ?>
        <tr>
            <td></td>
            <td> <b>step <?php echo $uc[$w][$x]['step'];?></b> </td>
        <td>    <?php  echo $uc[$w][$x]['text'];?>
        </td> 
        <td>
             <?php if($uc[$w]['main']==1) { ?>
              <a href="/step/update/id/<?php echo $uc[$w][$x]['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
              <a href="/flow/create/start/<?php echo $uc[$w][$x]['id'];?>/id/<?php echo $model->id;?>"><i class="icon-random" rel="tooltip" title="Start Alternate Flow Here"></i></a> 
              <?php } ELSE {?>
             <a href="/step/update/id/<?php echo $uc[$w][$x]['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
              
               <?php } ?>
        </td>
        </tr>
           <?php           
          $x++;
          } ?>
         <tr><td colspan="4">   <a href="/step/create/id/<?php echo $uc[$w]['id'];?>"><i class="icon-plus-sign-alt" rel="tooltip" title="Add another step"></i></a> 
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
	'headerIcon' => 'icon-user',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
           'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButton',
                    'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'label'=> 'Add +',
                    'url'=>'/rule/create/id/'.$model->id,
                    
                      ),
     
)));  
  if (count($rules)):?>

  <table class="table">
  	<thead>
    	<tr>
          <th>Name</th>

          <th>Actions</th>
    	</tr>
  	</thead>
      <tbody>
  
        <?php foreach($rules as $item) : // Go through each un answered question??>

          <tr class="odd">

              <td>   <?php echo $item['number'];?> 
                  <b><?php echo $item['text'];?></b>
                
              </td> 
              <td>
                  <a href="/usecase/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
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
	'headerIcon' => 'icon-user',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
           'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButton',
                    'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'label'=> 'Add +',
                    'url'=>'/iface/create/uc/'.$model->id.'/id/'.$model->package->project->id,
                    
                      ),
     
)));  
  if (count($interfaces)):?>

  <table class="table">
  	<thead>
    	<tr>
          <th>Name</th>

          <th>Actions</th>
    	</tr>
  	</thead>
      <tbody>
  
        <?php foreach($interfaces as $item) : // Go through each un answered question??>

          <tr class="odd">

              <td>   
                  <b><a href="/iface/view/id/<?php echo $item['id'];?>"><?php echo $item['name'];?></a></b>
                
              </td> 
              <td>
                  <a href="/usecase/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
              </td>
         
        <?php endforeach ?>       
    </tbody>
  </table>

  <?php endif; // end count of results
  
  $this->endWidget();
  ?>
        
           </div>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>



</div><!-- form -->