<h1><a href="/project/view/tab/rules/id/<?php echo $model->project->id;?>"><?php echo $model->project->name;?></a></h1>


<h2>View Rule BR-<?php echo str_pad($model->number, 3, "0", STR_PAD_LEFT); ?>     
    <a href="/rule/update/id/<?php echo $model->id;?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
           </h2>


	<b><?php echo CHtml::encode($model->getAttributeLabel('title')); ?>:</b>
        <br />
	<?php echo CHtml::encode($model->title); ?>
	<br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('text')); ?>:</b>
	<br />
            <?php echo CHtml::encode($model->text); ?>
        <h3>Uses</h3>
        
        <?php 
 $steprule=(Steprule::model()->findAll('rule_id='.$model->rule_id));
 if(!count($steprule)){
 $usecases= Usecase::model()->getProjectUCs($model->project->id);
 ?>
 This Rule is not used.<br />
 Associate with Use Case
 
      <form action="/rule/createinline/" method="POST">
                    
                    <input type="hidden" name="rule_id" value="<?php echo $model->id;?>">
                 <select name="usecase">
                 <?php foreach($usecases as $uc){?>
                     <option value="<?php echo $uc['id'];?>"><?php echo $uc['name'];?></option>
                 <?php } ?>
                     
               
                 </select>
                    
                    Dynamically load all the steps here so you can choose the step and associate the Rule.
                 <select name="step">
                 <?php foreach($usecases as $uc){?>
                   <option value="<?php echo $uc['id'];?>"><?php echo $uc['name'];?></option>
                 <?php } ?>
                     
               
                 </select>
                     <input type="submit" value="add" class="btn primary">
               </form>
 
 
 <?php } ELSE { ?>
 Interface is used in the following UC's:<br />
   <?php foreach($steprule as $item){?>
 <a href="/usecase/view/id/<?php echo $item->step->flow->usecase->id;?>">
       <?php  echo 'UC-'.str_pad($item->step->flow->usecase->package->sequence, 2, "0", STR_PAD_LEFT).
         str_pad($item->step->flow->usecase->number, 3, "0", STR_PAD_LEFT);?>
 </a>
         <?php echo $item->step->flow->usecase->name;?> 
         (<a href="/step/update/id/-1/flow/<?php echo $item->step->flow->id;?>"><?php echo $item->step->flow->name;?> Flow</a>)
           

 <?php } ?>
 <?php } ?>
    
<h3>Version History</h3>    
        
        <table>
        <?php if (count($versions)){?>
        <?php foreach($versions as $item) {?>
        <tr class="odd">  
        <td>   
    <?php if ($item['id'] != $model->id){    ?> 
          <a href="/rule/rollback/id/<?php echo $item['id'];?>"><i class="icon-repeat" rel="tooltip" title="Roll Back to this Version"></i></a> 
    <?php  } ELSE { ?> 
     <i class="icon-circle-arrow-right" rel="tooltip" title="Current Version"></i> 
   
  <?php   } ?> 
        </td>
            <td>   
        Version <?php echo $item['ver_numb']; ?> 
        </td>
        <td>   
        <?php echo $item['create_date']; ?> 
             <?php echo $item['firstname'].' '.$item['lastname']; ?> 
                 </td>
        <td> 
            Action:  <?php echo Version::$actions[$item['action']]; ?>   
        </td>
        </tr>
        <?php } } ?>
</table>
        

