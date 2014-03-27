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
                    
               
                      'usecase'=>array(self::BELONGS_TO,
                                    'Usecase',
                          'usecase_id,usecase_id',
                                                              )
                    
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
           
              
        $sql="SELECT `f`.`name`
            FROM `flow` `f`
            Join `usecase` `u` 
            on `f`.`usecase_id`=`u`.`usecase_id`
            WHERE `u`.`id`=".$id."
            AND 
            `f`.`main`=0
            order by name DESC
            LIMIT 1
            ";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
                if (!isset($projects[0]['name'])) {
                    $projects[0]['name']='A';
                } ELSE {
                    $projects[0]['name']=chr(ord($projects[0]['name'])+1);
                }
		return $projects[0]['name'];
    }    
    
              public function checkSteps($id)
    {
       
              
        $sql="SELECT `f`.`id`,count(`s`.`id`) as steps
              FROM `flow` `f`
              JOIN `step` `s` 
              ON `s`.`flow_id`=`f`.`id`
              WHERE `f`.`id`=".$id."
              ";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
                
		return $projects[0]['steps'];
    }    

         public function getUCFlow($id)
    {
         $project=Yii::app()->session['project'];
              
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
                `vu`.`object`=10 AND `vu`.`active`=1 AND `vu`.`project_id`=".$project."
              AND
              `vf`.`object`=8 AND `vf`.`active`=1 AND `vf`.`project_id`=".$project."
              AND
              `u`.`id`=".$id."
              ORDER BY `f`.`main` DESC
                ";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
                
		return $projects;
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
