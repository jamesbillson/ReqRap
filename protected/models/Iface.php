<?php

/**
 * This is the model class for table "iface".
 *
 * The followings are the available columns in table 'iface':
 * @property integer $id
 * @property integer $number
 * @property string $name
 * @property integer $type_id
 *
 * The followings are the available model relations:
 * @property Interfacetype $type
 * @property Interfaceusecase $interfaceusecase
 */
class Iface extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'iface';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, iface_id, name, type_id, project_id', 'required'),
			array('iface_id, number, type_id, photo_id, project_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, iface_id, photo_id,number, name, type_id', 'safe', 'on'=>'search'),
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
			'type' => array(self::BELONGS_TO, 'Interfacetype', 'type_id'),
                    'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'interfaceusecase' => array(self::HAS_ONE, 'Interfaceusecase', 'interface_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'iface_id' => 'ifaceID',
                        'number' => 'Number',
			'name' => 'Name',
			'type_id' => 'Type',
                    'project_id' => 'Project',
                    'photo_id'=>'Image'
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
		$criteria->compare('number',$this->number);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type_id',$this->type_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

         public function getIfaces($id)
    {
   // GET All interfaces belonging to steps that belong to this UC.
             
        $sql="SELECT 
            `i`.`number`,
            `i`.`iface_id`,
            `i`.`name`, 
            `i`.`type_id`,
            `i`.`id`,
            `t`.`name` as type, 
            `t`.`number` as typenum
            FROM `iface` `i`
            JOIN `interfacetype` `t` 
            on `i`.`type_id`=`t`.`interfacetype_id`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`i`.`id`
            WHERE `iface_id` IN
            ( SELECT
            `x`.`iface_id`
            FROM 
            `stepiface` `x`
            
            JOIN `step` `s`
            ON `s`.`step_id`=`x`.`step_id`
            JOIN `flow` `f` 
            on `f`.`flow_id`=`s`.`flow_id`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`x`.`id`
            WHERE
            `v`.`active`=1
           AND 
           `v`.`object` =15
           AND
            `f`.`usecase_id`=".$id."
           )    


             AND
            `v`.`object` =12
             AND
             `v`.`active`=1
             GROUP BY `i`.`id`
             ORDER BY `t`.`number` ASC, `i`.`number` ASC";
        
      
        
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
        
        public function getStepIfaces($id)
    {
       
            /*
            
             Query logic, is to select all the iface_id's  that relate to 
             valid relationships.
             Then select all the current versions of those. 
             
            
            */
        $sql="
            SELECT 
            `i`.`number`,
            `i`.`name`, 
            `i`.`type_id`,
            `i`.`id`,
            `i`.`iface_id`
            FROM `iface` `i`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`i`.`id`
            WHERE 
            `v`.`active`=1
            AND 
            `v`.`object` =12
            AND `iface_id` IN
           ( SELECT
            `x`.`iface_id`
            FROM 
            `stepiface` `x`
            JOIN `step` `s`
            ON `s`.`step_id`=`x`.`step_id`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`x`.`id`
            WHERE
            `v`.`active`=1
           AND 
           `v`.`object` =15
           AND
            `s`.`id`=".$id."
           )    
            ";
            

		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }   
  
   
      
     public function getProjectIfaces($id)
    {
        $sql="
            SELECT `r`.*,`v`.`active`
            FROM `iface` `r`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id`
            WHERE 
              `v`.`object`=12
            AND
            `v`.`active`=1 and            
            `r`.`project_id`=".$id;

     
        
        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
    
      public function getNextIfaceNumber($id)
    {
                   
        $sql="SELECT max(`r`.`number`)as number
           From `iface` `r`
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
    
          public function createTypes($id)
    {
       $sql="INSERT INTO `interfacetype`(`number`, `interfacetype_id`, `name`, `project_id`) VALUES 
           (0,1,'Not Classified', ".$id."),(1,2,'Web Interface', ".$id."),(2,3,'Email', ".$id.")";
                 $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
    }   
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Iface the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
