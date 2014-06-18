<?php

/**
 * This is the model class for table "user_meta".
 *
 * The followings are the available columns in table 'user_meta':
 * @property integer $id
 * @property integer $has_viewed
 * @property integer $has_acknowledged
 * @property integer $alert_messages_id
 *
 * The followings are the available model relations:
 * @property Messages $alertMessages
 */
class UserMeta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_meta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('has_viewed, has_acknowledged, alert_messages_id', 'required'),
			array('has_viewed, has_acknowledged, alert_messages_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, has_viewed, has_acknowledged, alert_messages_id', 'safe', 'on'=>'search'),
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
			'alertMessages' => array(self::BELONGS_TO, 'Messages', 'alert_messages_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'has_viewed' => 'Has Viewed',
			'has_acknowledged' => 'Has Acknowledged',
			'alert_messages_id' => 'Alert Messages',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('has_viewed',$this->has_viewed);
		$criteria->compare('has_acknowledged',$this->has_acknowledged);
		$criteria->compare('alert_messages_id',$this->alert_messages_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserMeta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
