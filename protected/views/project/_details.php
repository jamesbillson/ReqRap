<h3>Release History</h3>
<?php
$data = Release::model()->findAll('project_id='.Yii::app()->session['project']);



?>
<a href="/version/index/id/<?php echo $model->id; ?> ">View Changelog</a>
<table class="table">
	<thead>
	<tr>
		<th>Number</th>
		<th>Status</th>
                <th>Date</th>
                <th>Actions</th>

	</tr>
	</thead>
            <?php if (count($data)):?>
        <tbody>

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
        <a href="/release/copy/id/<?php echo $model->id;?>"><i class="icon-flag" rel="tooltip" title="Copy Release to new project"></i></a>
          <a href="/release/finalise/id/<?php echo $item['id'];?>"><i class="icon-flag" rel="tooltip" title="Finalise Release"></i></a> 
      
          
          <a href="/release/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit Details"></i></a> 
        <a href="/rule/delete/id/<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Remove/Uninvite"></i></a> 
    
              
        </td>
        </tr>
          	</tbody>
<?php
        } ?>
<?php endif; ?>        
 
</table>



