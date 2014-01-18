<?php 
$data = Rule::model()->getProjectRules($model->id);
        
        /*Rule::model()->findAll(array('order'=>'number ASC',
    'condition'=>'project_id=:x',
    'params'=>array(':x'=>$model->id)));
*/


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
            'url'=>'/rule/create/type/0/id/'.$model->id,
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
    <td> <a href="/rule/view/id/<?php echo $item['id'];?>"> 
        BR-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?> 
        </a> 
    </td>
   
    <td>   
        <?php if ($item['text']=='stub')echo '<i class="icon-cogs text-warning" rel="tooltip" title="Incomplete Rule"></i>';?>

               <?php
                         if(!count(Steprule::model()->findAll('rule_id='.$item['id']))){
                        ?>
                        <i class="icon-exclamation-sign text-warning" rel="tooltip" title="Orphan - this Rule is not used."></i>
                         <?php } ?>
            
            
            <?php echo $item['title']; ?>
    </td>
    
    <td>   
        <?php echo $item['text'];?>
        </td>
              


      <td>
        <a href="/rule/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit Details"></i></a> 
        <a href="/rule/delete/id/<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Remove/Uninvite"></i></a> 
    
              
        </td>
        </tr>
<?php
        } ?>
        
   	</tbody>
</table>

<?php endif;
$this->endWidget(); ?>