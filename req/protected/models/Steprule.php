<?php

/**
 * This is the model class for table "steprule".
 *
 * The followings are the available columns in table 'steprule':
 * @property integer $step_id
 * @property integer $rule_id
 */
class Steprule extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'steprule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('steprule_id,step_id, rule_id, project_id, release_id', 'required'),
			array('id,step_id, rule_id, project_id, release_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,steprule_id,step_id, rule_id, project_id, release_id', 'safe', 'on'=>'search'),
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
                  //  'step' => array(self::BELONGS_TO, 'Step', 'step_id'),
                  //  'rule' => array(self::BELONGS_TO, 'Rule', 'rule_id'),
'step' => array(self::BELONGS_TO, 'Step', 
                        array('step_id' => 'step_id'),
                        'on' => 't.project_id = step.project_id',),
                    
   'rule' => array(self::BELONGS_TO, 'Iface', 
                        array('rule_id' => 'rule_id'),
                        'on' => 't.project_id = iface.project_id',)	
                    );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
		'id' => 'ID',	
                'steprule_id'=>'steprule_id',
                     'project_id' => 'Project',
                    'release_id' => 'Release',
                'step_id' => 'Step',
		'rule_id' => 'Rule',
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

		$criteria->compare('step_id',$this->step_id);
		$criteria->compare('rule_id',$this->rule_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

               public function getCurrentSteprule($rule_id,$step_id)
    {
       
         
        $sql="
            SELECT 
            `x`.`id`
            FROM `Steprule` `x`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`x`.`id`
            WHERE 
            `v`.`active`=1
            AND 
            `v`.`object` =16
            AND  
            `x`.`step_id`=".$step_id."
            AND  
            `x`.`rule_id`=".$rule_id;
            

		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects[0]['id'];
    }   
        
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Steprule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
