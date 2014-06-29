
<h3><?php echo $model->name; ?></h3>
<h4>Description</h4>
<?php echo $model->description; ?><br />
<h4>Type</h4>
<?php echo $model->type; ?> <br />    
<h4>Validation Rule</h4>
 <?php echo $model->valid; ?> <br />  
 <h4>Required ?</h4>
<?php if($model->required==1){ echo 'Yes'; } else { echo 'No';} ?> <br />
    

