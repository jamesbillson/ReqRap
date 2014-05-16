<?php

/**
 * This is the model class for table "form".
 *
 * The followings are the available columns in table 'form':
 * @property integer $id
 * @property string $name
 * @property integer $project_id
 *
 * The followings are the available model relations:
 * @property Project $project
 * @property Formproperty[] $formproperties
 */
class Form extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'form';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, form_id,  number, project_id, release_id', 'required'),
			array('form_id, project_id, release_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, form_id, project_id, release_id', 'safe', 'on'=>'search'),
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
			//'formproperties' => array(self::HAS_MANY, 'Formproperty', 'form_id'),
                    'formpropeties'=>array(self::BELONGS_TO,
                                    'Formproperty','form_id',
                                    'joinType'=>'JOIN',
                                    'foreignKey'=>'form_id',
                          'on'=>'form.project_id=formproperty.project_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                    'id' => 'ID',
                    'form_id' => 'FormID',
                    'name' => 'Form Name',
                    'project_id' => 'Project',
                    'number'=>'Number',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('number',$this->name,true);
                $criteria->compare('project_id',$this->project_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        public function getNextNumber()
    {
               $project=Yii::App()->session['project'];    
        $sql="SELECT max(`r`.`number`)as number
           From `form` `r`
            WHERE `r`.`project_id`=".$project;
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
       
              
        $sql="SELECT `r`.`form_id` as `number`
           From `form` `r`
           ORDER BY `number` DESC
           LIMIT 0,1";
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
    
    
        public function getStepForms($id)
    {
       
            
             $sql="SELECT
                 `r`.`name`,
                 `r`.`form_id`,`
                 r`.`number`, 
                 `r`.`id`,
                 `x`.`id` as xid
            From `form` `r`
            JOIN `stepform` `x`
            ON `x`.`form_id`=`r`.`form_id`
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
            `vr`.`object` =2 AND `vr`.`active`=1
            AND
            `vx`.`object` =14 AND `vx`.`active`=1            
            AND
            `vs`.`object` =9 AND `vs`.`active`=1



             GROUP BY `r`.`id`
             ORDER BY `r`.`number` ASC";
            
              
        $sql="SELECT `r`.`name`,`r`.`form_id`,`r`.`number`, `r`.`id`,`x`.`id` as xid
           From `form` `r`
            Join `stepform` `x` 
            on `x`.`form_id`=`r`.`id`
            Join `step` `s` 
            on `x`.`step_id`=`s`.`id`
           WHERE `s`.`id`=".$id;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }  
	 
      public function getProjectForms($id)
    {
          
       $release=Yii::App()->session['release'];
       $project=Yii::App()->session['project'];
        $sql="
            SELECT `r`.`id`,`r`.`form_id`,`r`.`number`,`r`.`name`,`v`.`active`
            FROM `form` `r`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id`
            WHERE 
              `v`.`object`=2
            AND
            `v`.`active`=1 
               and            
            `r`.`release_id`=".$release."         
        and            
            `r`.`project_id`=".$project;
     
        
        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
    
    
    
    /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Form the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
