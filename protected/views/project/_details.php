<h3>Release History</h3>
<?php
//$data = Release::model()->findAll('project_id='.Yii::app()->session['project']);
$data = Release::model()->findAll(array('order'=>'number ASC', 'condition'=>'project_id=:x', 'params'=>array(':x'=>Yii::app()->session['project'])));
$release = Yii::App()->session['release'];
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
        <td> <?php if ($item['id']==$release){;?>  
        <?php echo $item['number']; ?> 
        
              <?php } ELSE {?>
        R-<?php echo FLOOR($item['number']); ?>
          <?php } ?>
        </td>
   
<td>   
       <?php echo Release::$status[$item['status']];?> <?php if ($item['id']!=$release) echo ' @ change '.$item['offset'] ;?>
        </td>
    
    <td>   
        <?php echo $item['create_date'];?>
        </td>
              


      <td>
           <?php if ($item['id']==$release){;?>
          <a href="/release/finalise/id/<?php echo $item['id'];?>"><i class="icon-certificate" rel="tooltip" title="Finalise Release"></i></a> 
           
              <?php } ELSE {?>
          
            <a href="/library/create/id/<?php echo $item['id'];?>"><i class="icon-book text-success" rel="tooltip" title="Add to library"></i></a> 
      <a href="/release/copy/id/<?php echo $item['id'];?>"><i class="icon-copy" rel="tooltip" title="Copy Release to new project"></i></a>
         <a href="/release/delete/id/<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Remove"></i></a> 
     <a href="/testcase/create/id/<?php echo $item['id'];?>"><i class="icon-check" rel="tooltip" title="Create Test Cases"></i></a> 
    
             <?php } ?>
          
        
          
          
        <a href="/release/set/id/<?php echo $item['id'];?>"><i class="icon-eye-open " rel="tooltip" title="Browse this release"></i></a> 
       
         <?php if ($item['id']==$release){;?>
           <a href="/version/index/id/<?php echo $item['id'];?>"><i class="icon-calendar " rel="tooltip" title="View change log"></i></a> 
        
              <?php } ?>
              
        </td>
        </tr>
          	</tbody>
<?php
        } ?>
<?php endif; ?>        
 
</table>

