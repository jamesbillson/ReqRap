 
<?php 
 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;
$data = Form::model()->getProjectForms(Yii::app()->session['project']);

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Forms',
    'headerIcon' => 'icon-list-alt',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Form',
         'visible'=> $edit,
        'url'=>UrlHelper::getPrefixLink('/form/create/uc/-1/id/'.$model->id),
    ),
     array(
        'class' => 'bootstrap.widgets.TbButton',
        'type'=>'link',
        'icon'=> 'question-sign',
         'url'=>UrlHelper::getPrefixLink('/help/popview/scope/forms'),
        'htmlOptions' => array('id' => 'popup',),
    ),
))); 
   



if (count($data)):?>




        <table class="table">
            <thead>
                <tr>
                    
                    <th>Name</th>
                   
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):
                $fields=  Formproperty::model()->getFormProperty($item['form_id']);
                ?>
                
                <tr class="odd">  
                    <td>   
                         <a href="<?php echo UrlHelper::getPrefixLink('/form/view/id/') ?><?php echo $item['form_id'];?>">
                         UF-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?> 
                    </a> 
                    </td>
                    <td>   
                        <?php echo $item['name'];
                        if (count($fields)==0 ){
                        ?>
                        <i class="icon-list-alt text-warning" rel="tooltip" title="Incomplete Form"></i>
                        <?php } 
                       
                         $uses=Usecase::model()->getLinkUsecase($item['form_id'],2,14);
                         if(count($uses)==0){
                        ?>
                        <i class="icon-exclamation-sign text-warning" rel="tooltip" title="Orphan - this Form is not used."></i>
                         <?php } ?>
                        
                    </td>
                    
                   

                  
                    <td>
                          <?php if($edit){ ?>
                        <a href="<?php echo UrlHelper::getPrefixLink('/form/update/id/')?><?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="<?php echo UrlHelper::getPrefixLink('/form/delete/ucid/') ?><?php echo $model->id;?>/type/2/id/<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                      <a href="<?php echo UrlHelper::getPrefixLink('/form/history/id/') ?><?php echo $item['form_id'];?>"><i class="icon-calendar" rel="tooltip" title="History"></i></a> 
                     <?php } ?>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget(); ?>
<?php if($edit){ ?>
<?php $deleted = Version::model()->getProjectDeletedVersions($model->id,2);
if (count($deleted)):?>
    

        
<div class="accordion-group">
        <div class="accordion-heading">

         <a class="accordion-toggle" data-toggle="collapse"
          data-parent="#accordionE" href="#collapseE">
          Show Deleted Versions</a>
           
     </div>
    
     <div id="collapseE" class="accordion-body collapse">
        <div class="accordion-inner">
        <table class="table">
        <tbody>
        <?php foreach($deleted as $item) {?>
           <tr class="odd">  
                <td> <a href="<?php echo UrlHelper::getPrefixLink('/form/history/id/') ?><?php echo $item['form_id'];?>"> 
                UF-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?></a> 
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
    
    <?php } ?>