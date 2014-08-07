<?php
class Companymetaform extends CFormModel {
	public $company_id;
	public $output_font;

	public function attributeLabels()
	{
		return array(
			'company_id' => 'Company Id',
			'output_font' => Yii::t('members', 'Output Font'),
		);
	}
}