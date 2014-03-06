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
			array('name, usecase_id, package_id, actor_id, number,description,preconditions', 'required'),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, usecase_id,  name', 'safe', 'on'=>'search'),
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
                        
                    'package'=>array(self::BELONGS_TO,
                                    'package','package_id',
                                    'joinType'=>'JOIN',
                                    'foreignKey'=>'package_id'),
                    
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
             
          $sql="
            SELECT `r`.*,`v`.`active`
            FROM `usecase` `r`
            LEFT JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id`
            JOIN `package` `p` 
            ON `p`.`package_id`=`r`.`package_id`
            WHERE 
            `v`.`object`=10
            AND
            `v`.`active`=1
            AND
            `p`.`package_id`=".$id;
        
        
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
    
      public function getNextNumber($id)
    {
       
              
            $sql="SELECT max(`r`.`number`)as number
                    From `usecase` `r`
                    WHERE `r`.`package_id`=".$id;
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
       if ($dir==1) {
           $order='ASC';
           $compare='>';
       }
       if ($dir==2) {
           $order='DESC';
           $compare='<';
       }
              
            $sql="SELECT `r`.`number`,`r`.`id`
                    From `usecase` `r`
                    WHERE `r`.`number`".$compare.$id."
                    ORDER BY `r`.`number` ".$order."
                    LIMIT 0,1"
                    ;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
	
		return $projects[0]['id'];
    }  
    
    
               public function getProjectUCs($id)
    {
        $user= Yii::app()->user->id;   
              
        $sql="SELECT `u`.*,
            `p`.`name` as packname,`p`.`id` as packid,`p`.`number` as packnumber,
            `s`.`id` as steps
            FROM `package` `p`

            LEFT JOIN  `usecase` `u`
            on `p`.`id`=`u`.`package_id`
                        JOIN `version` `v`
            ON `v`.`foreign_key`=`u`.`id`
            Join `project` `r`
            ON `r`.`id` =`p`.`project_id`
            LEFT Join `flow` `f`
            ON `u`.`id`=`f`.`usecase_id`
            LEFT Join `step` `s`
            ON `f`.`id`=`s`.`flow_id`
            WHERE 
            `r`.`id`=".$id." 
            AND
            `v`.`active`=1  
            AND
            `v`.`object`=10
                GROUP BY `u`.`id`
                ORDER BY 
             `p`.`number` ASC,              
             `u`.`number` ASC";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }   
             public function getProjectIfaces($id)
    {
        $sql="
            SELECT `r`.*,`v`.`active`
            FROM `iface` `r`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id`
            WHERE 
              `v`.`object`=12
            AND
            `v`.`active`=1 and            
            `r`.`project_id`=".$id;

     
        
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
