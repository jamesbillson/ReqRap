<div class="view">


	<b><?php echo CHtml::encode($data->name); ?></b> 

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