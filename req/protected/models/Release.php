<?php

/**
 * This is the model class for table "release".
 *
 * The followings are the available columns in table 'release':
 * @property integer $id
 * @property string $number
 * @property string $release
 * @property integer $project_id
 * @property integer $status
 */
class Release extends CActiveRecord
{
    public static $status= array(1=>'draft',2=>'release');
    public static $title_status= array(1=>'Draft',2=>'Release');
    
   	
  
 
	public function tableName()
	{
		return 'release';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, project_id, status, create_user', 'required'),
			array('project_id, status, offset', 'numerical', 'integerOnly'=>true),
			array('number', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, number, release, project_id, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		
            return array(
                
                			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
		);
	}

	
        
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'number' => 'Number',
			'project_id' => 'Project',
			'status' => 'Status',
                    'offset'=>'Offset',
                        'create_date'=>'create date',
                        'create_user'=>'create user',
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
		$criteria->compare('number',$this->number,true);
		$criteria->compare('release',$this->release,true);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
 
    public function currentRelease()
    {
          
               $sql="SELECT `r`.`id`
            FROM `release` `r`
            WHERE 
            `r`.`project_id`=".Yii::App()->session['project']."
            AND 
            `r`.`status`=1";
                $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$releases = $command->queryAll();
		if (!empty($releases)){
                    $release=$releases[0]['id'];
                } ELSE {
                    $release=-1;
                }
        return $release;
    }
        public function lastRelease()
    {
          
               $sql="SELECT `r`.*
            FROM `release` `r`
            WHERE 
            `r`.`project_id`=".Yii::App()->session['project']."
            AND 
            `r`.`status`=2
            order by `r`.`number`
            limit 0,1";
                $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$releases = $command->queryAll();
		if (!empty($releases)){
                    $release=$releases[0]['id'];
                } ELSE {
                    $release=-1;
                }
        return $release;
    }
    
        public function lastChange($id)
    {
          
               $sql="SELECT `offset` FROM `release` `r` WHERE `r`.`id`=".$id;
                $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$releases = $command->queryAll();
		if (!empty($releases)){
                    $release=$releases[0]['offset'];
                } ELSE {
                    $release=-1;
                }
        return $release;
    }
    
    
           public function getReleaseHistory($id)//this is the release ID.
    {
// we need to go through each object and get its history of versions.
               
// Objects

// Actors
               
// Categories
               
// -> Simple
               
// UC's (as below)
//  -> Flow
//     -> step
//          ->stepiface
//          ->stepform
//          ->steprule
               
// Rule 
               
// Form
//  ->formpropert

// Iface
//    -> photo


               
$history=array();

$usecaselist=Usecase::model()->getAllReleaseUCs($id); //returns all usecase regardless if they've been deleted

$data=Usecase::model()->getUsecaseVersions($usecase_id);
foreach($data as $uc){


$history[$uc['versionid']]=array(
    'usecase_id'=>$uc['usecase_id'],
    'object_id'=>$uc['usecase_id'],
     'name'=>$uc['name'],
    'detail'=>'',
    'object'=>10,
    'number'=>$uc['number'],
     'action'=>$uc['action'],
     'date'=>$uc['create_date'],
        'firstname'=>$uc['firstname'],
    'lastname'=>$uc['lastname'],
    'active'=>$uc['active'],
     );

    $flows=Usecase::model()->getFlowVersions($uc['usecase_id']);
    foreach($flows as $flow){


$history[$flow['versionid']]=array(
    'object_id'=>$flow['flow_id'],
    'usecase_id'=>$uc['usecase_id'],
     'name'=>$flow['name'],
    'detail'=>'',
    'object'=>8,
    'number'=>$flow['number'],
     'action'=>$flow['action'],
     'date'=>$flow['create_date'],
        'firstname'=>$flow['firstname'],
    'lastname'=>$flow['lastname'],
     'active'=>$flow['active'],
     );

     $steps=Usecase::model()->getStepVersions($flow['flow_id']);
    foreach($steps as $step){

    
$history[$step['versionid']]=array(
    'object_id'=>$step['step_id'],
    'usecase_id'=>$uc['usecase_id'],
    'name'=>$step['name'],
    'detail'=>$step['detail'],
    'object'=>9,
    'number'=>$step['number'],
    'action'=>$step['action'],
    'date'=>$step['create_date'],
    'firstname'=>$step['firstname'],
    'lastname'=>$step['lastname'],
     'active'=>$step['active'],
     );

 
    
    
        $stepifaces=Usecase::model()->getStepifaceVersions($flow['flow_id']);
        foreach($stepifaces as $stepiface){
        $history[$stepiface['versionid']]=array(
            'object_id'=>$stepiface['stepiface_id'],
            'usecase_id'=>$uc['usecase_id'],
            'name'=>$stepiface['name'],
            'detail'=>$stepiface['detail'],
            'object'=>15,
            'number'=>$stepiface['number'],
            'action'=>$stepiface['action'],
            'date'=>$stepiface['create_date'],
            'firstname'=>$stepiface['firstname'],
            'lastname'=>$stepiface['lastname'],
             'active'=>$stepiface['active'],
             );

            }


        $steprules=Usecase::model()->getStepruleVersions($flow['flow_id']);
        foreach($steprules as $steprule){
        $history[$steprule['versionid']]=array(
            'object_id'=>$steprule['steprule_id'],
            'usecase_id'=>$uc['usecase_id'],
            'name'=>$steprule['name'],
            'detail'=>$steprule['detail'],
            'object'=>16,
            'number'=>$steprule['number'],
            'action'=>$steprule['action'],
            'date'=>$steprule['create_date'],
            'firstname'=>$steprule['firstname'],
            'lastname'=>$steprule['lastname'],
             'active'=>$steprule['active'],
             );

            }



        $stepforms=Usecase::model()->getStepformVersions($flow['flow_id']);
        foreach($stepforms as $stepform){
       $history[$stepform['versionid']]=array(
            'object_id'=>$stepform['stepform_id'],
            'usecase_id'=>$uc['usecase_id'],
            'name'=>$stepform['name'],
            'detail'=>'',
            'object'=>14,
            'number'=>$stepform['number'],
            'action'=>$stepform['action'],
            'date'=>$stepform['create_date'],
            'firstname'=>$stepform['firstname'],
            'lastname'=>$stepform['lastname'],
             'active'=>$stepform['active'],
             );

            }
    
    
    }
    
    
    
    
    
    }
}
            
            
		return $history;
    }
    
    
    
         public function createInitial($id)
    {
       $sql="INSERT INTO `release`(
           `number`, 
           `status`, 
           `project_id`,
           `create_user`
           ) VALUES (
           0,
           1, 
           ".$id.",
           ".Yii::app()->user->id.")";
           $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
        
    }   
    
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Version the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
