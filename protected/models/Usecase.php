<?php

/**
 * This is the model class for table "usecase".
 *
 * The followings are the available columns in table 'usecase':
 * @property integer $id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Actorusecase[] $actorusecases
 * @property Interfaceusecase[] $interfaceusecases
 * @property Ruleusecase[] $ruleusecases
 * @property Step[] $steps
 * @property Uses[] $uses
 * @property Uses $uses1
 */
class Usecase extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usecase';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, package_id, number,description,preconditions', 'required'),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name', 'safe', 'on'=>'search'),
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
			'actorusecases' => array(self::HAS_MANY, 'Actorusecase', 'usecase_id'),
			'interfaceusecases' => array(self::HAS_MANY, 'Interfaceusecase', 'usecase_id'),
			'ruleusecases' => array(self::HAS_MANY, 'Ruleusecase', 'usecase_id'),
			'steps' => array(self::HAS_MANY, 'Step', 'usecase_id'),
			'usedby' => array(self::HAS_MANY, 'Uses', 'usedby'),
			'uses' => array(self::HAS_ONE, 'Uses', 'uses'),
                    'package' => array(self::BELONGS_TO, 'Package', 'package_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
                    'number' => 'Number',
                    'package_id' => 'Package',
                    'description' => 'Description',
                    'preconditions' => 'Pre Conditions'
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
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

           public function getUsecases($id)
    {
        $user= Yii::app()->user->id;   
              
        $sql="SELECT `u`.`name`, `u`.`id`
            FROM `usecase` `u`
            Join `package` `p` 
            on `p`.`id`=`u`.`package_id`
           WHERE `p`.`id`=".$id;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
               public function getProjectUCs($id)
    {
        $user= Yii::app()->user->id;   
              
        $sql="SELECT `u`.`name`, `u`.`id`, `u`.`description`,
            `p`.`name` as packname,`p`.`id` as packid,
            `s`.`id` as steps
            FROM `package` `p`
            LEFT Join  `usecase` `u`
            on `p`.`id`=`u`.`package_id`
            LEFT Join `project` `r`
            ON `r`.`id` =`p`.`project_id`
            LEFT Join `flow` `f`
            ON `u`.`id`=`f`.`usecase_id`
            LEFT Join `step` `s`
            ON `f`.`id`=`s`.`flow_id`
            WHERE `r`.`id`=".$id;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }   
        
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usecase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
