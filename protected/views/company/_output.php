<h4>Output configurations</h4>

<?php 

	$metaData = $model->getEavAttributes(array('html_output'));
?>
<form class="form-horizontal" id="user-form" action="<?php echo Yii::app()->createUrl('company/addmeta'); ?>" method="post">
	<div class="no-display">
		<input type="hidden" name="CompanyMeta[company_id]" value="<?php echo $model->id; ?>" />
	</div>
	<div class="control-group">
		<label class="control-label" for="html_output">
                    <?php echo Yii::t('app','Output print version as HTML'); ?>
                </label>
		<div class="controls">
                    <input <?php if ( isset($metaData['html_output']) && $metaData['html_output']=='on' ) echo 'CHECKED'; ?> name="CompanyMeta[html_output]" value="html_output" id="html_output" class="" type="checkbox">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="output_font"><?php echo Yii::t('app','Output Font'); ?></label>
		<div class="controls">
			<input value="<?php if ( isset($metaData['output_font']) ) echo $metaData['output_font']; ?>" name="CompanyMeta[output_font]" id="output_font" class="" type="text">
		</div>
	</div>
	

	<div class="control-group">
	    <div class="controls">
	      <button type="submit" class="btn"><?php echo Yii::t('app','Add'); ?></button>
	    </div>
  	</div>
</form>