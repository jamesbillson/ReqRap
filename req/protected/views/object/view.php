<?php 
$link=Yii::App()->session['release'].'_6_'.$model->object_id;
echo $this->renderPartial('/project/head',array('tab'=>'objects','link'=>$link));
 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;
?>

 
    	
        
<br>
<a href="<?php echo UrlHelper::getPrefixLink('/project/view/tab/objects')?>">Back to Objects</a>
<?php 


$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Object: '.$model->name,
    'headerIcon' => 'icon-user',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
      'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Property',
        'visible'=>$edit,
        'url'=>UrlHelper::getPrefixLink('/objectproperty/create/?id='.$model->id.'&type=1')
    ),
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Relationship',
        'visible'=>$edit,
        'url'=> UrlHelper::getPrefixLink('objectproperty/create/?id='.$model->id.'&type=2'),
    ),
) ));


$data=  Objectproperty::model()->getObjectProperty($model->object_id);
$counter=0;
  if (count($data)):?>

        <table class="table">
            <tr><td>
                <?php echo$model->description; ?>
                </td>
            </tr>
        </table>
   <table class="table">
            </tr>
            <thead>
                <tr>
                    <th>Ref.</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Description</th>
                    <?php if($edit){ ?>
                    <th>Actions</th> 
                    <?php } ?>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                        <?php echo $item['number'];?>
                    </td>
 
                        <?php 
                        if($item['type']==1){
                        echo '<td>Property</td><td>'.$item['name'];
                        }
                         else {
                             echo '<td>Relationship</td><td>';
                            //echo 'relation to this object with object_id='.$item['name'];
                            $object=Object::model()->findbyPK(Version::model()->getVersion($item['object_id'],6));
                            echo 'OB-'.str_pad($object->number, 3, "0", STR_PAD_LEFT).' '.$object->name;
                            }
                        
                        ?>
                    </td>
                    <td>   
                        <?php echo $item['description'];?>
                    </td>                  
                   

                  
                    <td>
                        <?php if($edit){ ?>
                        <a href="<?php echo UrlHelper::getPrefixLink('/objectproperty/update/id/')?><?php echo $item['id'];?>/type/<?php echo $item['type'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="<?php echo UrlHelper::getPrefixLink('/objectproperty/delete?id=')?><?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                        <a href="<?php echo UrlHelper::getPrefixLink('/objectproperty/history/id/')?><?php echo $item['objectproperty_id'];?>"><i class="icon-calendar" rel="tooltip" title="History"></i></a> 
                        
                     
                        <?php if($counter!=0) { ?>
                            <a href="<?php echo UrlHelper::getPrefixLink('/version/move/object/7/dir/2/id/')?><?php echo $item['id'];?>"><i class="icon-arrow-up" rel="tooltip" title="Move Up"></i></a> 
                           
                        <?php } ELSEIF(count($data)>1) {?>   
                           
                            <i class="icon-flag" rel="tooltip" title="Start"></i>
                            <?php } ?>          
                            <?php if($counter!=count($data)-1) { ?>        
                            <a href="<?php echo UrlHelper::getPrefixLink('/version/move/object/7/dir/1/id/') ?><?php echo $item['id'];?>"><i class="icon-arrow-down" rel="tooltip" title="Move Down"></i></a> 
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
                <td> <a href="<?php echo UrlHelper::getPrefixLink('/objectproperty/view/id/')?><?php echo $item['objectproperty_id'];?>"> 
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