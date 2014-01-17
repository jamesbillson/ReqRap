<h3>Release History</h3>
<?php
$data = Release::model()->findAll('project_id='.$model->id);



?>

<table class="table">
	<thead>
	<tr>
		<th>Number</th>
		<th>Status</th>
                <th>Date</th>
                <th>Actions</th>

	</tr>
	</thead>
        <tbody>
<?php if (count($data)):?>
        <?php foreach($data as $item) {?>
        <tr class="odd">  
        <td>   
        <?php echo $item['number']; ?> 
        </td>
   
<td>   
       <?php echo Release::$status[$item['status']];?>
        </td>
    
    <td>   
        <?php echo $item['create_date'];?>
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

<?php endif; ?>