<?php

/**
 * This is the model class for table "step".
 *
 * The followings are the available columns in table 'step':
 * @property integer $id
 * @property integer $usecase_id
 * @property string $flow
 * @property integer $number
 * @property string $text
 *
 * The followings are the available model relations:
 * @property Usecase $usecase
 */
class Step extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'step';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('flow_id, step_id, number, text,result, actor_id, project_id, release_id', 'required'),
			array('flow_id, step_id, number, project_id, release_id', 'numerical', 'integerOnly'=>true),
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, step_id, usecase_id, flow, number, text, project_id, release_id', 'safe', 'on'=>'search'),
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
			
                'flow' => array(self::BELONGS_TO, 'Flow', 
                 array('flow_id' => 'flow_id'),
                 'on' => 't.project_id = flow.project_id',)

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
                    'step_id'=>'step_id',
                     'project_id' => 'Project',
                    'release_id' => 'Release',
			'result'=>'Result',
			'flow_id' => 'Flow',
			'number' => 'Number',
			'text' => 'Text',
                    'actor_id'=>'Actor'                   
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
		$criteria->compare('usecase_id',$this->usecase_id);
		$criteria->compare('flow',$this->flow,true);
		$criteria->compare('number',$this->number);
		$criteria->compare('text',$this->text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
   

       public function getAltSteps($id) // GET ALL FOR UC
    {
          
          $project=Yii::App()->session['project'];     
        $sql="SELECT 
            `s`.`text`,
            `s`.`result`,
            `a`.`name` as actor,
            `f`.`main`,
            `f`.`name` as flow,
            `f`.`id` as flowid,
            `f`.`flow_id` as flow_id,
                (SELECT `p`.`number` 
                FROM `step` `p` 
                JOIN `version` `pv`
                ON `pv`.`foreign_key`=`p`.`id`
                WHERE 
                f.startstep_id=p.step_id
                AND
                `pv`.`active`=1
                AND 
                `pv`.`object`=9) as start, 

                (SELECT `q`.`number` from `step` `q`  
                JOIN `version` `qv`
                ON qv.foreign_key=q.id
                WHERE 
                f.rejoinstep_id=q.step_id
                AND
                qv.active=1
                AND 
                qv.object=9

                ) as rejoin,
            `s`.`id`,
            `s`.`step_id`,
            `s`.`number`
            FROM `step` `s`
            LEFT Join `actor` `a` 
            on `a`.`actor_id`=`s`.`actor_id`
            Join `flow` `f` 
            on `f`.`flow_id`=`s`.`flow_id`
            Join `usecase` `u` 
            on `u`.`usecase_id`=`f`.`usecase_id`
             JOIN `version` `v`
            ON `v`.`foreign_key`=`s`.`id`
            JOIN `version` `av`
            ON `av`.`foreign_key`=`a`.`id`
           WHERE `u`.`id`=".$id."
           AND
           `v`.`object`=9
            AND
            `v`.`active`=1
            AND 
            `av`.`object`=4
            AND 
            `av`.`active`=1
     
               
               ORDER BY main DESC, flow ASC, `s`.`number` ASC";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
    
          public function getFlowSteps($id) // id is flow_id GET FOR A FLOW
    {
                  $release=Yii::App()->session['release'];
            $project=Yii::App()->session['project'];   
        $sql="SELECT `s`.*,
            `a`.`name` as actor,
            `f`.`name` as flow
            FROM `step` `s`
            Join `flow` `f` 
            on `f`.`flow_id`=`s`.`flow_id`
            Join `actor` `a` 
            on `a`.`actor_id`=`s`.`actor_id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id`
            JOIN `version` `va`
            ON `va`.`foreign_key`=`a`.`id`
            WHERE `f`.`flow_id`=".$id."
            AND
           `vs`.`object`=9 AND `vs`.`active`=1 AND `vs`.`release`=".$release."
            AND
           `vf`.`object`=8 AND `vf`.`active`=1 AND `vf`.`release`=".$release."
            AND
           `va`.`object`=4 AND `va`.`active`=1 AND `va`.`release`=".$release."            
               GROUP BY `s`.`id`
               ORDER BY `s`.`number` ASC";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }

            public function getStepParentFlowByStepID($id) // GET MAIN FOR A UC
    {
        $release=Yii::App()->session['release'];    
              
        $sql="SELECT `f`.*,`s`.`text`, `s`.`result`
            FROM `flow` `f` 
            JOIN `step` `s`
            on `f`.`flow_id`=`s`.`flow_id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id`
          
            WHERE 
            `s`.`step_id`=".$id."
            AND 
            `vs`.`object` =9 AND `vs`.`active`=1 AND `vs`.`release`=".$release."
              
              AND
            `vf`.`object` =8 AND `vf`.`active`=1 AND `vf`.`release`=".$release;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		if(isset($projects[0])) return $projects[0];
    }
    
        public function getStepParentFlow($id) // GET MAIN FOR A UC
    {
        $release=Yii::App()->session['release'];    
              
        $sql="SELECT `f`.*,`s`.`text`, `s`.`result`
            FROM `flow` `f` 
            JOIN `step` `s`
            on `f`.`flow_id`=`s`.`flow_id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id`
          
            WHERE 
            `s`.`id`=".$id."
            AND 
            `vs`.`object` =9 AND `vs`.`active`=1 AND `vs`.`release`=".$release."
              
              AND
            `vf`.`object` =8 AND `vf`.`active`=1 AND `vf`.`release`=".$release;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		if(isset($projects[0])) return $projects[0];
    }
    
      public function getMainSteps($id) // GET MAIN FOR A UC
    {
           $project=Yii::App()->session['project'];
           $release=Yii::App()->session['release'];    
              
        $sql="SELECT `s`.*,
            `f`.`name` as flow
            
            FROM `step` `s`
            Join `flow` `f` 
            on `f`.`flow_id`=`s`.`flow_id`
            Join `usecase` `u` 
            on `u`.`usecase_id`=`f`.`usecase_id`
             JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
              JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id`
            JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`
          
            WHERE `u`.`id`=".$id."
            AND `f`.`main`=1
             AND
            `vs`.`object` =9 AND `vs`.`active`=1 AND `vs`.`release`=".$release."  
              AND
            `vu`.`object` =10 AND `vu`.`active`=1 AND `vu`.`release`=".$release."  
            
             AND
            `vf`.`object` =8 AND `vf`.`active`=1 AND `vf`.`release`=".$release." 
                GROUP BY `s`.`number`
            ORDER BY `s`.`number` ASC";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
    public function getNextNumber($id)
    {
        $release= Yii::app()->session['release'];   
              
        $sql="
            SELECT 
            max(`s`.`number`) as x
            FROM `step` `s`
            Join `flow` `f` 
            on `f`.`flow_id`=`s`.`flow_id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            WHERE `f`.`id`=".$id."
            AND
            `vs`.`object` =9 AND `vs`.`active`=1 AND `vs`.`release`=".$release;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
                if (!isset($projects[0]['x'])) $projects[0]['x']=1;
		return $projects[0]['x'];
    }    
    
       public function insertNumber($number,$flow)
    {
     
              
        $sql="UPDATE `step` `s`
            SET `s`.`number` = `s`.`number`+1 
            WHERE `s`.`number` >=".$number." 
            AND `s`.`flow_id`=".$flow;
	
                $connection=Yii::app()->db;
                $command = $connection->createCommand($sql);
                $command->execute();

    }    
    
    
       public function reNumber($flow_id)
    {
                  $release=Yii::App()->session['release'];
              
        $sql="SELECT `s`.*
            FROM `step` `s`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            WHERE
            `vs`.`object` =9 AND `vs`.`active`=1 AND `vs`.`release`=".$release." 
            AND
            `s`.`flow_id`=".$flow_id."
            ORDER BY `s`.`number` ASC";
	
             	$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
                if (count($projects))
                    {
                    $x=0;
                     foreach($projects as $step)
                        {
                        $x++;
                        $sql="UPDATE `step` SET `number`=".$x."
                        WHERE `id`=".$step['id'];
                        //echo $sql.'<br />';
                        $connection=Yii::app()->db;
                        $command = $connection->createCommand($sql);
                        $command->execute();      
                        }
                    }
    }    
    
               static public function getStepLinks($id,$object,$relation)
    {
          $project=Yii::App()->session['project'];
           $release=Yii::App()->session['release'];
            $sql="
            SELECT
            `r`.*,
            `x`.`id` as xid
            
            FROM `".Version::$objects[$object]."` `r`
            JOIN `step".Version::$objects[$object]."` `x`
            ON `x`.`".Version::$objects[$object]."_id`=`r`.`".Version::$objects[$object]."_id`
            JOIN `step` `s`
            ON `s`.`step_id`=`x`.`step_id`

            JOIN `version` `vr`
            ON `vr`.`foreign_key`=`r`.`id`
            JOIN `version` `vx`
            ON `vx`.`foreign_key`=`x`.`id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
          
        WHERE
            `s`.`id`=".$id."
            AND
            `vr`.`object` =".$object." AND `vr`.`active`=1 AND `vr`.`project_id`=".$project."
                 AND `vr`.`release`=".$release."    
            AND
            `vx`.`object` =".$relation." AND `vx`.`active`=1 AND `vx`.`project_id`=".$project." 
                AND `vx`.`release`=".$release."  
            AND
            `vs`.`object` =9 AND `vs`.`active`=1 AND `vs`.`project_id`=".$project."
                AND `vs`.`release`=".$release."



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
	 * @return Step the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
