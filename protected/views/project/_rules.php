<?php 
$data = Rule::model()->findAll(array('order'=>'number', 'condition'=>'project_id=:x', 'params'=>array(':x'=>$model->id)));


$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Business Rules',
	'headerIcon' => 'icon-signal',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
	array(
		'class' => 'bootstrap.widgets.TbButton',
		'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		'label'=> 'Add Rule',
            'url'=>'/rule/create?id='.$model->id,
	),
	
           
)
));
?>

<table class="table">
	<thead>
	<tr>
		<th>Number</th>
		<th>Detail</th>

                <th>Actions</th>

	</tr>
	</thead>
        <tbody>
<?php if (count($data)):?>
        <?php foreach($data as $item) {?>
        <tr class="odd">  
        <td>   
        <?php echo $item['number'];?>
        </td>
   

    
    <td>   
        <?php echo $item['text'];?>
        </td>
              


      <td>
        <a href="/claimstage/view/id/<?php echo $item['id'];?>"><i class="icon-eye-open" rel="tooltip" title="View"></i></a> 
        <a href="/claimstage/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit Details"></i></a> 
        <a href="/claimstage/remove?id=<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Remove/Uninvite"></i></a> 
    
              
        </td>
        </tr>
<?php
        } ?>
        
   	</tbody>
</table>

<?php endif;
$this->endWidget(); ?>