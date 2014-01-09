<?php


class Testcaseresult extends CActiveRecord
{

    
    public static $status = array(1=>'new', 2=>'running', 3=>'blocked', 4=>'fail',5=>'pass');	
      
    
    
    
	public function tableName()
	{
		return 'testcaseresult';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('testcase_id, testrun_id, status, modified_date, user_id', 'required'),
			array('testcase_id, testrun_id, status, user_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, testcase_id, testrun_id, status, modified_date, user_id', 'safe', 'on'=>'search'),
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
                    'testcase'=>array(self::BELONGS_TO, 'Testcase', 'testcase_id'),
                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'testcase_id' => 'Testcase',
			'testrun_id' => 'Testrun',
			'status' => 'Status',
			'modified_date' => 'Modified Date',
			'user_id' => 'User',
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
		$criteria->compare('testcase_id',$this->testcase_id);
		$criteria->compare('testrun_id',$this->testrun_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Testcaseresult the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
