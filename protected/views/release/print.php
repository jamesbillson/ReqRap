
<?php 
$releases = Release::model()->findAll(array('order'=>'number ASC',
    
    'condition'=>'project_id=:x',
    'params'=>array(':x'=>Yii::app()->session['project'])));



?>
         <?php if (count($releases)){?>
<h4>Release History</h4>
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
            
            if($release['number']<= $thisrelease['number']){ ?>
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
