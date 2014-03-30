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
			array('number, project_id, status, create_date, create_user', 'required'),
			array('project_id, status', 'numerical', 'integerOnly'=>true),
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
            ORDER BY
            `r`.`id` DESC
            Limit 0,1";
                $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$releases = $command->queryAll();
		$release=$releases[0]['id'];
        return $release;
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
