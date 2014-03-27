<?php

/**
 * This is the model class for table "formproperty".
 *
 * The followings are the available columns in table 'formproperty':
 * @property integer $id
 * @property integer $form_id
 * @property string $name
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Form $form
 */
class Formproperty extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'formproperty';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('form_id, number, formproperty_id, name, description, project_id, release_id', 'required'),
			array('formproperty_id,number, form_id, project_id, release_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, number, formproperty_id, form_id, name, description, project_id, release_id', 'safe', 'on'=>'search'),
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
			//'form' => array(self::BELONGS_TO, 'Form', '','on'=>$model->form_id.'=form.form_id'),
		              
                            'form'=>array(self::BELONGS_TO,
                                    'form','form_id',
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
                    'formproperty_id' => 'Formpropertyid',
                     'project_id' => 'Project',
                    'release_id' => 'Release',
			'form_id' => 'Form',
                    'number' => 'Number',
			'name' => 'Name',
			'description' => 'Description',
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
		$criteria->compare('form_id',$this->form_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Formproperty the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
           public function getNextNumber($id)
    {
                   
        $sql="SELECT max(`r`.`number`)as number
           From `formproperty` `r`
            WHERE `r`.`form_id`=".$id;
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
       
              
        $sql="SELECT `r`.`formproperty_id` as `number`
           From `formproperty` `r`
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
    
    
    
      public function getFormProperty($id)
    {
        $sql="
            SELECT 
            `r`.`id`,
            `r`.`formproperty_id`,
            `r`.`number`,
            `r`.`description`,
            `r`.`name`,
            `v`.`active`
            FROM `formproperty` `r`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id`
            WHERE 
              `v`.`object`=3
            AND
            `v`.`project_id`=".Yii::App()->session['project']."
                and
            `v`.`active`=1 
            and            
            `r`.`form_id`=".$id." 
             and 
             `r`.`project_id`=".Yii::App()->session['project']."
             order by `r`.`number`";

     
        
        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
    
         public function rollback($number,$id)
            {
    
              $sql="UPDATE `version`
                  Set `active`=0
                  WHERE
                  `object`=3
                  AND
                  `foreign_id`=".$number;
                $connection=Yii::app()->db;
                $command = $connection->createCommand($sql);
                $command->execute();
        
              $sql="UPDATE `version`
                  Set active=1
                  WHERE
                   `object`=3
                  AND
                  `foreign_key`=".$id;
                 $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();        
        
        
                 }  
    
        
}
