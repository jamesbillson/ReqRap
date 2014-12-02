<?php
class Projectmetaform extends CFormModel {
	public $project_id;
	public $output_font;
	public $html_output;

	public function attributeLabels()
	{
		return array(
			'project_id' => 'Project Id',
			'output_font' => Yii::t('members', 'Output Font'),
		);
	}
}