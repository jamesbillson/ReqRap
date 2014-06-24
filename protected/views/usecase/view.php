 <?php echo $this->renderPartial('/project/head',array('tab'=>'usecases')); 

$permission=(Yii::App()->session['permission']==1)?true : false; 
//$data = Package::model()->getPackages($model->id);

/*$packagelist=array();
foreach($data as $item):
$packagelist=$packagelist+array($item['package_id']=>$item['name']);    
endforeach;
//print_r($packagelist);
 * 
 */
 ?>

<?php if($permission){ ?>
<?php } ?> 


 <div class="row"> 
    <?php

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => 'Use Case : UC-'.str_pad($package['number'], 2, "0", STR_PAD_LEFT).str_pad($model->number, 3, "0", STR_PAD_LEFT).'-'.$model->name,
        'htmlOptions' => array('class'=>'bootstrap-widget-table'),
               'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButton',
                    'type' => 'link', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'icon'=> 'edit',
                    'visible'=>$permission,
                    'url'=>'/usecase/update/id/'.$model->id,
                    
                      ),
     array(
                    'class' => 'bootstrap.widgets.TbButton',
                    'type' => 'link', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'icon'=> 'calendar',
                 'visible'=>$permission,
                    'url'=>'/usecase/history/id/'.$model->usecase_id,
                    
                      ),
     
                  
)
          ));  
?>

  <table class="table">

      <tbody>

          <tr class="odd">

              <td>  <b>Package</b> 
              </td>
              <td>   
                  <a href="/usecase/packchange/id/<?php echo $model->id; ?>"> <?php echo $package['name']; ?></a>
                  <?php
                  /*
                $package_model=Package::model()->findbyPK($package['id']);  
             
                $this->widget('editable.EditableField', array(
                    'type'      => 'select',
                    'model'     => $package_model,
                    'attribute' => 'package_id',
                    'url'       => $this->createUrl('usecase/editablechange/'), 
                    //'source'    => Editable::source(array(1 => 'Status1', 2 => 'Status2')),
                    'source'    => Editable::source($packagelist, 'package_id', 'name'),
                    'placement' => 'right',
                    ));
               * 
               */
                ?>
              
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
$actors = Actor::model()->getActors($model->usecase_id); // get the requirements with answers



$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Actors',
	'headerIcon' => 'icon-user',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
));  
  if (count($actors)):?>

  <table class="table">
  	
      <tbody>
  
        <?php foreach($actors as $item) : // Go through each un answered question??>

          <tr class="odd">

              <td>   
                  <b><a href="/actor/view/id/<?php echo $item['actor_id'];?>"><?php echo $item['name'];?></a></b>
                
              </td> 
              <td>
                          
              </td>
         
        <?php endforeach ?>       
    </tbody>
  </table>

  <?php endif; // end count of results
  
  $this->endWidget();
  ?>
      </div>


      
    
      
      <div class="row"> 
  
  <?php echo $this->renderPartial('/flow/view', array('model'=>$model));   
      
     
 
//$rules = Rule::model()->getRules($model->usecase_id); 
$rules = Usecase::model()->getLinkedObjects($model->usecase_id,1,16);


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

              <td>  <a href="/rule/view/id/<?php echo $item['rule_id'];?>"> BR-<?php echo str_pad($item['number'], 4, "0", STR_PAD_LEFT); ?> </a>
                 <?php if ($item['text']=='stub')echo '<i class="icon-exclamation-sign text-warning" rel="tooltip" title="Incomplete Rule"></i>';?>
             <b><?php echo $item['name'];?></b>
                  </td>
              <td>
                <?php if($permission){ ?>
                <a href="/rule/delete/id/<?php echo $item['id'];?>/ucid/<?php echo $model->id;?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                <a href="/rule/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
             <?php } ?> 
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
$interfaces = Iface::model()->getIfaces($model->usecase_id); // get the requirements with answers
//$interfaces = Usecase::model()->getLinkedObjects($model->usecase_id,12,15,$model->);


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
                  <a href="/iface/view/id/<?php echo $item['iface_id'];?>"><?php echo 'UI-'.str_pad($item['typenum'], 2, "0", STR_PAD_LEFT).'-'.str_pad($item['number'], 3, "0", STR_PAD_LEFT);?> </a>
                  <b><?php echo $item['name'];?></a>
                
              </td> 
              <td>
                  <?php if($permission){ ?>

                  <a href="/iface/delete/id/<?php echo $item['id'];?>/ucid/<?php echo $model->id;?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                  <a href="/iface/update/id/<?php echo $item['id'];?>/ucid/<?php echo $model->id;?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
             <?php } ?> 
              </td>
         
        <?php endforeach ?>       
    </tbody>
  </table>

  <?php endif; // end count of results
  
  $this->endWidget();
  ?>
     
       <?php 
$forms = Usecase::model()->getLinkedObjects($model->usecase_id,2,14) ;
     //   Form::model()->getForms($model->usecase_id); // get the requirements with answers



$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Forms',
	'headerIcon' => 'icon-list-alt',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
           'headerButtons' => array(
              
     
)));  
  if (count($forms)):?>

  <table class="table">
  
      <tbody>
  
        <?php foreach($forms as $item) : // Go through each un answered question??>

          <tr class="odd">

              <td>   
                  <a href="/form/view/id/<?php echo $item['form_id'];?>"><?php echo 'UF-'.str_pad($item['number'], 3, "0", STR_PAD_LEFT);?> </a>
                  <b><?php echo $item['name'];?></b>
                
              </td> 
              <td>
                  <?php if($permission){ ?>

                  <a href="/form/delete/id/<?php echo $item['id'];?>/ucid/<?php echo $model->id;?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                  <a href="/form/update/id/<?php echo $item['id'];?>/ucid/<?php echo $model->id;?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
             <?php } ?> 
              </td>
         
        <?php endforeach ?>       
    </tbody>
  </table>

  <?php endif; // end count of results
  
  $this->endWidget();
  ?>    
           </div>
      

<div class="row"> 
    <?php /*
$testcases = Testcase::model()->findAll('usecase_id='.$model->usecase_id); // get the requirements with answers
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
     * 
     */
  ?>
      </div>

</div><!-- form -->