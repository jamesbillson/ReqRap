
<?php 

 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;

$data = Category::model()->getProjectCategory(Yii::app()->session['project']);

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Simple Requirement Categories',
    'headerIcon' => 'icon-gift',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Category',
         'visible'=> $edit,
        'url'=>UrlHelper::getPrefixLink('/category/create/id/').$model->id,
    ),
    
))); 
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
                        <a href="<?php echo UrlHelper::getPrefixLink('/category/view/id/')?><?php echo $item['category_id'];?>"><b><?php echo $item['name'];?></b></a>
                    </td>

                    <td>
                        <?php echo $item['description'];?>
                    </td>            
                    <td>
                         <?php if($edit){ ?>
                        <a href="<?php echo UrlHelper::getPrefixLink('/category/update/id/')?><?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="<?php echo UrlHelper::getPrefixLink('/category/delete?id=')?><?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete"></i></a> 
                        <a href="<?php echo UrlHelper::getPrefixLink('/category/history/id/')?><?php echo $item['category_id'];?>"><i class="icon-calendar" rel="tooltip" title="Version history"></i></a> 
                         <?php } ?>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget(); ?>
   <?php if($edit){ ?>
<?php $deleted = Version::model()->getProjectDeletedVersions($model->id,6);
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
                <td> <a href="<?php echo UrlHelper::getPrefixLink('/category/view/id/')?><?php echo $item['id'];?>"> 
                Section-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?></a> 
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
<?php  endif; ?>  <?php } ?>