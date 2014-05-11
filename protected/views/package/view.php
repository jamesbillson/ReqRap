<?php 
echo $this->renderPartial('/project/head',array('tab'=>'details'));

$permission=(Yii::App()->session['permission']==1)?true : false; 
?>


<?php 
$usecases = Usecase::model()->getPackageUsecases($model->package_id); // get the requirements with answers

$this->renderPartial('/package/printdiagram',array('package'=>$model)); ?>

<br /><br />
<?php

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Use Cases',
	'headerIcon' => 'icon-user',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
           'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButton',
                    'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'label'=> 'Add Use Case',
                    'url'=>'/usecase/create/id/'.$model->id,
                      ),
     
)));  
  if (count($usecases)): ?>

  <table class="table">

      <tbody>
  
        <?php 
        $counter=0;
        foreach($usecases as $item) : // Go through each un answered question??>

          <tr class="odd">

              <td> 
                   <a href="/usecase/view/id/<?php echo $item['usecase_id'];?>"> UC-<?php echo str_pad($model->number, 2, "0", STR_PAD_LEFT).''.str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?></a>
               </td> 
              <td>
                   <b><?php echo $item['name'];?></a></b>
                
              </td> 
              <td>
                  <?php if($permission){ ?>
               <a href="/usecase/delete/id/<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Edit"></i> 
               <a href="/usecase/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
               <a href="/usecase/history/id/<?php echo $item['usecase_id'];?>"><i class="icon-calendar" rel="tooltip" title="History"></i></a> 
              
                            <?php if($counter!=0) { ?>
                            <a href="/version/move/object/10/dir/2/id/<?php echo $item['id'];?>"><i class="icon-arrow-up" rel="tooltip" title="Move Up"></i></a> 
                           
                            <?php } ELSEIF(count($usecases)>1) {?>   
                           
                            <i class="icon-flag" rel="tooltip" title="Start"></i>
                            <?php } ?>          
                            <?php if($counter!=count($usecases)-1) { ?>        
                            <a href="/version/move/object/10/dir/1/id/<?php echo $item['id'];?>"><i class="icon-arrow-down" rel="tooltip" title="Move Down"></i></a> 
                            <?php } ELSEIF(count($usecases)>1) {?>
                             <i class="icon-flag" rel="tooltip" title="End"></i>   
                            <?php } ?> 
                              <?php } ?> 
               </td>
         
        <?php 
        $counter++;
        endforeach ?>       
    </tbody>
  </table>

  <?php endif; // end count of results
  
  $this->endWidget();
  ?>


<?php $deleted = version::model()->getObjectDeletedVersions($model->package_id,5,10);
if (count($deleted)):?>
    

        
<div class="accordion-group">
        <div class="accordion-heading">

         <a class="accordion-toggle" data-toggle="collapse"
          data-parent="#accordionD" href="#collapseD">
          Show Deleted Versions</a>
           
     </div>
    
     <div id="collapseD" class="accordion-body collapse">
        <div class="accordion-inner">
        <table class="table">
        <tbody>
        <?php foreach($deleted as $item) {?>
           <tr class="odd">  
                <td> <a href="/usecase/view/id/<?php echo $item['usecase_id'];?>"> 
                UC-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?></a> 
                </td>
   
                <td> 
                <?php echo $item['name']; ?>
                </td>
    
           </tr>
        <?php }?>
    	</tbody>
        </table>   
            </div>
        </div>
    </div>
<?php  endif; ?>
