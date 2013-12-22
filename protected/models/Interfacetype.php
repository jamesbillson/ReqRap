<?php

/**
 * This is the model class for table "interfacetype".
 *
 * The followings are the available columns in table 'interfacetype':
 * @property integer $id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Iface[] $ifaces
 */
class Interfacetype extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'interfacetype';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, project_id, number', 'required'),
			array('name', 'length', 'max'=>255),
                    array('number', 'length', 'max'=>30),
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
			'ifaces' => array(self::HAS_MANY, 'Iface', 'type_id'),
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
                    'number'=>'Number',
                    'project_id'=>'project',
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

        
                   public function getUnclassified($id)
    {
       
              
        $sql="SELECT `i`.`id`
            FROM `interfacetype` `i`
            WHERE `i`.`project_id`=".$id."
            AND 
            `i`.`number`=0
            LIMIT 1
            ";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
               
		return $projects[0]['id'];
    }
        
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Interfacetype the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
