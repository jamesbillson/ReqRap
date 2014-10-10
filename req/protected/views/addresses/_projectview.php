<div class="view">

<?php $myid=CHtml::encode($data->id);
$mytype=CHtml::encode($data->type);
?>

	<b><?php echo CHtml::encode($data->name); ?></b> 
  
        <a href="<?php echo UrlHelper::getPrefixLink('/addresses/update/id/')?><?php echo $myid; ?>/type/<?php echo $mytype; ?>"><i class="icon-edit"></i></a>
        <a href="<?php echo UrlHelper::getPrefixLink('/addresses/remove/id/')?><?php echo $myid; ?>/type/<?php echo $mytype; ?>"><i class="icon-remove-sign"></i></a>
 
        <br />

	<?php echo CHtml::encode($data->address1); ?>
	<br />

	<?php if($data->address2 != '') echo CHtml::encode($data->address2).'<br>'; ?>


	<?php echo CHtml::encode($data->city); ?>
	<br />
        <?php echo CHtml::encode($data->state->name); ?>, 
	<?php echo CHtml::encode($data->postcode); ?>
	<br />


	
	<br />

	
</div>