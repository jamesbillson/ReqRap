<?php

/**
 * This is the model class for table "flow".
 *
 * The followings are the available columns in table 'flow':
 * @property integer $id
 * @property string $Name
 * @property integer $usecase_id
 * @property integer $main
 * @property integer $startstep_id
 * @property integer $rejoinstep_id
 */
class Flow extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'flow';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, flow_id, usecase_id, main, startstep_id, rejoinstep_id', 'required'),
			array('usecase_id,  flow_id, main, startstep_id, rejoinstep_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name,  flow_id, usecase_id, main, startstep_id, rejoinstep_id', 'safe', 'on'=>'search'),
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
		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
                        'flow_id' => 'Flow_ID',
			'name' => 'Name',
			'usecase_id' => 'Usecase',
			'main' => 'Main',
			'startstep_id' => 'Startstep',
			'rejoinstep_id' => 'Rejoinstep',
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
		$criteria->compare('name',$this->Name,true);
		$criteria->compare('usecase_id',$this->usecase_id);
		$criteria->compare('main',$this->main);
		$criteria->compare('startstep_id',$this->startstep_id);
		$criteria->compare('rejoinstep_id',$this->rejoinstep_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
          public function getNextFlow($id)
    {
        $user= Yii::app()->user->id;   
              
        $sql="SELECT `f`.`name`
            FROM `flow` `f`
            Join `usecase` `u` 
            on `f`.`usecase_id`=`u`.`id`
            WHERE `u`.`id`=".$id."
            AND 
            `f`.`main`=0
            order by name DESC
            LIMIT 1
            ";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
                if (!isset($projects[0]['name'])) {
                    $projects[0]['name']='A';
                } ELSE {
                    $projects[0]['name']=chr(ord($projects[0]['name'])+1);
                }
		return $projects[0]['name'];
    }    
    
              public function checkSteps($id)
    {
       
              
        $sql="SELECT `f`.`id`,count(`s`.`id`) as steps
              FROM `flow` `f`
              JOIN `step` `s` 
              ON `s`.`flow_id`=`f`.`id`
              WHERE `f`.`id`=".$id."
              ";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
                
		return $projects[0]['steps'];
    }    

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Flow the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
