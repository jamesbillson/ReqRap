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
			array('name, usecase_id, package_id, actor_id, number,description,preconditions, project_id, release_id', 'required'),
			array('name', 'length', 'max'=>255),
                    array('usecase_id, project_id, release_id', 'numerical', 'integerOnly'=>true),
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, usecase_id,  name, project_id, release_id', 'safe', 'on'=>'search'),
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
                        'package' => array(self::BELONGS_TO, 'Package', 
                        array('package_id' => 'package_id'),
                        'on' => 't.project_id = package.project_id',
                ),
   

                        
                    
                    
                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                    'id' => 'ID',
                    'usecase_id' => 'usecase id',
                     'project_id' => 'Project',
                    'release_id' => 'Release',
                    'name' => 'Name',
                    'number' => 'Number',
                    'actor_id'=>'Default Actor',
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

           public function getPackageUsecases($id)
    {
            $project=Yii::app()->session['project'];
            $release=Yii::App()->session['release'];
          $sql="
            SELECT `u`.*,`p`.`number` as packnumber
            FROM `usecase` `u`
            JOIN `package` `p` 
            ON `p`.`package_id`=`u`.`package_id`
            JOIN `project` `r`
            ON `r`.`id` =`p`.`project_id`
            JOIN `version` `v1`
            ON `v1`.`foreign_key`=`u`.`id`
            JOIN `version` `v2`
            ON `v2`.`foreign_key`=`p`.`id`
            WHERE 
            `p`.`id`=".$id." 
                AND
             `p`.`project_id`=".$project."
            AND 
            `u`.`project_id`=".$project."
            AND
             `p`.`release_id`=".$release."
            AND 
            `u`.`release_id`=".$release."
            AND
            `v1`.`active`=1 AND `v1`.`object`=10
            AND
            `v2`.`active`=1 AND `v2`.`object`=5
           
            
                GROUP BY `u`.`id`
                ORDER BY 
             `p`.`number` ASC,              
             `u`.`number` ASC"


          ;
        
        
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
    
      public function getNextNumber($id)
    {
       // GEts the UC sequence number within the package
              
            $sql="SELECT max(`r`.`number`)as number
                    From `usecase` `r`
                    JOIN `package` `p`
                    ON `p`.`package_id`=`r`.`package_id`
                    WHERE `p`.`id`=".$id;
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
    
         public function getNextUC($dir,$id)
    {
             $project=Yii::App()->session['project'];
             $release=Release::model()->currentRelease($project);
       if ($dir==1) {
           $order='ASC';
           $compare='>';
       }
       if ($dir==2) {
           $order='DESC';
           $compare='<';
       }
              

                     $sql=" SELECT `r`.`number`,`r`.`id`
                    From `usecase` `r`
                    WHERE `r`.`number`".$compare.$id."
                   
                        AND 
                    `r`.`project_id`=".$project."
                        AND
                       `r`.`release_id`=".$release."
                    ORDER BY `r`.`number` ".$order."
                        LIMIT 0,1";
                            
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
	
		return $projects[0]['id'];
    }  
    
    
               public function getProjectUCs($id)
    {
        
        $project=Yii::App()->session['project'];
         $release=Yii::App()->session['release'];  

         $sql="SELECT 
            `u`.*,
            `p`.`name` as packname,
            `p`.`id` as packid,
            `p`.`number` as packnumber,
            `s`.`id` as steps
            FROM `package` `p`

            JOIN  `usecase` `u`
            on `p`.`package_id`=`u`.`package_id`
            
            JOIN `project` `r`
            ON `r`.`id` =`p`.`project_id`
            
            Join `flow` `f`
            ON `u`.`usecase_id`=`f`.`usecase_id`
            
            Join `step` `s`
            ON `f`.`flow_id`=`s`.`flow_id`

            JOIN `version` `v1`
            ON `v1`.`foreign_key`=`u`.`id`
            
            JOIN `version` `v2`
            ON `v2`.`foreign_key`=`p`.`id`
            
            JOIN `version` `v3`
            ON `v3`.`foreign_key`=`s`.`id`
            
            JOIN `version` `v4`
            ON `v4`.`foreign_key`=`f`.`id`
            WHERE 
            `r`.`id`=".$id." 
            
            AND
            `v1`.`active`=1 AND `v1`.`object`=10 AND `v1`.`project_id`=".$project." 
               AND `v1`.`release`=".$release." 
            AND
            `v2`.`active`=1 AND `v2`.`object`=5 AND `v2`.`project_id`=".$project." 
               AND `v2`.`release`=".$release." 
            AND
            `v3`.`active`=1 AND `v3`.`object`=9 AND `v3`.`project_id`=".$project." 
                AND `v3`.`release`=".$release." 
            AND
            `v4`.`active`=1 AND `v4`.`object`=8 AND `v4`.`project_id`=".$project." 
              AND `v4`.`release`=".$release." 
            
                GROUP BY `u`.`id`
                ORDER BY 
             `p`.`number` ASC,              
             `u`.`number` ASC";
  
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }   
             public function getProjectIfaces()
    {
            $project=Yii::App()->session['project']; 
            $release=Yii::App()->session['release'];    
        $sql="
            SELECT `r`.*,`v`.`active`
            FROM `iface` `r`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id`
            WHERE 
              `v`.`object`=12 AND `v`.`active`=1  AND `v`.`project_id`=".$project."
            and        
            `r`.`release_id`=".$release."
            and
            `r`.`project_id`=".$project;

     
        
        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
    
  
           public function getLinkUsecase($id,$object,$relationship)
    {
           //This is used to show back links from rules, forms and ifaces to UC's
  $release=Yii::App()->session['release'];
               $project=Yii::App()->session['project'];      
            $sql="
                SELECT 
                `f`.`id` as flow_id,
                `f`.`name` as flow_name,
                `u`.`id` as usecase_dbid,
                `u`.`usecase_id` as usecase_id,
                `u`.`name` as usecase_name,
                `u`.`number` as usecase_number,
                `p`.`number` as package_number
                FROM `".Version::$objects[$object]."` `i`
                JOIN `step".Version::$objects[$object]."` `x`
                ON `x`.`".Version::$objects[$object]."_id`=`i`.`".Version::$objects[$object]."_id`
                JOIN `step` `s`
                ON `s`.`step_id`=`x`.`step_id`
                JOIN `flow` `f`
                ON `f`.`flow_id`=`s`.`flow_id`
                JOIN `usecase` `u`
                ON `f`.`usecase_id`=`u`.`usecase_id`
                JOIN `package` `p`
                ON `p`.`package_id`=`u`.`package_id`
                JOIN `version` `v1`
                ON `v1`.`foreign_key`=`i`.`id` 
                JOIN `version` `v2`
                ON `v2`.`foreign_key`=`x`.`id`
                JOIN `version` `v3`
                ON `v3`.`foreign_key`=`s`.`id`
                JOIN `version` `v4`
                ON `v4`.`foreign_key`=`u`.`id`
                JOIN `version` `v5`
                ON `v5`.`foreign_key`=`p`.`id`
                WHERE 
                `i`.`id`=".$id."
                AND 
                `s`.`project_id`=".$project."
                AND 
                `f`.`project_id`=".$project."
                AND
                `v1`.`object`=".$object."  AND `v1`.`active`=1  AND `v1`.`project_id`=".$project."
                AND `v1`.`release`=".$release." AND
                `v2`.`object`=".$relationship." AND `v2`.`active`=1  AND `v2`.`project_id`=".$project."
                AND `v2`.`release`=".$release."
                AND
                `v3`.`object`=9 AND  `v3`.`active`=1  AND `v3`.`project_id`=".$project."
                    AND `v3`.`release`=".$release."
                AND
                
                `v4`.`object`=10  AND `v4`.`active`=1  AND `v4`.`project_id`=".$project."
                AND `v4`.`release`=".$release."
                AND
                `v5`.`object`=5 AND `v5`.`active`=1  AND `v5`.`project_id`=".$project."
                AND `v5`.`release`=".$release."              
                ";
         
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
	$projects = $command->queryAll();
	return $projects;
    }  
    
    
    
             public function getLinkedObjects($id,$object,$relationship)
    {
            $project=Yii::App()->session['project']; 
            $release=Yii::App()->session['release'];
            
            $sql="
            SELECT 
            `r`.*
            FROM `".Version::$objects[$object]."` `r`
            JOIN `step".Version::$objects[$object]."` `x`
            ON `x`.`".Version::$objects[$object]."_id`=`r`.`".Version::$objects[$object]."_id`
            JOIN `step` `s`
            ON `s`.`step_id`=`x`.`step_id`
            JOIN `flow` `f`
            ON `f`.`flow_id`=`s`.`flow_id`

            JOIN `version` `vr`
            ON `vr`.`foreign_key`=`r`.`id`
            JOIN `version` `vx`
            ON `vx`.`foreign_key`=`x`.`id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id` 

WHERE
            `f`.`usecase_id`=".$id."
        
            AND
            `vr`.`object` =".$object." AND `vr`.`active`=1  AND `vr`.`project_id`=".$project." 
               AND `vr`.`release`=".$release."
            AND
            `vx`.`object` =".$relationship." AND `vx`.`active`=1
            AND `vx`.`project_id`=".$project."          
            AND `vx`.`release`=".$release."   
            AND
            `vs`.`object` =9 AND `vs`.`active`=1 
            AND `vs`.`project_id`=".$project."
            AND `vs`.`release`=".$release."
            AND
            `vf`.`object` =8 AND `vf`.`active`=1  AND `vf`.`project_id`=".$project."
           AND `vf`.`release`=".$release."
             GROUP BY `r`.`id`
             ORDER BY `r`.`number` ASC";
        
         
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
