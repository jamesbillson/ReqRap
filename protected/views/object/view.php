<?php 
echo $this->renderPartial('/project/head',array('tab'=>'details'));

$permission=(Yii::App()->session['permission']==1)?true : false; 
?>

 
    	
        
<br>
<a href="/project/view/tab/objects">Back to Objects</a>
<?php 

$permission=(Yii::App()->session['permission']==1)?true : false; 


$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Object:'.$model->name,
    'headerIcon' => 'icon-user',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
      'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Property',
        'visible'=>$permission,
        'url'=>array('objectproperty/create', 'id'=>$model->id)
    )),
));

$data=  Objectproperty::model()->getObjectProperty($model->object_id);
$counter=0;
  if (count($data)):?>

        <table class="table">
            <thead>
                <tr>
                    
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                        <?php echo $item['number'];?>
                    </td>
                    <td>   
                        <?php echo $item['name'];?>
                    </td>
                    <td>   
                        <?php echo $item['description'];?>
                    </td>                  
                   

                  
                    <td>
                        <?php if($permission){ ?>
                        <a href="/objectproperty/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="/objectproperty/delete?id=<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                        <a href="/objectproperty/history/id/<?php echo $item['objectproperty_id'];?>"><i class="icon-calendar" rel="tooltip" title="History"></i></a> 
                        
                            <?php if($counter!=0) { ?>
                            <a href="/objectproperty/move/dir/2/id/<?php echo $item['id'];?>"><i class="icon-arrow-up" rel="tooltip" title="Move Up"></i></a> 
                            <?php } ELSEIF(count($data)>1) {?>   
                           
                            <i class="icon-flag" rel="tooltip" title="Start"></i>
                            <?php } ?>          
                            <?php if($counter!=count($data)-1) { ?>        
                            <a href="/objectproperty/move/dir/1/id/<?php echo $item['id'];?>"><i class="icon-arrow-down" rel="tooltip" title="Move Down"></i></a> 
                            <?php } ELSEIF(count($data)>1) {?>
                             <i class="icon-flag" rel="tooltip" title="End"></i>   
                            <?php } ?> 
                         
                         
                         
                        <?php } ?>
                     
                     
                    </td>
                </tr>
            <?php $counter++; endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget(); ?>


<?php $deleted = Version::model()->getObjectDeletedVersions($model->object_id,6,7);
if (count($deleted)):?>
    

        
<div class="accordion-group">
        <div class="accordion-heading">

         <a class="accordion-toggle" data-toggle="collapse"
          data-parent="#accordionF" href="#collapseF">
          Show Deleted Versions</a>
           
     </div>
    
     <div id="collapseF" class="accordion-body collapse">
        <div class="accordion-inner">
        <table class="table">
        <tbody>
        <?php foreach($deleted as $item) {?>
           <tr class="odd">  
                <td> <a href="/objectproperty/view/id/<?php echo $item['objectproperty_id'];?>"> 
                <?php echo $item['number']; ?></a> 
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