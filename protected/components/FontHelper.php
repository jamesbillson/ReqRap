<?php
class FontHelper {
	public static function getDefault($name, $model) {
        $options = array(
            'dejavusanscondensed' => Yii::t('global', 'Dejavusanscondensed'),
            'dejavusans' => Yii::t('global', 'Dejavusans'),
            'dejavuserif' => Yii::t('global', 'Dejavuserif'),
            'dejavuserifcondensed' => Yii::t('global', 'Dejavuserifcondensed'),
            'dejavusansmono' => Yii::t('global', 'Dejavusansmono'),
        );
        return CHtml::activeDropDownList($model, $name, $options, array('class' => 'select form-control', 'empty' => Yii::t('global', '-- Please font --')));
    }
}