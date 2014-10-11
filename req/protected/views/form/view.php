<?php
$link=Yii::App()->session['release'].'_2_'.$model->form_id;
 echo $this->renderPartial('/project/head',array('tab'=>'forms'));
 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;
$permission=Yii::App()->session['permission']; 

?>

<a href="/project/view/">Back to Forms</a>
<?php 
//$data=Formproperty::model()->findAll('form_id='.$model->form_id);
$data = Formproperty::model()->getFormProperty($model->form_id);
//$deleted = Formproperty::model()->getProjectDeletedRules($model->id);
  

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Form:UF'.str_pad($model->number, 4, "0", STR_PAD_LEFT).' '.$model->name,
    'headerIcon' => 'icon-list-alt',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
      'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Form Property',
        'visible'=>$edit,
        'url'=>UrlHelper::getPrefixLink('formproperty/create/?id=').$model->form_id
    )),
));


  if (count($data)):?>

        <table class="table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Validation</th>
                    <th>Required</th>
                    <?php if($edit){ ?>
                    <th>Actions</th>
                    <?php } ?>
                </tr>
            </thead>
            
            <tbody>
            <?php $counter=0; foreach($data as $item):?>
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
                        <?php echo $item['type'];?>
                    </td>                    
                    <td>   
                        <?php echo $item['valid'];?>
                    </td> 
                    <td>   
                        <?php echo ($item['required']==1)?'Yes':'No';?>
                    </td>                   
                    <td>
                   <?php if($edit){ ?>
                        <a href="<?php echo UrlHelper::getPrefixLink('/formproperty/update/id/')?><?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="<?php echo UrlHelper::getPrefixLink('/formproperty/delete/id/')?><?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                     <a href="<?php echo UrlHelper::getPrefixLink('/formproperty/history/id/')?><?php echo $item['formproperty_id'];?>"><i class="icon-calendar" rel="tooltip" title="History"></i></a> 
                   
                            <?php if($counter!=0) { ?>
                            <a href="<?php echo UrlHelper::getPrefixLink('/formproperty/move/dir/2/id/')?><?php echo $item['id'];?>"><i class="icon-arrow-up" rel="tooltip" title="Move Up"></i></a> 
                            <?php } ELSEIF(count($data)>1) {?>   
                           
                            <i class="icon-flag" rel="tooltip" title="Start"></i>
                            <?php } ?>          
                            <?php if($counter!=count($data)-1) { ?>        
                            <a href="<?php echo UrlHelper::getPrefixLink('/formproperty/move/dir/1/id/')?><?php echo $item['id'];?>"><i class="icon-arrow-down" rel="tooltip" title="Move Down"></i></a> 
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

       <h4>Traceability</h4>
        
        <?php 

 $stepform=Usecase::model()->getLinkUsecase($model->form_id,2,14);
 if(!count($stepform)){
  
 ?>
       <div class="row offset1">
 This Form is an orphan, it is not used by any Use Case.
       </div>
 <div class="row">

     <?php  echo $this->renderPartial('_associate',array('id'=>$model->form_id)); ?>
 </div>
 <br />
 <?php } ELSE { ?>
 Interface is used in the following UC's:<br />
   <?php foreach($stepform as $item){?>
 <a href="<?php echo UrlHelper::getPrefixLink('/usecase/view/id/')?><?php echo $item['usecase_id'];?>">
       <?php  echo 'UC-'.str_pad($item['package_number'], 2, "0", STR_PAD_LEFT).
         str_pad($item['usecase_number'], 3, "0", STR_PAD_LEFT);?>
 </a>
         <?php echo $item['usecase_name'];?> 
         (<a href="<?php echo UrlHelper::getPrefixLink('/step/update/id/-1/flow/')?><?php echo $item['flow_id'];?>"><?php echo $item['flow_name'];?> Flow</a>)
           
         <br />
 <?php } ?>
 <?php } ?>

 <?php if($edit){ ?>





<?php $deleted = Version::model()->getObjectDeletedVersions($model->form_id,2,3);
if (count($deleted)):?>
    

        
<div class="accordion-group">
        <div class="accordion-heading">

         <a class="accordion-toggle" data-toggle="collapse"
          data-parent="#accordionE" href="#collapseE">
          Show Deleted Properties</a>
           
     </div>
    
     <div id="collapseE" class="accordion-body collapse">
        <div class="accordion-inner">
        <table class="table">
        <tbody>
        <?php foreach($deleted as $item) {?>
           <tr class="odd">  
                <td> <a href="<?php echo UrlHelper::getPrefixLink('/form/history/id/')?><?php echo $item['form_id'];?>"> 
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
<?php  endif; ?>    <?php } ?>