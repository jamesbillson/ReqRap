<?php 

$permission=(Yii::App()->session['permission']==1)?true : false; 

$data = Rule::model()->getProjectRules($model->id);
?>

<table class="table">
	<thead>
	<tr>
		<th>Number</th>
		<th>Title</th>
            <th>Text</th>
 

	</tr>
	</thead>
        <tbody>
<?php if (count($data)):?>
        <?php foreach($data as $item) {?>
        <tr class="odd">  
    <td>  
      BR-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?> 
         
    </td>
   
    <td>   
   <?php echo $item['name']; ?>
    </td>
    
    <td>   
    <?php echo $item['text'];?>
    </td>
              


 
        </tr>
<?php }
endif; ?>
        
   	</tbody>
</table>



 