 <?php
 $link=Yii::App()->session['release'].'_10_'.$model->usecase_id;
 echo $this->renderPartial('/project/head',array('tab'=>'usecases','link'=>$link)); 
 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;
 ?>

<?php if($edit){ ?>
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
                    'visible'=>$edit,
                    'url'=>UrlHelper::getPrefixLink('/usecase/update/id/'.$model->id,
                    
                      ),
     array(
                    'class' => 'bootstrap.widgets.TbButton',
                    'type' => 'link', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'icon'=> 'calendar',
                 'visible'=>$edit,
                    'url'=>UrlHelper::getPrefixLink('/usecase/history/id/'.$model->usecase_id),
                    
                      ),
      array(
        'class' => 'bootstrap.widgets.TbButton',
        'type'=>'link',
        'icon'=> 'question-sign',
         'url'=>UrlHelper::getPrefixLink('/help/popview/scope/usecase'),
        'htmlOptions' => array('id' => 'popup',),
    ),
                  
)
          ));  
?>

  <table class="table">

      <tbody>

          <tr class="odd">

              <td>  <a href="<?php echo UrlHelper::getPrefixLink('/package/view/id/')?><?php echo $package['package_id']; ?>"><b>Package</b></a>
              </td>
              <td>   
                  <?php echo $package['name']; ?><a href="<?php echo UrlHelper::getPrefixLink('/usecase/packchange/id/')?><?php echo $model->id; ?>"> <i class="icon-gift" rel="tooltip" title="Move to another package"></i></a>
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
                  <b><a href="<?php echo UrlHelper::getPrefixLink('/actor/view/id/')?><?php echo $item['actor_id'];?>"><?php echo $item['name'];?></a></b>
                
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
  $params['id']=$model->usecase_id;
$params['object']=1;
$params['relationship']=16;
$rules = Usecase::model()->getLinkedObjects($params);



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

              <td>  <a href="<?php echo UrlHelper::getPrefixLink('/rule/view/id/')?><?php echo $item['rule_id'];?>"> BR-<?php echo str_pad($item['number'], 4, "0", STR_PAD_LEFT); ?> </a>
                 <?php if ($item['text']=='stub')echo '<i class="icon-exclamation-sign text-warning" rel="tooltip" title="Incomplete Rule"></i>';?>
             <b><?php echo $item['name'];?></b>
                  </td>
              <td>
                <?php if($edit){ ?>
                <a href="<?php echo UrlHelper::getPrefixLink('/steprule/unlink/id/')?><?php echo $item['xid'];?>/ucid/<?php echo $model->usecase_id;?>"><i class="icon-link text-error" rel="tooltip" title="Unlink this rule"></i></a> 
                <a href="<?php echo UrlHelper::getPrefixLink('/rule/update/id/')?><?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                
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
                  <a href="<?php echo UrlHelper::getPrefixLink('/iface/view/id/')?><?php echo $item['iface_id'];?>"><?php echo 'UI-'.str_pad($item['typenum'], 2, "0", STR_PAD_LEFT).'-'.str_pad($item['number'], 3, "0", STR_PAD_LEFT);?> </a>
                  <b><?php echo $item['name'];?></a>
                
              </td> 
              <td>
                  <?php if($edit){ ?>

                  <a href="<?php echo UrlHelper::getPrefixLink('/stepiface/unlink/id/')?><?php echo $item['xid'];?>/ucid/<?php echo $model->usecase_id;?>"><i class="icon-link text-error" rel="tooltip" title="Unlink from Usecase"></i></a> 
                  <a href="<?php echo UrlHelper::getPrefixLink('/iface/update/id/')?><?php echo $item['id'];?>/ucid/<?php echo $model->id;?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
             <?php } ?> 
              </td>
         
        <?php endforeach ?>       
    </tbody>
  </table>

  <?php endif; // end count of results
  
  $this->endWidget();
  ?>
     
       <?php 
       
       $params['id']=$model->usecase_id;
$params['object']=2;
$params['relationship']=14;
       
$forms = Usecase::model()->getLinkedObjects($params) ;



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
                  <?php if($edit){ ?>

                  <a href="<?php echo UrlHelper::getPrefixLink('/stepform/unlink/id/')?><?php echo $item['xid'];?>/ucid/<?php echo $model->usecase_id;?>"><i class="icon-link text-error" rel="tooltip" title="Unlink from Usecase"></i></a> 
                  <a href="<?php echo UrlHelper::getPrefixLink('/form/update/id/')?><?php echo $item['id'];?>/ucid/<?php echo $model->id;?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
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