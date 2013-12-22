<?php

/**
 * This is the model class for table "testresult".
 *
 * The followings are the available columns in table 'testresult':
 * @property integer $id
 * @property integer $teststep_id
 * @property integer $user_id
 * @property string $date
 * @property integer $result
 * @property string $comments
 */
class Testresult extends CActiveRecord
{
    
    	public static $testresult = array(1=>'Fail', 2=>'Pass',3=>'Block', 4=>'Not Tested');	
 
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'testresult';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('teststep_id, user_id, date, result, comments', 'required'),
			array('teststep_id, user_id, result', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, teststep_id, user_id, date, result, comments', 'safe', 'on'=>'search'),
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
		'testrun_id' => 'Test Run',	
                    'teststep_id' => 'Teststep',
			'user_id' => 'User',
			'date' => 'Date',
			'result' => 'Result',
			'comments' => 'Comments',
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
		$criteria->compare('teststep_id',$this->teststep_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('result',$this->result);
		$criteria->compare('comments',$this->comments,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Testresult the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
