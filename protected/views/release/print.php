
<?php $releases = Release::model()->findAll('project_id='.Yii::app()->session['project']);

?>
         <?php if (count($releases)){?>
<h3>Release History</h3>
<table class="table">
	<thead>
	<tr>
		<th>Number</th>
		<th>Status</th>
                <th>Date</th>
     
	</tr>
	</thead>
   
        <tbody>

        <?php foreach($releases as $release) {
            
            if($release['id']<= Yii::App()->session['release']){ ?>
        <tr class="odd">  
        <td>   
        <?php echo $release['number']; ?> 
        </td>
   
<td>   
       <?php echo Release::$status[$release['status']];?>
        </td>
    
    <td>   
        <?php echo $release['create_date'];?>
        </td>
              
        </tr> <?php 
        }} ?>
</table>
    
    <?php 
        }
        ?>
