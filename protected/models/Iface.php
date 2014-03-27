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
			array('number, iface_id, name, type_id, project_id, release_id', 'required'),
			array('iface_id, number, type_id, photo_id, project_id, release_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, iface_id, photo_id,number, name, type_id, project_id, release_id', 'safe', 'on'=>'search'),
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
                    'release_id' => 'Release',
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
             $project=Yii::App()->session['project']; 
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
            JOIN `stepiface` `x`
            ON `x`.`iface_id`=`i`.`iface_id`            
            JOIN `step` `s`
            ON `s`.`step_id`=`x`.`step_id`
            JOIN `flow` `f`
            ON `f`.`flow_id`=`s`.`flow_id`

            JOIN `version` `vr`
            ON `vr`.`foreign_key`=`i`.`id`
            JOIN `version` `vx`
            ON `vx`.`foreign_key`=`x`.`id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id` 

WHERE
            `f`.`usecase_id`=".$id."
            AND `f`.`project_id`=".$project."    
            AND `i`.`project_id`=".$project."
            AND `s`.`project_id`=".$project."
            AND `x`.`project_id`=".$project."
            AND `t`.`project_id`=".$project."
            AND
            `vr`.`object` =12 AND `vr`.`active`=1  AND `vr`.`project_id`=".$project."
            AND
            `vx`.`object` =15 AND `vx`.`active`=1   AND `vx`.`project_id`=".$project."          
            AND
            `vs`.`object` =9 AND `vs`.`active`=1 AND `vs`.`project_id`=".$project."
            AND
            `vf`.`object` =8 AND `vf`.`active`=1  AND `vf`.`project_id`=".$project."
 



             GROUP BY `i`.`id`
             ORDER BY `t`.`number` ASC, `i`.`number` ASC";
        
      
        
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
        
   
      
     public function getProjectIfaces()
    {
         $project=Yii::App()->session['project'];
        $sql="
            SELECT `r`.*,`v`.`active`
            FROM `iface` `r`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id`
            WHERE 
              `v`.`object`=12 AND `v`.`active`=1 AND `v`.`project_id`=".$project."
              and            
            `r`.`project_id`=".$project;

     
        
        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
    
      public function getNextIfaceNumber()
    {
          $project=Yii::App()->session['project'];         
        $sql="SELECT max(`r`.`number`)as number
                From `iface` `r`
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
    
          public function createTypes($id)
    {
      $initial=array(0=>'Not Classified',1=>'Web interface',2=>'Email');
         for ($case = 0; $case <= 2; $case++) 
         {       
      
       $type_id=Version::model()->getNextID(13);
       $sql="INSERT INTO `interfacetype`(
           `number`, 
           `interfacetype_id`,
           
           `release_id`,
           `name`,
           `project_id`) 
           VALUES 
           (0,
           ".$type_id.",
               ".Release::model()->currentRelease(Yii::app()->session['project']).",
           '".$initial[$case]."',
           ".$id.")";
       $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
        
        $sql="select `a`.`id` from `interfacetype` `a` 
            where
            `a`.`interfacetype_id` = ".$type_id."
            AND                
            `a`.`project_id`=".$id;
      
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        Version::model()->getNextNumber($id,13,1,$result[0]['id'],$type_id); 
           }
    
        
    }   

            
         
                    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
