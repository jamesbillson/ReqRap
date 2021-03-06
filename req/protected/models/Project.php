<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $id
 * @property string $name
 * @property integer $company_id
 */
class Project extends CActiveRecord
{
	public static $buildstage = array(1=>'bidding', 4=>'tendering', 2=>'construction', 3=>'finished');	
        public static $projectstage = array(1=>'Analysis',
                                                2=>'Testing');
 public static $buildstagecreatepm = array(4=>'This is a project I am tendering',
                                                2=>'This is a project I am managing');
        
        
        
        /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Project the static model class
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
		return 'project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('name, company_id, description', 'required'),
		array('company_id', 'numerical', 'integerOnly'=>true),
		array('name', 'length', 'max'=>255),
                array('budget', 'length', 'max'=>10),
                array('extlink', 'length', 'max'=>50),
                array('stage', 'length', 'max'=>4),
                
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
		array('id, name, description, company_id,stage', 'safe', 'on'=>'search'),
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
            //'labelRegions' => array(self::HAS_MANY, 'LabelRegion', 'label_id'),
            'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
            'document'=>array(self::HAS_MANY,'Document','foreign_key'),
            'follower'=>array(self::HAS_MANY,'Follower','foreign_key','condition'=>'type = 1'),
            'tender'=>array(self::HAS_MANY,'Follower','foreign_key','condition'=>'type = 2'),
            'photo'=>array(self::HAS_MANY,'Photo','project_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
                    'description' => 'Description',
			'company_id' => 'Company',
                        'budget' => 'Budget',
                        'stage'=>'Stage',
                     'extlink'=>'External Link',
                   
		);
	}

	public function behaviors() {
        return array(
            'user_meta' => array(
                'class' => 'ext.yiiext.behaviors.model.eav.EEavBehavior',
                'tableName' => 'project_meta',
                'entityField' => 'project_id',
                'attributeField' => 'meta_name',
                'valueField' => 'meta_value',
                'modelTableFk' => 'project_id',
                'safeAttributes' => array(),
            )
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
		$criteria->compare('company_id',$this->company_id);
                $criteria->compare('description',$this->description,true);
               
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
    public function myProjects($type)
    {
        $user= Yii::app()->user->id;   
              
        $sql="SELECT `p`.`name`, `p`.`id`, `p`.`stage` FROM `project` `p`
            Join `company` `c` 
            on `p`.`company_id`=`c`.`id`
            join `user` `u` 
            on `u`.`company_id`=`c`.`id`
            WHERE `u`.`id`=".$user."
            AND `p`.`stage`=".$type;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }

  public function setPermissions($mycompany, $project, $release, $currentrelease)
    {
    // This is my companies requirements, and the release is current.
     //set permission to be 1 owner/contributor 
     Yii::App()->session['permission']=($project->company_id==$mycompany)?1 : 0;
     // set owner to 1 as I own the project.
     Yii::App()->session['owner']=($project->company_id==$mycompany)?1 : 0;
     // I am a follower of this project my role is view only.
     // if I'm not in this company, then am I a follower.
     if($project->company_id!=$mycompany){
     // if I'm a follower then what is my role.    
     $follower=Follower::model()->getProjectFollowerDetails($project->id);
     if(!empty($follower)) Yii::App()->session['permission']=$follower['role'];
     //if I'm not a collaborator, I should only see the last release.
     
     }
     
     
    }
     
    
    public function projectPackageBudget($id)
    {
        $user= Yii::app()->user->id;   
              
        $sql="select sum(`budget`) as total from `package`
            where project_id=".$id;

		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$allocated = $command->queryAll();
		$total = $allocated[0]['total'];
		return $total;
    }
          
    public function projectPackageList($id)
    {
        if(isset($_POST['project_id'])) $id= $_POST['project_id'];   
              
        $sql="select p.sequence, p.name, p.id from package p 
            join project q 
            on p.project_id=q.id
            WHere q.id=".$id."
            order by sequence";
       
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$result = $command->queryAll();
		return $result;
    }   
}