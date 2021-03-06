<?php

/**
 * This is the model class for table "library".
 *
 * The followings are the available columns in table 'library':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $release_id
 * @property integer $owner_id
 *
 * The followings are the available model relations:
 * @property Company $owner
 * @property Project $project
 */
class Library extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'library';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, release_id, public, owner_id', 'required'),
			array('release_id, owner_id, public', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, public, release_id, owner_id', 'safe', 'on'=>'search'),
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
			'owner' => array(self::BELONGS_TO, 'Company', 'owner_id'),
			'release' => array(self::BELONGS_TO, 'Release', 'release_id'),
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
                        'public'=>'Public',
			'description' => 'Description',
			'release_id' => 'Release',
			'owner_id' => 'Owner',
		);
	}

	  public function libraryOwner($id)
    {
       
              
        $sql="SELECT `l`.`owner_id`
            FROM `library` `l`
            WHERE `l`.`id`=".$id;
           
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects[0]['owner_id'];
    }
        
        
        
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('release_id',$this->release_id);
		$criteria->compare('owner_id',$this->owner_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Library the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
