<?php

/**
 * This is the model class for table "flow".
 *
 * The followings are the available columns in table 'flow':
 * @property integer $id
 * @property string $Name
 * @property integer $usecase_id
 * @property integer $main
 * @property integer $startstep_id
 * @property integer $rejoinstep_id
 */
class Flow extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'flow';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, flow_id, usecase_id, project_id, release_id, main, startstep_id, rejoinstep_id', 'required'),
			array('usecase_id, project_id, release_id, flow_id, main, startstep_id, rejoinstep_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, project_id, release_id, flow_id, usecase_id, main, startstep_id, rejoinstep_id', 'safe', 'on'=>'search'),
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
                    
                   'usecase' => array(self::BELONGS_TO, 'Usecase',
                       array('usecase_id' => 'usecase_id'),
                        'on' => 't.project_id = usecase.project_id',)
                     
                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
                        'flow_id' => 'Flow_ID',
			'name' => 'Name',
			'usecase_id' => 'Usecase',
			'main' => 'Main',
			'startstep_id' => 'Startstep',
			'rejoinstep_id' => 'Rejoinstep',
                     'project_id' => 'Project',
                    'release_id' => 'Release',
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
		$criteria->compare('name',$this->Name,true);
		$criteria->compare('usecase_id',$this->usecase_id);
		$criteria->compare('main',$this->main);
		$criteria->compare('startstep_id',$this->startstep_id);
		$criteria->compare('rejoinstep_id',$this->rejoinstep_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
          public function getNextFlow($id)
    {
           
               $release=Yii::App()->session['release'];
        $sql="
            SELECT  `f` . * 
            FROM  `flow`  `f` 
            JOIN  `usecase`  `u` ON  `f`.`usecase_id` =  `u`.`usecase_id` 
            JOIN  `version`  `vu` ON  `vu`.`foreign_key` =  `u`.`id` 
            JOIN  `version`  `vf` ON  `vf`.`foreign_key` =  `f`.`id` 
            WHERE  `u`.`usecase_id` =".$id."
            AND  `vu`.`object` =10
            AND  `vu`.`active` =1
            AND  `vu`.`release` =".$release."
            AND  `vf`.`object` =8
            AND  `vf`.`active` =1
            AND  `vf`.`release` =".$release."
            AND  `f`.`main` =0
            ORDER BY  `f`.`id` 
            ";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
               return $projects;
    }    
    
              public function checkSteps($id)
    {
       
              $release=Yii::App()->session['release'];
        $sql="SELECT `f`.`id`,count(`s`.`id`) as steps
            

            FROM  `flow`  `f` 
            JOIN  `step`  `s` ON  `f`.`flow_id` =  `s`.`flow_id` 
            JOIN  `version`  `vs` ON  `vs`.`foreign_key` =  `s`.`id` 
            JOIN  `version`  `vf` ON  `vf`.`foreign_key` =  `f`.`id` 
            WHERE
            `f`.`id` =".$id."
            AND  `vs`.`object` =9
            AND  `vs`.`active` =1
            AND  `vs`.`release` =".$release."
            AND  `vf`.`object` =8
            AND  `vf`.`active` =1
            AND  `vf`.`release` =".$release;
        
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
                
		return $projects[0]['steps'];
    }    

         public function getUCFlow($id)
    {
         $project=Yii::app()->session['project'];
         $release=Yii::App()->session['release'];
              
        $sql="SELECT `f`.*,
            
                (SELECT `p`.`number` 
                FROM `step` `p` 
                JOIN `version` `pv`
                ON `pv`.`foreign_key`=`p`.`id`
                WHERE 
                f.startstep_id=p.step_id
                AND
                `pv`.`active`=1
                AND 
                `pv`.`object`=9
                AND
                pv.project_id=".$project."
                      AND
                pv.release=".$release."
                    ) as start, 

                (SELECT `q`.`number` from `step` `q`  
                JOIN `version` `qv`
                ON qv.foreign_key=q.id
                WHERE 
                f.rejoinstep_id=q.step_id
                AND
                qv.active=1
                AND 
                qv.object=9
                AND
                qv.project_id=".$project."
                AND
                qv.release=".$release."
                ) as rejoin


              FROM `flow` `f`
              JOIN `usecase` `u`
              ON `u`.`usecase_id`=`f`.`usecase_id`
              
              JOIN `version` `vf`
              ON `vf`.`foreign_key`=`f`.`id`
              
              JOIN `version` `vu`
              ON `vu`.`foreign_key`=`u`.`id`
              
              
              WHERE 
              `u`.`project_id`=".$project."

              AND 
              `f`.`project_id`=".$project."
              AND
              `f`.`release_id`=".$release." 
             
              AND 
              `vu`.`object`=10 AND `vu`.`active`=1 AND `vu`.`release`=".$release."
              AND
              `vf`.`object`=8 AND `vf`.`active`=1 AND `vf`.`release`=".$release." 
              AND
              `u`.`id`=".$id."
              ORDER BY `f`.`main` DESC, `f`.`name` ASC
                ";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
                
		return $projects;
    }    
    
  
    
    
           public function getFlowParentUsecase($id)
    {
         $release=Yii::App()->session['release'];
              
        $sql="SELECT `u`.*
             FROM `usecase` `u`
             JOIN `flow` `f`
             ON  `u`.`usecase_id`=`f`.`usecase_id`
             JOIN `version` `vf`
             ON `vf`.`foreign_key`=`f`.`id`
             JOIN `version` `vu`
             ON `vu`.`foreign_key`=`u`.`id`
             WHERE 
             `vu`.`object`=10 AND `vu`.`active`=1 AND `vu`.`release`=".$release."
             AND
             `vf`.`object`=8 AND `vf`.`active`=1 AND `vf`.`release`=".$release." 
             AND
             `f`.`id`=".$id;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
                
		return $projects[0];
    }    
    
    
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Flow the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
