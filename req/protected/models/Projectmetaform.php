<?php
class Projectmetaform extends CFormModel {
	public $project_id;
	public $output_font;
	public $html_output;
	public $pdf_header;
	public $pdf_footer;

	public function attributeLabels()
	{
		return array(
			'project_id' => 'Project Id',
			'output_font' => Yii::t('members', 'Output Font'),
			'pdf_header' => Yii::t('members', 'PDF Header'),
			'pdf_footer' => Yii::t('members', 'PDF Footer')
		);
	}
}