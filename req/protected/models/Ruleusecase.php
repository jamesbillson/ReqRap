<?php

/**
 * This is the model class for table "ruleusecase".
 *
 * The followings are the available columns in table 'ruleusecase':
 * @property integer $rule_id
 * @property integer $usecase_id
 *
 * The followings are the available model relations:
 * @property Usecase $usecase
 * @property Rule $rule
 */
class Ruleusecase extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ruleusecase';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rule_id, usecase_id', 'required'),
			array('rule_id, usecase_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rule_id, usecase_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'usecase' => array(self::BELONGS_TO, 'Usecase', 'usecase_id'),
			'rule' => array(self::BELONGS_TO, 'Rule', 'rule_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rule_id' => 'Rule',
			'usecase_id' => 'Usecase',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('rule_id',$this->rule_id);
		$criteria->compare('usecase_id',$this->usecase_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ruleusecase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
