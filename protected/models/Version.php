<?php


class Version extends CActiveRecord
{
 public static $objects= array(1=>'rule',
                                2=>'form',
                                3=>'formproperty',
                                4=>'actor',
                                5=>'package',
                                6=>'object',
                                7=>'objectproperty',
                                8=>'flow',
                                9=>'step',
                                10=>'usecase',
                                11=>'photo',
                                12=>'iface',
                                13=>'interfacetype',
                                14=>'stepform',
                                15=>'stepiface',
                                16=>'steprule',
     
     
     ); 
 public static $actions= array(1=>'create',
                                2=>'update',
                                3=>'delete'); 
   	
  
 
	public function tableName()
	{
		return 'version';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, foreign_id, foreign_key ,release, project_id, status,object, action,create_date, create_user', 'required'),
			array('project_id, foreign_id, foreign_key ,status', 'numerical', 'integerOnly'=>true),
			array('number, release', 'length', 'max'=>6),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, number, release, project_id, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		
            return array(
                'rule' => array(self::BELONGS_TO, 'Rule', 'foreign_key'),
                
		);
	}

	
        
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'number' => 'Number',
			'release' => 'Release',
			'project_id' => 'Project',
			'status' => 'Status',
                    'object'=>'Object',
                    'action'=>'Action',
                    'foreign_key'=>'dbase key of instance',
                    'foreign_id'=>'ID of object',
                    'active'=>'Active',
                    'create_date'=>'create date',
                    'create_user'=>'create user',
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
		$criteria->compare('number',$this->number,true);
		$criteria->compare('release',$this->release,true);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

                 public function createInitial($id)
    {
      
                     
                          $sql="SELECT `r`.`id`
            FROM `release` `r`
            WHERE 
            `r`.`project_id`=".$id."
            ORDER BY
            `r`.`id` DESC
            Limit 0,1";
                $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$releases = $command->queryAll();
		$release=$releases[0]['id'];
                          
                     
           $sql="INSERT INTO `version`(
           `number`, 
           `release`, 
           `project_id`,
           `status`,
           `object`,
           `action`,
           `foreign_key`,
           `foreign_id`,
           `create_user`,

           ) VALUES (
           1,
           ".$release.",
           ".$id.",
           1,
           0,
           0,
           ".Yii::app()->user->id.")";
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
    }   
        
        
        
             public function getNextNumber($id,$object, $action, $fk,$fid)
    {
          $sql=" SELECT `v`.`number`
                        FROM `version` `v`
                        WHERE 
                        `v`.`project_id`=".$id."
                        ORDER BY
                        `v`.`number` DESC
                        Limit 0,1";


 
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		   if (!isset($projects[0]['number'])) {
                    $number='0';
                } ELSE {
                    $number=$projects[0]['number']+1;
                }
          
           $sql="UPDATE `version` 
                SET 
              `active`=0
              WHERE
              `project_id`=".$id."
              AND
              `object`=".$object."
               AND
               `foreign_id`=".$fid;
          
                 $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();    
        $active=1;
        if ($action==3) $active=0;
                
          $sql="INSERT INTO `version`(
              `number`,
              `release`, 
              `project_id`,
              `status`,
              `object`,
              `action`,
              `foreign_key`,
              `foreign_id`,
              `active`,
              `create_date`,
              `create_user`) 
              VALUES
              ('".$number."',
                '".Release::model()->currentRelease($id)."'
                ,".$id.",
                1,
                ".$object.",
                ".$action.",
                ".$fk.",
                ".$fid.",
                ".$active.",
                now(),
                ".Yii::app()->user->id."
                )";
          
                 $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
       $newversion = Yii::app()->db->getLastInsertID();
		
       
       return $newversion;
       
    }  
        
         public function getNextID($id,$object)
    {
       
              
        $sql="SELECT `r`.`".Version::$objects[$object]."_id` as `number`
           From `".Version::$objects[$object]."` `r`
          
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
    
    
       public function getProjectDeletedVersions($id,$object)
    {
        $sql="
        SELECT *
        from `".Version::$objects[$object]."` `r`
        WHERE 
        `r`.`project_id`=".$id."  
        AND `r`.`".Version::$objects[$object]."_id` NOT IN (
        SELECT `x`.`".Version::$objects[$object]."_id`
        FROM `".Version::$objects[$object]."` `x`
        JOIN `version` `v`
        ON `v`.`foreign_key`=`x`.`id`
        WHERE 
        `v`.`active`=1 and            
        `x`.`project_id`=".$id." 
        )
                
        GROUP BY `r`.`number`
        ORDER BY `r`.`id` DESC";

     
        
                $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
    
    
      public function getObjectDeletedVersions($id,$parent,$object)
    {
        $sql="
        SELECT *
        from `".Version::$objects[$object]."` `r`
        WHERE 
        `r`.`".Version::$objects[$parent]."_id`=".$id."  
        AND `r`.`".Version::$objects[$object]."_id` NOT IN (
        SELECT `x`.`".Version::$objects[$object]."_id`
        FROM `".Version::$objects[$object]."` `x`
        JOIN `version` `v`
        ON `v`.`foreign_key`=`x`.`id`
        WHERE 
        `v`.`active`=1 and            
        `x`.`".Version::$objects[$parent]."_id`=".$id." 
        )
                
        GROUP BY `r`.`number`
        ORDER BY `r`.`id` DESC";

     
        
                $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
    
    
    
       public function getVersions($id,$object)
    {
        $sql="select `r`.*,
                `v`.`active`,
                `v`.`number` as ver_numb,
                `v`.`release`,
                `v`.`action`,
                `v`.`create_date`,
                `v`.`create_user`,
                `u`.`firstname`,
                `u`.`lastname`
                from `".Version::$objects[$object]."` `r`
                join `version` `v`
                ON
                `r`.`id`=`v`.`foreign_key`
                join `user` `u`
                ON
                `u`.`id`=`v`.`create_user`
                WHERE 
                `v`.`object`=".$object."
                AND
                `r`.`".Version::$objects[$object]."_id`=".$id." 
                ORDER BY `v`.`active` DESC,
                ver_numb DESC";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
    
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Version the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
