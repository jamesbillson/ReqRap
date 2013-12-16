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
			array('flow_id, number, text', 'required'),
			array('flow_id, number', 'numerical', 'integerOnly'=>true),
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, usecase_id, flow, number, text', 'safe', 'on'=>'search'),
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
			'flow' => array(self::BELONGS_TO, 'Flow', 'flow_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			
			'flow_id' => 'Flow',
			'number' => 'Number',
			'text' => 'Text',
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
   public function getSteps($id) // GET ALL FOR UC
    {
        $user= Yii::app()->user->id;   
              
        $sql="SELECT `s`.`text`,`f`.`main`,`f`.`name` as flow,`f`.`id` as flowid,
            `f`.`startstep_id` as start, 
            `f`.`rejoinstep_id` as rejoin, `s`.`id`,`s`.`number`
            FROM `step` `s`
            Join `flow` `f` 
            on `f`.`id`=`s`.`flow_id`
            Join `usecase` `u` 
            on `u`.`id`=`f`.`usecase_id`
           WHERE `u`.`id`=".$id."
               ORDER BY main DESC, flow ASC, `s`.`number` ASC";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }

          public function getFlowSteps($id) // GET FOR A FLOW
    {
        $user= Yii::app()->user->id;   
              
        $sql="SELECT `s`.`text`,`f`.`name` as flow, `s`.`id`,`s`.`number`
            FROM `step` `s`
            Join `flow` `f` 
            on `f`.`id`=`s`.`flow_id`
            WHERE `f`.`id`=".$id."
            ORDER BY `s`.`number` ASC";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
    
       
    
      public function getMainSteps($id) // GET MAIN FOR A UC
    {
        $user= Yii::app()->user->id;   
              
        $sql="SELECT `s`.`text`,`f`.`name` as flow, `s`.`id`,`s`.`number`
            FROM `step` `s`
            Join `flow` `f` 
            on `f`.`id`=`s`.`flow_id`
            Join `usecase` `u` 
            on `u`.`id`=`f`.`usecase_id`
            WHERE `u`.`id`=".$id."
            AND main=1
            ORDER BY `s`.`number` ASC";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
    public function getNextNumber($id)
    {
        $user= Yii::app()->user->id;   
              
        $sql="SELECT max(`s`.`number`) as x
            FROM `step` `s`
            Join `flow` `f` 
            on `f`.`id`=`s`.`flow_id`
            WHERE `f`.`id`=".$id;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
                if (!isset($projects[0]['x'])) $projects[0]['x']=0;
		return $projects[0]['x'];
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
