<?php

/**
 * This is the model class for table "package".
 *
 * The followings are the available columns in table 'package':
 * @property integer $id
 * @property string $name
 * @property integer $project_id
 */
class Package extends CActiveRecord
{
 public static $packagestage= array(1=>'Bidding', 2=>'Let', 3=>'Progress',4=>'Complete'); 	
public static $packagestageicon= array(1=>'icon-time text-warning',
                                        2=>'icon-check text-success',
                                        3=>'icon-play',
                                        4=>'icon-ok-sign'); 	

    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Package the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'package';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, package_id, project_id, release_id, stage, number', 'required'),
			array('package_id, project_id, release_id', 'numerical', 'integerOnly'=>true),
                        array('budget, stage', 'numerical', 'integerOnly'=>false),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, package_id, name, stage, project_id, release_id, number', 'safe', 'on'=>'search'),
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
              'packagedocument'=>array(self::HAS_ONE,'Packagedocument','package_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
		'id' => 'ID',
                    'package_id'=>'package id',
		'name' => 'Name',
		 'project_id' => 'Project',
                    'release_id' => 'Release',
                'budget'=>'Budget',
                'number'=>'Sequence'
                   
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('project_id',$this->project_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
         public function getNextNumber($id)
    {
       
              
        $sql="SELECT max(`p`.`number`)as number
           From `package` `p`
            WHERE `p`.`project_id`=".$id;
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
        
         public function getPackages($id) // project id
    {
     
                 $release=Yii::App()->session['release'];
       $project=Yii::App()->session['project'];    
     
    
     $sql="
            SELECT `r`.`id`,`r`.`package_id`,`r`.`number`,`r`.`name`,`v`.`active`
            FROM `package` `r`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id`
            WHERE 
              `v`.`object`=5
            AND
            `v`.`active`=1 
            and            
            `r`.`project_id`=".$project." 
            and
            `r`.`release_id`=".$release."
            order by number ASC";
      
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $contacts = $command->queryAll();
        return $contacts;
        }
        
                 public function createInitial($id)
    {
        $package_id=Version::model()->getNextID(5);
           $sql="INSERT INTO `package`(
               `package_id`,
               `project_id`,
               `release_id`,
               `number`,
               `name`) VALUES 
           (".$package_id.",
               ".$id.",
               ".Release::model()->currentRelease($id).",
               1,
               'System'
               )";
           $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
        $sql="select `p`.`id` 
            from 
            `package` `p` 
            where
            `p`.`project_id`=".$id;
      
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        Version::model()->getNextNumber($id,5,1,$result[0]['id'],$package_id);   
                     
    }   
        
        
   
     
    
    
    
}