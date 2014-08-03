
<?php 
$releases = Release::model()->findAll(array('order'=>'number ASC',
    
    'condition'=>'project_id=:x',
    'params'=>array(':x'=>Yii::app()->session['project'])));



?>
         <?php if (count($releases)){?>
<h4>Release History</h4>
<table class="table table-bordered">
	<thead>
    	<tr>
    		<td>Number</td>
    		<td>Status</td>
            <td>Date</td>
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
