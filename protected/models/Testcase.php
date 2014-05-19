<?php

/**
 * This is the model class for table "testcase".
 *
 * The followings are the available columns in table 'testcase':
 * @property integer $id
 * @property integer $number
 * @property integer $name
 * @property integer $preparation
 */
class Testcase extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'testcase';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, name, release_id,preparation', 'required'),
			array('number', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, number, name, preparation', 'safe', 'on'=>'search'),
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
               'release' => array(self::BELONGS_TO, 'Release', 'release_id'),
                'testcaseresult'    =>array(self::HAS_ONE, 'Testcaseresult', 'testcase_id'),
                    'testrun'    =>array(self::HAS_MANY, 'Testrun', 'testcase_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'number' => 'Number',
			'name' => 'Name',
			'preparation' => 'Preparation',
                    'active' => 'Is Active',
                    'usecase_id' => 'Usecase',
                    'release_id' => 'Release',
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
		$criteria->compare('number',$this->number);
		$criteria->compare('name',$this->name);
		$criteria->compare('preparation',$this->preparation);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

            public function getNextNumber($id)
    {
       
              
        $sql="SELECT max(`r`.`number`)as number
           From `testcase` `r`
            WHERE `r`.`release_id`=".$id;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		   if (!isset($projects[0]['number'])) {
                    $projects[0]['number']='1';
                } ELSE {
                    $projects[0]['number']=$projects[0]['number']+1;
                }
		return $projects[0]['number'];
    }  
        
    
        public function getProjectTC($id)
    {
        $sql="
        SELECT t.id, t.number, t.name, u.number as ucnumber 
        from testcase t
        JOIN usecase u
        ON t.usecase_id=u.id
        WHERE 
        `t`.`release_id`=".$id;

        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
    
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Testcase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
