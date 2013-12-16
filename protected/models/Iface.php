<?php

/**
 * This is the model class for table "iface".
 *
 * The followings are the available columns in table 'iface':
 * @property integer $id
 * @property integer $number
 * @property string $name
 * @property integer $type_id
 *
 * The followings are the available model relations:
 * @property Interfacetype $type
 * @property Interfaceusecase $interfaceusecase
 */
class Iface extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'iface';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, name, type_id, project_id', 'required'),
			array('number, type_id, project_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, number, name, type_id', 'safe', 'on'=>'search'),
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
			'type' => array(self::BELONGS_TO, 'Interfacetype', 'type_id'),
                    'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'interfaceusecase' => array(self::HAS_ONE, 'Interfaceusecase', 'interface_id'),
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
			'type_id' => 'Type',
                    'project_id' => 'Project'
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type_id',$this->type_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

         public function getIfaces($id)
    {
        $user= Yii::app()->user->id;   
              
        $sql="SELECT `i`.`number`,`i`.`name`, `i`.`type_id`,`i`.`id`
            FROM `iface` `i`
            Join `interfaceusecase` `j` 
            on `j`.`interface_id`=`i`.`id`
            Join `usecase` `u` 
            on `j`.`usecase_id`=`u`.`id`
           WHERE `u`.`id`=".$id;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
        
        public function getStepIfaces($id)
    {
       
              
        $sql="SELECT `i`.`number`,`i`.`name`, `i`.`type_id`,`i`.`id`
            FROM `iface` `i`
            Join `stepiface` `x` 
            on `x`.`iface_id`=`i`.`id`
            Join `step` `s` 
            on `x`.`step_id`=`s`.`id`
           WHERE `s`.`id`=".$id;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }   
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Iface the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
