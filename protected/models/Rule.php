<?php

/**
 * This is the model class for table "rule".
 *
 * The followings are the available columns in table 'rule':
 * @property integer $id
 * @property string $number
 * @property string $text
 *
 * The followings are the available model relations:
 * @property Ruleusecase $ruleusecase
 */
class Rule extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rule_id, active, number, title,text, project_id, version_id', 'required'),
			array('number', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, active, number, title, text', 'safe', 'on'=>'search'),
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
			'ruleusecase' => array(self::HAS_ONE, 'Ruleusecase', 'rule_id'),
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
                    'rule_id'=>'Rule ID',
			'number' => 'Number',
                    'title' => 'Title',
			'text' => 'Rule Text',
                    'project_id'=>'Project',
                    'version_id'=>'Version',
                    'active'=>'Active',
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
		$criteria->compare('text',$this->text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        
         public function getRules($id)
    {
        $user= Yii::app()->user->id;   
              
        $sql="SELECT `r`.`text`,`r`.`number`, `r`.`id`,`r`.`title`
           From `rule` `r`
            Join `steprule` `x` 
            on `x`.`rule_id`=`r`.`id`
            Join `step` `s` 
            on `x`.`step_id`=`s`.`id`
            Join `flow` `f`
            ON `f`.`id`=`s`.`flow_id`
          
           WHERE `f`.`usecase_id`=".$id."
               GROUP BY `r`.`id`
               ORDER BY `r`.`number`";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
        
            public function getStepRules($id)
    {
       
              
        $sql="SELECT `r`.`text`,`r`.`number`, `r`.`id`,`r`.`title`,`x`.`id` as xid
           From `rule` `r`
            Join `steprule` `x` 
            on `x`.`rule_id`=`r`.`id`
            Join `step` `s` 
            on `x`.`step_id`=`s`.`id`
           WHERE `s`.`id`=".$id;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }  
        public function getNextNumber($id)
    {
       
              
        $sql="SELECT max(`r`.`number`)as number
           From `rule` `r`
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
    
     public function getNextID($id)
    {
       
              
        $sql="SELECT max(`r`.`rule_id`)as number
           From `rule` `r`
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
    
      public function getProjectRules($id)
    {
        $sql="
select *
from rule r
WHERE 
`r`.`active`=1 and            
`r`.`project_id`=".$id;

        /*
                 $sql="
select *
from rule r
inner join(
    select number, max(id) rev
    from rule
    group by number
)ver on r.number = ver.number and r.id = ver.rev            

            WHERE 
`r`.`active`=1 and            
`r`.`project_id`=".$id;
         */
        
        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
    
    
             public function rollback($number,$id)
            {
    
              $sql="UPDATE Rule
                  Set active=0
                  WHERE
                  number=".$number;
                 $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
        
              $sql="UPDATE Rule
                  Set active=1
                  WHERE
                  id=".$id;
                 $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();        
        
        
                 }  

    
    
         public function getVersions($id)
    {
        $sql="select `r`.`rule_id`,
                `r`.`id`,
                `r`.`number`,
                `r`.`title`,
                `r`.`text`,
                `r`.`active`,
                `v`.`number` as ver_numb,
                `v`.`release`,
                `v`.`action`,
                `v`.`create_date`,
                `v`.`create_user`,
                `u`.`firstname`,
                `u`.`lastname`
                from `rule` `r`
                join `version` `v`
                ON
                `r`.`version_id`=`v`.`id`
                join `user` `u`
                ON
                `u`.`id`=`v`.`create_user`
                WHERE 
                `r`.`rule_id`=".$id;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Rule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
