<?php 
$permission=(Yii::App()->session['permission']==1)?true : false; 
$data = Testcase::model()->getProjectTC($model->id);


$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Test Cases',
	'headerIcon' => 'icon-check',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
	array(
		'class' => 'bootstrap.widgets.TbButton',
		'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		'label'=> 'Add Rule',
            'visible'=> $permission,
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

                <th>Actions</th>

	</tr>
	</thead>
        <tbody>
<?php if (count($data)):?>
        <?php foreach($data as $item) {?>
        <tr class="odd">  
    <td> <a href="/testcase/view/id/<?php echo $item['id'];?>"> 
        TC-<?php echo str_pad($item['ucnumber'], 3, "0", STR_PAD_LEFT); ?>-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?> 
        </a> 
    </td>
   
    <td>   
            
            
            <?php echo $item['name']; ?>
    </td>
    
  


      <td>
           <?php if($permission){ ?>
        <a href="/testcase/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit Details"></i></a> 
        <a href="/testcase/delete/id/<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Remove/Uninvite"></i></a> 
           <?php } ?>
              
        </td>
        </tr>
<?php
        }
        endif; ?>
        
   	</tbody>
</table>

<?php 
$this->endWidget(); ?>

