                
                        
    <?php
    $project=Yii::App()->session['project']; 
    $permission=(Yii::App()->session['permission']==1)?true : false; 
    $steps = Step::model()->getFlowSteps($model->id);
    if (count($steps)):
        
     ?>  

  <table class="table"><tbody>
  
        <?php foreach($steps as $item) : // Go through each un answered question??>

          <tr class="odd">
            

                 <?php if($item['id']==$id && $permission) { // THIS IS THE STEP WE ARE EDITING?>
                 <td> 
                      <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'step-form',
                    'enableAjaxValidation'=>false,
                    )); ?>
                 <?php echo $form->errorSummary($step); ?>
                 <?php echo $form->hiddenfield($step,'flow_id',array('value'=>$model->id)); ?>
                 
		
                

              
                     <b>Step <?php echo $item['number']; ?></b>
            
		 <?php echo $form->textArea($step,'text',array('rows'=>3, 'cols'=>80)); ?>
		 <?php echo $form->error($step,'text'); ?>
		 
      
                <br />
                     <b>Result</b>
		 <?php echo $form->textArea($step,'result',array('rows'=>3, 'cols'=>80)); ?>
		 <?php echo $form->error($step,'result'); ?>
                     
                     
                     
 <?php     
           $actors = Actor::model()->getProjectActors($project); ?>
                     <select name="Step[actor_id]">
  <?php     foreach($actors as $actor){
           echo '<option value="'.$actor['actor_id'].'"';
       if($actor['actor_id']==$usecase['actor_id'])  echo 'selected'; 
       echo'>'.$actor['name'].'</option>';
  }
           ?> 
               </select>
                     
                     
		 <?php echo CHtml::submitButton($step->isNewRecord ? 'Create' : 'Save'); 
                   $this->endWidget();    ?>
                     
                     
                     
                     
                     
                     
                 </td>
                 <td>
                       <strong>Interfaces</strong><br />
                  <?php 
                  //$links = Iface::model()->getStepIfaces($item['id']);
                  $links = Step::model()->getStepLinks($item['id'],12,15);
                  foreach($links as $link){?>
                 <a href="/iface/view/id/<?php echo $link['iface_id'];?>"> UI-<?php echo str_pad($link['number'], 4, "0", STR_PAD_LEFT); ?>  </a>
                      <?php echo $link['name'];?> <a href="/stepiface/delete/id/<?php echo $link['xid'];?>"><i class="icon-remove-sign"></i></a><br />
                  <?php }  ?>
                <br />
                 
                 <?php $interfaces = Iface::model()->getProjectIfaces($project);?>   
                <form action="/stepiface/createinline/" method="POST">
                    
                 <input type="hidden" name="step_id" value="<?php echo $item['step_id'];?>">
                 <input type="hidden" name="project_id" value="<?php echo $project;?>">
                 <input type="hidden" name="step_db_id" value="<?php echo $item['id'];?>">
                 
                 <select name="interface">
                 <?php foreach($interfaces as $iface){?>
                     <option value="<?php echo $iface['iface_id'];?>"><?php echo $iface['name'];?></option>
                 <?php } ?>
                     
                 </select>
                     <br />Add a new one
                     <input type="text" name="new_interface">
                     <input type="submit" value="add" class="btn primary">
               </form>
                
            </td>  <td>
     
                <strong>Rules</strong><br />
                  <?php
                 // $links = Rule::model()->getStepRules($item['id']);
                  $links = Step::model()->getStepLinks($item['id'],1,16);
                foreach($links as $link){?>
                <a href="/rule/view/id/<?php echo $link['rule_id'];?>"> BR-<?php echo str_pad($link['number'], 3, "0", STR_PAD_LEFT); ?></a>  <?php echo $link['title'];?> <a href="/steprule/delete/id/<?php echo $link['xid'];?>"><i class="icon-remove-sign"></i></a><br/>
                
                 <?php } ?>
                <br />
                 
                 <?php $rules = Rule::model()->findAll('project_id='.$project); ?>   
                        <form action="/steprule/createinline/" method="POST">
                        <input type="hidden" name="step_id" value="<?php echo $item['id'];?>">
                        <input type="hidden" name="project_id" value="<?php echo $project;?>">
                        <input type="hidden" name="step_db_id" value="<?php echo $item['id'];?>">
                        <select name="rule">
                            <?php foreach($rules as $rule){?>
                            <option value="<?php echo $rule['rule_id'];?>"><?php echo $rule['title'];?></option>
                            <?php } ?>
                        </select>
                        <br />Add a new one
                        <input type="text" name="new_rule">
                        <input type="submit" value="add" class="btn primary">
                        </form>
                        </td>
         
   <td>
     
                <strong>Forms</strong><br />
                  <?php
                  //$links = Form::model()->getStepForms($item['id']);
                  $links = Step::model()->getStepLinks($item['id'],2,14); // centralise all these.
                foreach($links as $link){?>
                 UF-<?php echo str_pad($link['number'], 3, "0", STR_PAD_LEFT); ?>  <?php echo $link['name'];?> <a href="/stepform/delete/id/<?php echo $link['xid'];?>"><i class="icon-remove-sign"></i></a><br/>
                 <?php } ?>
                <br />
                 
                 <?php $forms = Form::model()->findAll('project_id='.$project); ?>   
                        <form action="/stepform/createinline/" method="POST">
                        <input type="hidden" name="step_id" value="<?php echo $item['id'];?>">
                         <input type="hidden" name="project_id" value="<?php echo $project;?>">
                      <input type="hidden" name="step_db_id" value="<?php echo $item['id'];?>">
                        <select name="form">
                            <?php foreach($forms as $form){?>
                            <option value="<?php echo $form['form_id'];?>"><?php echo $form['name'];?></option>
                            <?php } ?>
                        </select>
                        <br />Add a new one
                        <input type="text" name="new_form">
                        <input type="submit" value="add" class="btn primary">
                        </form>
                        </td>
                  <?php  } 
                  ELSE 
                      { // THIS IS NOT THE EDIT ROW, SHOW THE RELATED IFACE AND RULES ?>
                    
                    <td>  
                          <?php if($permission){ ?>
                        <a href="/step/insert/id/<?php echo $item['id'];?>"><i class="icon-chevron-right" rel="tooltip" title="Insert a new step before this step"></i></a> 
                        <a href="/step/delete/id/<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete this step"></i></a> 
                       <a href="/step/update/flow/1/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                          <?php } ?> 
                       <b>Step <?php echo $item['number'];?>:</b> 
                             </td> </tr>
          <tr>
              <td> <b>Action:</b><br />
                            <?php echo $item['text'];?>
                  <br />
                        <b>Result:</b><br /><?php echo $item['result'];?>
                    </td>
                    <td>
                   
                        <?php 
                        $links = Step::model()->getStepLinks($item['id'],12,15); 
                          if (count($links)){?>
                        
                        <strong>Interfaces</strong>
                    <br />
                        <?php
                        foreach($links as $link){?>
                    <a href="/iface/view/id/<?php echo $link['iface_id'];?>">UI-<?php echo str_pad($link['number'], 4, "0",STR_PAD_LEFT);?></a>  <?php echo $link['name'];?> 
                         <a href="/stepiface/delete/id/<?php echo $link['xid'];?>"><i class="icon-remove-sign"></i></a><br/>
                        <?php }   ?>
                         <br />
              <?php }   ?>
             
                   
                   
                        <?php 
                        $links = Step::model()->getStepLinks($item['id'],1,16);
                        if (count($links)){?>
                       
                        <strong>Rules</strong>
                       <br />
                            <?php
                        foreach($links as $link){?>
                       <a href="/rule/view/id/<?php echo $link['rule_id'];?>">BR-<?php echo str_pad($link['number'], 4, "0",STR_PAD_LEFT);?></a>  <?php echo $link['title'];?> 
                        <a href="/steprule/delete/id/<?php echo $link['xid'];?>"><i class="icon-remove-sign"></i></a>
                        <br />
                        <?php } ?>
                         <br />
                    
                          <?php } ?>
                        
                   
                
                        <?php $links = Step::model()->getStepLinks($item['id'],2,14);
                          if (count($links)){?>
                           
                        <strong>Forms</strong>
                        <br />
                       <?php  foreach($links as $link){?>
                        <a href="/form/view/id/<?php echo $link['form_id'];?>">UF-<?php echo str_pad($link['number'], 4, "0",STR_PAD_LEFT);?> </a> <?php echo $link['name'];?> 
                        <a href="/stepform/delete/id/<?php echo $link['xid'];?>"><i class="icon-remove-sign"></i></a>
                        <br />
                        <?php }?>
                        </td></tr>
                        <?php }?>
                    
                  <?php } ?>
            
             
        <?php endforeach ?>   
      
    </tbody>
  </table>
           <?php if($permission){ ?>
                      

 <a href="/step/create/id/<?php echo $model->id;?>"><i class="icon-plus-sign-alt" rel="tooltip" title="Add another step"></i> Add Step</a> 
        <?php } ?>     

  <?php endif; // end count of results ?>
  

    
<?php if($model->main!=1) { // THIS IS AN ALTERNATE FLOW So we show the main flow entry and exit?>  
    
    <h4>Alternate Flow <?php echo $model->name;?> Start and End Points</h4>
    
 <?php
 
$steps = Step::model()->getMainSteps($usecase['id']); // get the requirements with answers
 if (count($steps)):?>

  <table class="table">
  	
      <tbody>
  
        <?php foreach($steps as $item) : // Go through each un answered question??>

          <tr class="odd">

              <td>   
                  <b><?php echo $item['flow'];?>(<?php echo $item['number'];?>):</b> <?php echo $item['text'];?>
                
              </td> 
              <td>
              <?php if($item['step_id']==$model->startstep_id ) { // THIS IS Start step?>
                  Start
                 <?php } ELSE { ?>
                    <a href="/flow/updateendpoints/end/1/flow/<?php echo $model->id;?>/id/<?php echo $item['step_id'];?>"><i class="icon-chevron-right" rel="tooltip" title="Move the START of this flow here"></i></a> 
               
                  <?php } ?>
                  <?php if($item['step_id']==$model->rejoinstep_id) { // THIS IS Start step?>
                  END  
                      <?php } ELSE { ?>
                  <a href="/flow/updateendpoints/end/2/id/<?php echo $item['step_id'];?>/flow/<?php echo $model->id;?>"><i class="icon-chevron-left" rel="tooltip" title="Move the END of this Flow Here"></i></a> 
              <?php } ?>
              </td>
         
        <?php endforeach ?>   
      
    </tbody>
  </table>

  <?php endif; // end count of results  ?>
    
 <a href="/step/create/id/<?php echo $model->id;?>"><i class="icon-plus-sign-alt" rel="tooltip" title="Add another step"></i> Add Step</a> 
    


      <?php } ?>
            