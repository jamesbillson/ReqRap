<?php 
 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;

$data = Rule::model()->getProjectRules($model->id);

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Business Rules',
	'headerIcon' => 'icon-cogs',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
	array(
		'class' => 'bootstrap.widgets.TbButton',
		'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		'label'=> 'Add Rule',
             'visible'=> $edit,
            'url'=>UrlHelper::getPrefixLink('/rule/create/type/0/id/'.$model->id),
	),
	 array(
        'class' => 'bootstrap.widgets.TbButton',
        'type'=>'link',
        'icon'=> 'question-sign',
         'url'=>UrlHelper::getPrefixLink('/help/popview/scope/rules'),
        'htmlOptions' => array('id' => 'popup',),
    ),
           
)
));
?>

<table class="table">
	<thead>
	<tr>
		<th>Number</th>
		<th>Title</th>
<th>Text</th>
                <th>Actions</th>

	</tr>
	</thead>
        <tbody>
<?php if (count($data)):?>
        <?php foreach($data as $item) {?>
        <tr class="odd">  
    <td> <a href="<?php echo UrlHelper::getPrefixLink('/rule/view/id/') ?><?php echo $item['rule_id'];?>"> 
        BR-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?> 
        </a> 
    </td>
   
    <td>   
        <?php if ($item['text']=='stub')echo '<i class="icon-cogs text-warning" rel="tooltip" title="Incomplete Rule"></i>';?>

               <?php
                      
                        $uses=Usecase::model()->getLinkUsecase($item['rule_id'],1,16);
                         if(count($uses)==0){
                        ?>
                        <i class="icon-exclamation-sign text-warning" rel="tooltip" title="Orphan - this Rule is not used."></i>
                         <?php } ?>
            
            
            <?php echo $item['name']; ?>
    </td>
    
    <td>   
        <?php echo $item['text'];?>
        </td>
              


      <td>
           <?php if($edit){ ?>
        <a href="<?php echo UrlHelper::getPrefixLink('/rule/update/id/') ?><?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit Details"></i></a> 
        <a href="<?php echo UrlHelper::getPrefixLink('/rule/delete/id/') ?><?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Remove/Uninvite"></i></a> 
       <a href="<?php echo UrlHelper::getPrefixLink('/rule/history/id/') ?><?php echo $item['rule_id'];?>"><i class="icon-calendar" rel="tooltip" title="Version history"></i></a> 
             
             <?php }  ?> 
        </td>
        </tr>
<?php
        }
        endif; ?>
        
   	</tbody>
</table>

<?php 
$this->endWidget(); ?>

 <?php if($edit){ ?>
<?php $deleted = version::model()->getProjectDeletedVersions($model->id,1);
if (count($deleted)):?>
    

        
<div class="accordion-group">
        <div class="accordion-heading">

         <a class="accordion-toggle" data-toggle="collapse"
          data-parent="#accordionJ" href="#collapseJ">
          Show Deleted Versions</a>
           
     </div>
    
     <div id="collapseJ" class="accordion-body collapse">
        <div class="accordion-inner">
        <table class="table">
        <tbody>
        <?php foreach($deleted as $item) {?>
           <tr class="odd">  
                <td> <a href="<?php echo UrlHelper::getPrefixLink('/rule/view/id/') ?><?php echo $item['rule_id'];?>"> 
                BR-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?></a> 
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
 <?php  } ?>