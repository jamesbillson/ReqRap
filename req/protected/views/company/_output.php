<h4>Output configurations</h4>
<?php 
	$metaData = $model->getEavAttributes(array('html_output', 'output_font'));
	$companymodelform = new Companymetaform;
	if (isset($metaData['output_font'])) {
		$companymodelform->output_font = $metaData['output_font'];
	}

?>
<form class="form-horizontal" id="user-form" action="<?php echo Yii::app()->createUrl('company/addmeta'); ?>" method="post">
	<div class="no-display">
		<input type="hidden" name="Companymetaform[company_id]" value="<?php echo $model->id; ?>" />
	</div>
	<div class="control-group">
		<label class="control-label" for="html_output">
                    <?php echo Yii::t('app','Output print version as HTML'); ?>
                </label>
		<div class="controls">
            <input <?php if ( isset($metaData['html_output']) && $metaData['html_output']== 1 ) echo 'checked'; ?> name="Companymetaform[html_output]" id="html_output" value="1" type="checkbox">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="output_font"><?php echo Yii::t('app','Output Font'); ?></label>
		<div class="controls">
			<?php echo FontHelper::getDefault('output_font', $companymodelform); ?>
		</div>
	</div>
	
	<div class="control-group">
	    <div class="controls">
	      <button type="submit" class="btn"><?php echo Yii::t('app','Add'); ?></button>
	    </div>
  	</div>
</form>