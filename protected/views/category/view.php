<?php 
echo $this->renderPartial('/project/head',array('tab'=>'details'));
$permission=(Yii::App()->session['permission']==1)?true : false; 
?>
   
<br>
<?php 

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Category:'.$model->name,
    'headerIcon' => 'icon-user',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
      'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Simple Requirement',
        'visible'=>$permission,
        'url'=>array('simple/create', 'id'=>$model->id)
    )),
));

$data=  Simple::model()->getCategorySimple($model->category_id); ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Requirement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <?php
  if (count($data)){?>


            
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
                        <a href="/simple/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="/simple/delete?id=<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete"></i></a> 
                     <a href="/simple/history/id/<?php echo $item['simple_id'];?>"><i class="icon-calendar" rel="tooltip" title="History"></i></a> 
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach ?>


  <?php } ?>
              </tbody>
        </table>
<?php $this->endWidget(); 
   
    ?>
   
   


<?php $deleted = Version::model()->getObjectDeletedVersions($model->category_id,17,18);
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
                <td> <a href="/simple/view/id/<?php echo $item['simple_id'];?>"> 
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