<?php 
$link=Yii::App()->session['release'].'_17_'.$model->category_id;
echo $this->renderPartial('/project/head',array('tab'=>'category','link'=>$link));
$permission=Yii::App()->session['permission']; 
 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;
?>
   
<br>
<a href="<?php echo UrlHelper::getPrefixLink('/project/view/tab/category')?>">Back to all sections</a>
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
        'visible'=>$edit,
        'url'=> UrlHelper::getPrefixLink('simple/create/?id='.$model->id)
    )),
));

$data=  Simple::model()->getCategorySimple($model->category_id);
$counter=0; ?>
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
                     <?php echo CHtml::encode($item['name']); ?>
	 </td>
                    <td>   
                        <?php echo $item['description'];?>
                    </td>                  
                   

                  
                    <td>
                        <?php if($edit){ ?>
                        <a href="<?php echo UrlHelper::getPrefixLink('/simple/update/id/')?><?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="<?php echo UrlHelper::getPrefixLink('/simple/delete?id=')?><?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                     <a href="<?php echo UrlHelper::getPrefixLink('/simple/history/id/')?><?php echo $item['simple_id'];?>"><i class="icon-calendar" rel="tooltip" title="History"></i></a> 
                        

 <?php if($counter!=0) { ?>
                            <a href="<?php echo UrlHelper::getPrefixLink('/version/move/object/18/dir/2/id/')?><?php echo $item['id'];?>"><i class="icon-arrow-up" rel="tooltip" title="Move Up"></i></a> 
                           
 <?php } ELSEIF(count($data)>1) {?>   
                           
                            <i class="icon-flag" rel="tooltip" title="Start"></i>
                            <?php } ?>          
                            <?php if($counter!=count($data)-1) { ?>        
                            <a href="<?php echo UrlHelper::getPrefixLink('/version/move/object/18/dir/1/id/')?><?php echo $item['id'];?>"><i class="icon-arrow-down" rel="tooltip" title="Move Down"></i></a> 
                            <?php } ELSEIF(count($data)>1) {?>
                             <i class="icon-flag" rel="tooltip" title="End"></i>   
                            <?php } ?> 



 <?php } ?>
                    </td>
                </tr>
            <?php 
            $counter++;
            endforeach ?>


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
                <td> <a href="<?php echo UrlHelper::getPrefixLink('/simple/view/id/')?><?php echo $item['simple_id'];?>"> 
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