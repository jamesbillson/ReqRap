<?php

/**
 * This is the model class for table "objectproperty".
 *
 * The followings are the available columns in table 'objectproperty':
 * @property integer $id
 * @property integer $object_id
 * @property string $name
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Object $object
 */
class Objectproperty extends CActiveRecord
{
	public static $objectnumber=7;
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'objectproperty';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('objectproperty_id, object_id, number, name, description, project_id, release_id', 'required'),
			array('objectproperty_id, object_id, project_id, release_id, type', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
                    array('number', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, objectproperty_id, object_id, number, name, description, project_id, release_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		
	return array(
		 	);
			     
                           
	}


        
	public function attributeLabels()
	{
		return array(
                    'id' => 'ID',
                    'objectproperty_id' => 'Objectprop_id',
                    'project_id' => 'Project',
                    'release_id' => 'Release',
                    'object_id' => 'Object',
                    'name' => 'Name',
                    'type'=> 'Type',
                    'number'=>'Number',
                    'description' => 'Description',
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
		$criteria->compare('object_id',$this->object_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        
                     public function getNextNumber($id)
    {
          $release=Yii::App()->session['release'];
                  
        $sql="SELECT 
            max(`r`.`number`)as number
           From `objectproperty` `r`
           JOIN `version` `v`
           ON `v`.`foreign_key`=`r`.`id`
            WHERE
            `v`.`object`=".Objectproperty::$objectnumber."
            AND
            `v`.`active`=1
            AND
            `v`.`release`=".$release."
            AND
            `r`.`object_id`=".$id;
        
        
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
    
    
           public function Renumber($id) //id is the object_id
	{
          
            $objects=ObjectProperty::model()->getObjectProperty($id);
            $counter=1;
            
           
            foreach ($objects as $object) {
            $model=ObjectProperty::model()->findbyPK($object['id']);
            $model->number = $counter;
            $model->save(false);
            $counter++;
          } 
           
          
	
	}
	
       public function getObjectProperty($id)
    {
          $project=Yii::App()->session['project'];
          $release=Yii::App()->session['release'];
        $sql="
            SELECT 
            `r`.*,
           `v`.`active`
            FROM `objectproperty` `r`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id`
            WHERE 
              `v`.`object`=7
            AND
            `v`.`active`=1
            AND
            `v`.`release`=".$release."
            
            AND
            
            `r`.`object_id`=".$id." order by `r`.`number`";

     
        
        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
    
    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
