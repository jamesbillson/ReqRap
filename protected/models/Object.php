<?php


class Object extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'object';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('object_id, name, number, description, project_id, release_id', 'required'),
			array('object_id, project_id, release_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, object_id, name, number, project_id, release_id', 'safe', 'on'=>'search'),
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
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'objectproperties' => array(self::HAS_MANY, 'Objectproperty', 'object_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
                    'object_id'=>'Object_id',
			'name' => 'Name',
                    'description'=>'Description',
			 'project_id' => 'Project',
                    'release_id' => 'Release',
                    'number'=>'Number'
		);
	}


	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('project_id',$this->project_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

            public function getNextNumber()
    {
       $id=Yii::App()->session['project'];        
        $sql="
            SELECT `r`.`number`
            From `object` `r`
            WHERE `r`.`project_id`=".$id."
            ORDER BY `number` DESC
            LIMIT 0,1";
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
           
      public function getProjectObjects()
    {
       $release=Yii::App()->session['release'];
        $sql="
            SELECT `r`.*
            FROM `object` `r`
            LEFT JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id`
            WHERE 
            `v`.`object`=6
            AND
            `v`.`active`=1
            AND
            `v`.`release`=".$release."         
            ORDER BY `r`.`number`+1";         
     

     
        
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
