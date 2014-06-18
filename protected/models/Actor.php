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
			array('actor_id, type, project_id, release_id,number, name, description, alias, inherits', 'required'),
			array('type, project_id, actor_id, release_id', 'numerical', 'integerOnly'=>true),
			array('name, inherits', 'length', 'max'=>255),
                        array('pretest', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id, release_id, pre-test, actor_id,number,  name,description, alias', 'safe', 'on'=>'search'),
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
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
		    'id' => 'ID',
                    'type' => 'Type',
                    'actor_id'=>'ACTORID',
		    'project_id' => 'Project',
                    'release_id' => 'Release',
                    'number' => 'Number',	
                    'name' => 'Name',
                    'pretest' => 'Pre Condition for Test',
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

           public function getProjectActors()
    {
       $release=Yii::App()->session['release'];
       $project=Yii::App()->session['project'];
               $sql="
           
            SELECT `r`.*,
            (SELECT `i`.`name` from `actor` `i`
            JOIN `version` `vi`
            ON `vi`.`foreign_key`=`i`.`id`
            WHERE
            `vi`.`object`=4 AND `vi`.`active`=1 AND `vi`.`release`=".$release."
            AND
            `i`.`actor_id`=`r`.`inherits`
            ) as iname  
            FROM `actor` `r`
                    
           
            JOIN `version` `vr`
            ON `vr`.`foreign_key`=`r`.`id`            

            WHERE 
            `vr`.`object`=4 AND `vr`.`active`=1 AND `vr`.`release`=".$release."
            AND   
            
           
           `r`.`project_id`=".$project;

     
        
        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
       
       public function getPackageActors($id)
    {
       $release=Yii::App()->session['release'];
       $project=Yii::App()->session['project'];
               $sql="
           
            SELECT `a`.*
            FROM `actor` `a`
            JOIN `step` `s`
            ON `s`.`actor_id`=`a`.`actor_id`
            JOIN `flow` `f`
            ON `f`.`flow_id`=`s`.`flow_id`
            JOIN `usecase` `u`
            ON `u`.`usecase_id`=`f`.`usecase_id`
            JOIN `package` `p`
            ON `p`.`package_id`=`u`.`package_id`
            JOIN `version` `va`
            ON `va`.`foreign_key`=`a`.`id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id`
            JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`            
            JOIN `version` `vp`
            ON `vp`.`foreign_key`=`p`.`id` 

            WHERE 
            `va`.`object`=4 AND `va`.`active`=1 AND `va`.`release`=".$release."  AND  
            `vs`.`object`=9 AND `vs`.`active`=1 AND `vs`.`release`=".$release."  AND                  
            `vf`.`object`=8 AND `vf`.`active`=1 AND `vf`.`release`=".$release."  AND  
            `vu`.`object`=10 AND `vu`.`active`=1 AND `vu`.`release`=".$release."  AND  
            `vp`.`object`=5 AND `vp`.`active`=1 AND `vp`.`release`=".$release."  AND  
                      
            `p`.`id`=".$id."
                GROUP BY `a`.`actor_id`";

     
        
        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
    
    public function getActorParentDefaultUC($id)
    {
     $release=Yii::App()->session['release'];

               $sql="
            SELECT 
            `u`.*,
            `p`.`number` as packagenumber
            FROM `usecase` `u`
            JOIN `actor` `a`
            ON `u`.`actor_id`=`a`.`actor_id`
            JOIN `package` `p`
            ON `p`.`package_id`=`u`.`package_id`
          
            JOIN `version` `va`
            ON `va`.`foreign_key`=`a`.`id`
           JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`
               JOIN `version` `vp`
            ON `vp`.`foreign_key`=`p`.`id` 
           WHERE
            `va`.`object`=4  AND `va`.`active`=1 AND `va`.`release`=".$release."  AND  
            `vu`.`object`=10 AND `vu`.`active`=1 AND `vu`.`release`=".$release."  AND 
            `vp`.`object`=5 AND `vp`.`active`=1 AND `vp`.`release`=".$release."  AND  
            
            `u`.`actor_id`=".$id." GROUP BY `u`.`usecase_id`";
                      

        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;   
        
    }
    
    
      public function getActorParentSteps($id)
              // RETURNS NUMBER OF STEPS THAT USE THIS ACTOR
    {
       $release=Yii::App()->session['release'];

               $sql="
            SELECT 
            `s`.*,
            `u`.`name` as usecasename,
            `u`.`number` as usecasenumber,
            `p`.`number` as packagenumber,
            `u`.`usecase_id` as usecaseid
            FROM `step` `s`
            JOIN `actor` `a`
            ON `s`.`actor_id`=`a`.`actor_id`

            JOIN `flow` `f`
            ON `s`.`flow_id`=`f`.`flow_id`
            JOIN `usecase` `u`
            ON `f`.`usecase_id`=`u`.`usecase_id`
            JOIN `package` `p`
            ON `p`.`package_id`=`u`.`package_id`
            JOIN `version` `va`
            ON `va`.`foreign_key`=`a`.`id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
             JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`
             JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id`
             JOIN `version` `vp`
            ON `vp`.`foreign_key`=`p`.`id`
            WHERE 
            `va`.`object`=4  AND `va`.`active`=1 AND `va`.`release`=".$release."  AND  
            `vs`.`object`=9  AND `vs`.`active`=1 AND `vs`.`release`=".$release."  AND   
            `vu`.`object`=10 AND `vu`.`active`=1 AND `vu`.`release`=".$release."  AND 
            `vp`.`object`=5  AND `vp`.`active`=1 AND `vp`.`release`=".$release."  AND
                `vf`.`object`=8  AND `vf`.`active`=1 AND `vf`.`release`=".$release."  AND
           `a`.`id`=".$id."  GROUP BY `u`.`usecase_id`";
                      

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
                     
       $project=Yii::App()->session['project']; 
               $release=Yii::App()->session['release'];
         $sql="SELECT 
            `i`.*
            FROM `actor` `i`
                       
            JOIN `step` `s`
            ON `s`.`actor_id`=`i`.`actor_id`
            
            JOIN `flow` `f`
            ON `f`.`flow_id`=`s`.`flow_id`

            JOIN `version` `vi`
            ON `vi`.`foreign_key`=`i`.`id`
            
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id` 

WHERE
            `f`.`usecase_id`=".$id."
            AND
            `vi`.`object`=4 AND `vi`.`active`=1  AND `vi`.`project_id`=".$project."
                AND `vi`.`release`=".$release."
            AND
            `vs`.`object`=9 AND `vs`.`active`=1 AND `vs`.`project_id`=".$project."
             AND `vs`.`release`=".$release."           
                AND
            `vf`.`object`=8 AND `vf`.`active`=1  AND `vf`.`project_id`=".$project."
            AND `vf`.`release`=".$release."



             GROUP BY `i`.`id`
             ORDER BY `i`.`number` ASC";
        
        
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
           $sql="INSERT INTO `actor`(
               `actor_id`,
               `project_id`,
               `release_id`,
               `number`,
               `name`,
               `description`,
               `alias`,
               `inherits`
               ) VALUES(
               ".$actor_id.",
               ".$id.",
                ".Release::model()->currentRelease($id).",
                1,
                'Actor',
                'My First Actor',
                'Placeholder',
                -1)";
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
