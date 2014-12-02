<h4>Output configurations</h4>
<?php 
	$metaData = $model->getEavAttributes(array('html_output', 'output_font'));
	$projectmetaform = new Projectmetaform;
	if (isset($metaData['output_font'])) {
		$projectmetaform->output_font = $metaData['output_font'];
	}
	if($projectmetaform['html_output']) {
		$projectmetaform->html_output = $metaData['html_output'];
	}

?>
<form class="form-horizontal" id="project-form" action="<?php echo Yii::app()->createUrl('project/addmeta'); ?>" method="post">
	<div class="control-group">
		<label class="control-label" for="html_output">
                    <?php echo Yii::t('app','Output print version as HTML'); ?>
                </label>
		<div class="controls">
            <input <?php if ( isset($projectmetaform['html_output']) && $metaData['html_output']== 1 ) echo 'checked'; ?> name="Projectmetaform[html_output]" id="html_output" value="1" type="checkbox">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="output_font"><?php echo Yii::t('app','Output Font'); ?></label>
		<div class="controls">
			<?php echo FontHelper::getDefault('output_font', $projectmetaform); ?>
		</div>
	</div>
	
	<div class="control-group">
	    <div class="controls">
	      <button type="submit" class="btn"><?php echo Yii::t('app','Add'); ?></button>
	    </div>
  	</div>
</form>