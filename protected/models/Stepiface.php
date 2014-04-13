<?php

/**
 * This is the model class for table "stepiface".
 *
 * The followings are the available columns in table 'stepiface':
 * @property integer $step_id
 * @property integer $iface_id
 */
class Stepiface extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stepiface';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, stepiface_id, step_id, iface_id, project_id, release_id', 'required'),
			array('id, stepiface_id, step_id, iface_id, project_id, release_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, step_id, iface_id, project_id, release_id', 'safe', 'on'=>'search'),
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
                    
       // 'step' => array(self::BELONGS_TO, 'Step', 'step_id'),
	//'iface' => array(self::BELONGS_TO, 'Iface', 'iface_id'),

   'step' => array(self::BELONGS_TO, 'Step', 
                        array('step_id' => 'step_id'),
                        'on' => 't.project_id = step.project_id',),
                    
   'iface' => array(self::BELONGS_TO, 'Iface', 
                        array('iface_id' => 'iface_id'),
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
                    'stepiface_id'=>'stepiface_id',
                     'project_id' => 'Project',
                    'release_id' => 'Release',
                    'step_id' => 'Step',
			'iface_id' => 'Iface',
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
		$criteria->compare('iface_id',$this->iface_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

              public function getCurrentStepiface($iface_id,$step_id)
    {
       
         
        $sql="
            SELECT 
            `x`.`id`
            FROM `Stepiface` `x`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`x`.`id`
            WHERE 
            `v`.`active`=1
            AND 
            `v`.`object` =15
            AND  
            `x`.`step_id`=".$step_id."
            AND  
            `x`.`iface_id`=".$iface_id;
            

		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects[0]['id'];
    }   
        
    
          public function getActiveStepifaces($id)
    {
       
// so we get the id of the interface.  
// Look up if its got any active stepiface
              
        $sql="
            SELECT
            count(`x`.`id`) as number
            FROM 
            `stepiface` `x`
            JOIN `iface` `i`
            ON `i`.`iface_id`=`x`.`iface_id`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`x`.`id`
            WHERE
            `v`.`active`=1
            AND 
            `v`.`object` =15
            AND
            `v`.`release`=".Yii::App()->session['release']."
                AND
            `i`.`id`=".$id;
            

		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects[0]['number'];
    }   
        
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Stepiface the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
