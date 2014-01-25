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
        <a href="/release/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit Details"></i></a> 
        <a href="/rule/delete/id/<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Remove/Uninvite"></i></a> 
    
              
        </td>
        </tr>
          	</tbody>
<?php
        } ?>
<?php endif; ?>        
 
</table>





Finalise this release -<br />
Change the release number on all the active objects.<br />
This means if you roll back, the last version will be wrong.<br />
So...<br /><br />
Copy all the active objects and set the create date to now, and the release to this release.<br />
The old release is then a snapshot.<br /><br />
Things to copy:<br />
<blockquote>
Package<br />
UC<br />
Flows<br />
Steps<br />
Rules<br />
Interfaces<br />
Stepiface<br />
Steprule<br />
Stepform<br />
Forms<br />
Objects<br />
Actors<br />
Iface Types<br />

</blockquote>



