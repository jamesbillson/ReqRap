<?php echo $this->renderPartial('/project/head',array('tab'=>'forms'));

$permission=Yii::App()->session['permission']; 
?>


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
                        <a href="<?php echo UrlHelper::getPrefixLink('/formproperty/delete?id=')?><?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete"></i></a> 
                     <a href="<?php echo UrlHelper::getPrefixLink('/formproperty/history/id/')?><?php echo $item['formproperty_id'];?>"><i class="icon-calendar" rel="tooltip" title="History"></i></a> 
                   <?php } ?>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget(); ?>



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