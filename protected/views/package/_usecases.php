

<?php 
$usecases = Usecase::model()->getUsecases($model->id); // get the requirements with answers



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
                  
                  <?php if($counter!=0) { ?>
                           <a href="/usecase/move/dir/2/id/<?php echo $item['id'];?>"><i class="icon-arrow-up" rel="tooltip" title="Move Up"></i></a> 
                  <?php } ELSE {?>   
                           
                           <i class="icon-flag" rel="tooltip" title="Start"></i>
                     <?php } ?>          
                   <?php if($counter!=count($usecases)-1) { ?>        
                           <a href="/usecase/move/dir/1/id/<?php echo $item['id'];?>"><i class="icon-arrow-down" rel="tooltip" title="Move Down"></i></a> 
         <?php } ?> 
              </td>
              <td> 
                   <a href="/usecase/view/id/<?php echo $item['id'];?>"> UC-<?php echo str_pad($model->number, 2, "0", STR_PAD_LEFT).''.str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?></a>
               </td> 
              <td>
                   <b><?php echo $item['name'];?></a></b>
                
              </td> 
              <td>
               <a href="/usecase/delete/id/<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Edit"></i> 
              
                  <a href="/usecase/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
              </td>
         
        <?php 
        $counter++;
        endforeach ?>       
    </tbody>
  </table>

  <?php endif; // end count of results
  
  $this->endWidget();
  ?>



