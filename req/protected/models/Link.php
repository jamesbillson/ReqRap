<?php

/**
 * This is the model class for table "link".
 *
 * The followings are the available columns in table 'link':
 * @property integer $id
 * @property integer $sourcetype
 * @property integer $source_id
 * @property integer $targettype
 * @property integer $target_id
 */
class Link extends CActiveRecord
{
     const DIARY = 1;
     
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Link the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'link';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sourcetype, source_id, targettype, target_id', 'required'),
			array('sourcetype, source_id, targettype, target_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sourcetype, source_id, targettype, target_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sourcetype' => 'Sourcetype',
			'source_id' => 'Source',
			'targettype' => 'Targettype',
			'target_id' => 'Target',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('sourcetype',$this->sourcetype);
		$criteria->compare('source_id',$this->source_id);
		$criteria->compare('targettype',$this->targettype);
		$criteria->compare('target_id',$this->target_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}