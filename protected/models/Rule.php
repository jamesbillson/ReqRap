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
			array('rule_id,  number, name,text, project_id, release_id ', 'required'),
			array('number', 'length', 'max'=>4),
                    array('rule_id, project_id, release_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, number, name, text, project_id, release_id', 'safe', 'on'=>'search'),
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
                    'rule_id'=>'Rule ID',
			'number' => 'Number',
                    'name' => 'Name',
			'text' => 'Rule Text',
                     'project_id' => 'Project',
                    'release_id' => 'Release',
                  
                    
		);
	}


        
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
    
 
    
      public function getProjectRules($id)
    {
       $release=Yii::App()->session['release'];
       $project=Yii::App()->session['project'];
          
        $sql="
            SELECT `r`.`id`,`r`.`rule_id`,`r`.`number`,`r`.`name`,`r`.`text`,`v`.`active`
            FROM `rule` `r`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id`
            WHERE 
              `v`.`object`=1
            AND
            `v`.`active`=1 
            and            
            `r`.`release_id`=".$release."         
            and            
            `r`.`project_id`=".$project."
             ORDER BY `r`.`number`";

     
        
        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
       public function getProjectDeletedRules($id)
    {
        $sql="
        SELECT *
        from `rule` `r`
        WHERE 
        `r`.`project_id`=".$id."  
        AND `r`.`rule_id` NOT IN (
        SELECT `x`.`id`
        FROM `rule` `x`
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
    
          public function getStepRules($id)  //this is step_id
    {
       $release=Yii::App()->session['release'];
          
             $sql="SELECT
                 `r`.*,
                 `x`.`id` as xid
            From `rule` `r`
            JOIN `steprule` `x`
            ON `x`.`rule_id`=`r`.`rule_id`
            JOIN `step` `s`
            ON `s`.`step_id`=`x`.`step_id`

            JOIN `version` `vr`
            ON `vr`.`foreign_key`=`r`.`id`
            JOIN `version` `vx`
            ON `vx`.`foreign_key`=`x`.`id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
          
        WHERE
            `s`.`step_id`=".$id."
            AND
            `vr`.`object` =1 AND `vr`.`active`=1 AND `vr`.`release`=".$release."
            AND
            `vx`.`object` =16 AND `vx`.`active`=1  AND `vx`.`release`=".$release."           
            AND
            `vs`.`object` =9 AND `vs`.`active`=1  AND `vs`.`release`=".$release."



             GROUP BY `r`.`id`
             ORDER BY `r`.`number` ASC";
         
          
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }  
    
        public function Renumber() // renumber all the packages in current release
	{
          
            $rules=$this->getProjectRules();
            $counter=1;     
            foreach ($rules as $rule) {
            $model= $this->findbyPK($rule['id']);
            $model->number = $counter;
            $model->save(false);
            $counter++;
          } 
        
        }
    
    
    /*
             public function rollback($number,$id)
            {
    
              $sql="UPDATE `version`
                  Set `active`=0
                  WHERE
                  `object`=1
                  AND
                  `foreign_id`=".$number;
                $connection=Yii::app()->db;
                $command = $connection->createCommand($sql);
                $command->execute();
        
              $sql="UPDATE `version`
                  Set active=1
                  WHERE
                   `object`=1
                  AND
                  `foreign_key`=".$id;
                 $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();        
        
        
                 }  
*/
    
    

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
