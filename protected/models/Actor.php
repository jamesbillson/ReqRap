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
			array('project_id, actor_id, number, name, description, alias, inherits', 'required'),
			array('project_id, actor_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id, actor_id,number,  name,description, alias', 'safe', 'on'=>'search'),
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
                     'actor_id'=>'ACTORID',
			'project_id' => 'Project',
  		'number' => 'Number',	
                    'name' => 'Name',
                    'descripion'=>'Description',
                    'alias'=>'Aliases',
                    'inherits'=>'Inherits',
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

           public function getProjectActors($id)
    {
        $sql="
            SELECT `r`.*
            FROM `actor` `r`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id`
            WHERE 
              `v`.`object`=4
            AND
            `v`.`active`=1 
            and            
            `r`.`project_id`=".$id;

     
        
        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
        
        public function getNextNumber($id)
    {
                   
        $sql="SELECT max(`r`.`number`)as number
           From `actor` `r`
            WHERE `r`.`project_id`=".$id;
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
         public function getActors($id)
    {
                     
        $sql="  SELECT `a`.*
                FROM `actor` `a`
                LEFT Join `step` `s` 
                on `s`.`actor_id`=`a`.`actor_id`
                LEFT join `flow` `f`
                ON `f`.`flow_id`=`s`.`flow_id`
                LEFT join `usecase` `u` 
                ON `u`.`usecase_id`=`f`.`usecase_id`
                LEFT join `version` `v`
                ON `v`.`foreign_key`=`a`.`id`
                WHERE `u`.`usecase_id`=".$id."
                AND `v`.`object`=4
                AND `v`.`active`=1
                Group by `a`.`id`
               ";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
     
  
    
         public function getCandidateActors($id)
    {
      
              
        $sql="  SELECT  `a`.`name` ,  `a`.`id` ,`a`.`alias`, `a`.`description`
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
    
    
     public function getNextID($id)
    {
       
              
        $sql="SELECT `r`.`actor_id` as `number`
           From `actor` `r`
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
    
         public function createInitial($id)
    {
             $actor_id=Version::model()->getNextID(4);
           $sql="INSERT INTO `actor`(`actor_id`, `project_id`,`number`,`name`,`description`,`alias`,`inherits`) VALUES 
           (".$actor_id.",".$id.",1,'Actor','My First Actor','Placeholder',-1)";
           $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
        $sql="select a.id from actor a where a.project_id=".$id;
      
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        Version::model()->getNextNumber($id,4,1,$result[0]['id'],$actor_id);   
                    
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
