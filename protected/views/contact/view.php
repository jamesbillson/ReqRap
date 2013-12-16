

<h1>View Contact </h1>

<div class="view">



	<b>Name:</b>
	<?php echo CHtml::encode($model->firstname); ?> <?php echo CHtml::encode($model->lastname); ?>
	<br />

	

	<b><?php echo CHtml::encode($model->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($model->phone); ?>
	<br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('mobile')); ?>:</b>
	<?php echo CHtml::encode($model->mobile); ?>
	<br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($model->email); ?>
	<br />



        <b><?php echo CHtml::encode($model->getAttributeLabel('company_id')); ?>:</b>
	<a href="/company/view/id/<?php echo CHtml::encode($model->worksfor->id); ?>"><?php echo CHtml::encode($model->worksfor->name); ?></a>
	<br />
	<?php /*
	<b><?php echo CHtml::encode($model->getAttributeLabel('owner_id')); ?>:</b>
	<?php echo CHtml::encode($model->owner_id); ?>
	<br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('companyowner_id')); ?>:</b>
	<?php echo CHtml::encode($model->companyowner_id); ?>
	<br />

	*/ ?>

</div>
