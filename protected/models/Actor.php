<?php

/**
 * This is the model class for table "actor".
 *
 * The followings are the available columns in table 'actor':
 * @property integer $id
 * @property integer $project_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Project $project
 * @property Actorusecase $actorusecase
 */
class Actor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'actor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_id, name, description', 'required'),
			array('project_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id, name,description, alias', 'safe', 'on'=>'search'),
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
			'actorusecase' => array(self::HAS_ONE, 'Actorusecase', 'actor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'project_id' => 'Project',
			'name' => 'Name',
                    'descripion'=>'Description',
                    'alias'=>'Aliases'
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
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        
         public function getActors($id)
    {
        $user= Yii::app()->user->id;   
              
        $sql="SELECT `a`.`name`,`a`.`id`,`a`.`alias`, `a`.`description`
            FROM `actor` `a`
            Join `actorusecase` `u` 
            on `u`.`actor_id`=`a`.`id`
           WHERE `u`.`usecase_id`=".$id;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
     
  
    
         public function getCandidateActors($id)
    {
        $user= Yii::app()->user->id;   
              
        $sql="SELECT  `a`.`name` ,  `a`.`id` ,`a`.`alias`, `a`.`description`
FROM  `actor`  `a` 
JOIN  `project`  `p` ON  `p`.`id` =  `a`.`project_id` 
JOIN  `package`  `k` ON  `k`.`project_id` =  `p`.`id` 
JOIN  `usecase`  `u` ON  `u`.`package_id` =  `k`.`id` 
WHERE  `u`.`id` =".$id;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
    
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Actor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}