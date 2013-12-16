                  <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'step-form',
                    'enableAjaxValidation'=>false,
                    )); ?>
                        
                        <?php
$steps = Step::model()->getFlowSteps($model->flow->id);
if (count($steps)):

 ?>  

  <table class="table"><tbody>
  
        <?php foreach($steps as $item) : // Go through each un answered question??>

          <tr class="odd">
             <td>  <div class="form">

                 <?php if($item['number']==$model->number) { // THIS IS THE STEP WE ARE EDITING?>
                
                    
                 <?php echo $form->errorSummary($model); ?>
                 <?php echo $form->hiddenfield($model,'flow_id',array('value'=>$model->flow->id)); ?>
                 
		 Adding/Editing step 
                     <?php echo $model->number; ?>
                 to flow 
                     <?php echo $model->flow->name; ?>.
                 </td></tr>
                 <tr><td>

                 <div class="row">
		 Step text:
		 <?php echo $form->textArea($model,'text',array('rows'=>3, 'cols'=>80)); ?>
		 <?php echo $form->error($model,'text'); ?>
		 <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
                 </div> 
      
                 </div>
                  
   
                  <?php  } ELSE { ?>
                 <b>Step <?php echo $item['number'];?>:</b> <?php echo $item['text'];?>
                  <?php } ?>
              </td> 
              <td>  Add an interface(need to do type and then iface)<br />
                   <?php
                  $links = Iface::model()->getStepIfaces($item['id']);
                foreach($links as $link){?>
                
                   <?php echo $link['number'];?>  <?php echo $link['name'];?> <a href="/iface/stepremove/id/<?php echo $link['id'];?>"><i class="icon-remove-sign"></i></a>
                    
               <?php }
                  ?>
                <br />
                 
                 <?php
                  $interfaces = Iface::model()->findAll('step_id='.$model->id);
                ?>   
                <form action="/step/addiface/id/<?php echo $item['id'];?>">
                 <select>
                 <?php foreach($interfaces as $iface){?>
                     <option value="<?php echo $iface->iface->id;?>"><?php echo $iface->iface->name;?></option>
                 <?php } ?>
                     
                 </select>
                  <br />Add a new one
                     <input type="text" name="new_interface">
                     <input type="submit">
               </form>
                
            </td>  <td>
     
                 Add a rule<br />
                  <?php
                  $links = Rule::model()->getStepRules($item['id']);
                foreach($links as $link){?>
                
                   <?php echo $link['number'];?>  <?php echo $link['name'];?> <a href="/iface/stepremove/id/<?php echo $link['id'];?>"><i class="icon-remove-sign"></i></a>
                    
               <?php }
                  ?>
                <br />
                 
                 <?php
                  $interfaces = Rule::model()->findAll('project_id='.$model->flow->usecase->package->project->id);
                ?>   
                <form action="/step/addiface/id/<?php echo $item['id'];?>">
                 <select>
                 <?php foreach($interfaces as $iface){?>
                     <option value="<?php echo $iface['id'];?>"><?php echo $iface['text'];?></option>
                 <?php } ?>
                     
                 </select>
                  <br />Add a new one
                     <input type="text" name="new_interface">
                     <input type="submit">
               </form>
              </td>
         
        <?php endforeach ?>   
      
    </tbody>
  </table>

  <?php endif; // end count of results ?>
  
  

    
<?php if($model->flow->main!=1) { // THIS IS AN ALTERNATE FLOW?>  
    
    <h3>Alternate Flow Start and End Points</h3>
    
 <?php
 
$steps = Step::model()->getMainSteps($model->flow->usecase->id); // get the requirements with answers
 if (count($steps)):?>

  <table class="table">
  	
      <tbody>
  
        <?php foreach($steps as $item) : // Go through each un answered question??>

          <tr class="odd">

              <td>   
                  <b><?php echo $item['flow'];?>(<?php echo $item['number'];?>): <?php echo $item['text'];?></b>
                
              </td> 
              <td>
              <?php if($item['number']==$model->flow->startstep_id) { // THIS IS Start step?>
                  Start
                 <?php } ELSE { ?>
                    <a href="/step/update/id/<?php echo $item['id'];?>"><i class="icon-chevron-right" rel="tooltip" title="Move the START of this flow here"></i></a> 
               
                  <?php } ?>
                  <?php if($item['number']==$model->flow->rejoinstep_id) { // THIS IS Start step?>
                  END  
                      <?php } ELSE { ?>
                  <a href="/flow/create/start/<?php echo $item['id'];?>/id/<?php echo $model->id;?>"><i class="icon-chevron-left" rel="tooltip" title="Move the END of this Flow Here"></i></a> 
              <?php } ?>
              </td>
         
        <?php endforeach ?>   
      
    </tbody>
  </table>

  <?php endif; // end count of results

  ?>
    


      <?php } ?>
             <?php $this->endWidget(); ?>    