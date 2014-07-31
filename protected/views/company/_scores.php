<h4>Estimate size coefficients</h4>
Adjust these weighting factors to change the calculation of overall project 'size'.<br /><br />
<?php 
	$metaData = $model->getEavAttributes(array('uc_rate', 'uc_ui_rate', 'uc_step_rate', 'uc_rule_rate', 'uc_form_rate'));
?>
<form class="form-horizontal" id="user-form" action="<?php echo Yii::app()->createUrl('company/addmeta'); ?>" method="post">
	<div class="no-display">
		<input type="hidden" name="CompanyMeta[company_id]" value="<?php echo $model->id; ?>" />
	</div>
	<div class="control-group">
		<label class="control-label" for="uc_rate"><?php echo Yii::t('app','Use Case'); ?></label>
		<div class="controls">
			<input value="<?php if ( isset($metaData['uc_rate']) ) echo $metaData['uc_rate']; ?>" name="CompanyMeta[uc_rate]" id="uc_rate" class="" type="text">
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="uc_ui_rate"><?php echo Yii::t('app','User Interface'); ?></label>
		<div class="controls">
			<input value="<?php if ( isset($metaData['uc_ui_rate']) ) echo $metaData['uc_ui_rate']; ?>" name="CompanyMeta[uc_ui_rate]" id="uc_ui_rate" class="" type="text">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="uc_step_rate"><?php echo Yii::t('app','Use Case Step'); ?></label>
		<div class="controls">
			<input value="<?php if ( isset($metaData['uc_step_rate']) ) echo $metaData['uc_step_rate']; ?>" name="CompanyMeta[uc_step_rate]" id="uc_step_rate" class="" type="text">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="uc_rule_rate"><?php echo Yii::t('app','Business Rule'); ?></label>
		<div class="controls">
			<input value="<?php if ( isset($metaData['uc_rule_rate']) ) echo $metaData['uc_rule_rate']; ?>" name="CompanyMeta[uc_rule_rate]" id="uc_rule_rate" class="" type="text">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="uc_form_rate"><?php echo Yii::t('app','User Form'); ?></label>
		<div class="controls">
			<input value="<?php if ( isset($metaData['uc_form_rate']) ) echo $metaData['uc_form_rate']; ?>" name="CompanyMeta[uc_form_rate]" id="uc_form_rate" class="" type="text">
		</div>
	</div>

	<div class="control-group">
	    <div class="controls">
	      <button type="submit" class="btn"><?php echo Yii::t('app','Add'); ?></button>
	    </div>
  	</div>
</form>