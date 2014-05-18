<?php

/**
 * This is the model class for table "testrun".
 *
 * The followings are the available columns in table 'testrun':
 * @property integer $id
 * @property integer $teststep_id
 * @property integer $status
 */
class Testrun extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'testrun';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('release_id, number, status', 'required'),
			array('release_id, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, release_id, status', 'safe', 'on'=>'search'),
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
			'release_id' => 'Release',
			'status' => 'Status',
                    'number'=>'Number'
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
		$criteria->compare('release_id',$this->release_id);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        	public function getCurrentRun($id)
	{
		
		   $sql="SELECT `r`.`number`,`r`.`id`
                    From `testrun` `r`
                    WHERE `r`.`status`=1
                    AND release_id=".$id;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();

		return $projects[0]['id'];
	}

        
          public function createInitial($id)
    {
       $sql="INSERT INTO `testrun`(`number`, `status`, `release_id`) VALUES 
           (1,1, ".$id.")";
                 $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
    }   
        
        
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Testrun the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
