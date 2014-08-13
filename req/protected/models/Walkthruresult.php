<?php

/**
 * This is the model class for table "walkthruresult".
 *
 * The followings are the available columns in table 'walkthruresult':
 * @property integer $id
 * @property integer $teststep_id
 * @property integer $user_id
 * @property string $date
 * @property integer $result
 * @property string $comments
 */
class Walkthruresult extends CActiveRecord
{
    
    	public static $result = array(1=>'Not Accepted', 2=>'Accepted');	
 
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'walkthruresult';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('walkthrupath_id, user_id, result', 'required'),
			array('walkthrupath_id, user_id, result', 'numerical', 'integerOnly'=>true),
			array('result','safe'),
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
                  'walkthrupath' => array(self::BELONGS_TO, 'Walkthrupath', 'walkthrupath_id'),
                    'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
                        'walkthrupath_id' => 'Walk Through Path',                
			'user_id' => 'User',
			'date' => 'Date',
			'result' => 'Result',
			'comments' => 'Comments',
		);
	}

        
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('walkthrupath_id',$this->teststep_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('result',$this->result);
		$criteria->compare('comments',$this->comments,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
