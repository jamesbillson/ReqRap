<?php

/**
 * This is the model class for table "version".
 *
 * The followings are the available columns in table 'version':
 * @property integer $id
 * @property string $number
 * @property string $release
 * @property integer $project_id
 * @property integer $status
 */
class Version extends CActiveRecord
{
 public static $objects= array(1=>'rule'); 
 public static $actions= array(1=>'create',2=>'update',3=>'delete'); 
   	
  
 
	public function tableName()
	{
		return 'version';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, release, project_id, status,object, action,create_date, create_user', 'required'),
			array('project_id, status', 'numerical', 'integerOnly'=>true),
			array('number, release', 'length', 'max'=>6),
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
		);
	}

	
        
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'number' => 'Number',
			'release' => 'Release',
			'project_id' => 'Project',
			'status' => 'Status',
                    'object'=>'Object',
                    'action'=>'Action',
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

                 public function createInitial($id)
    {
      
                     
                          $sql="SELECT `r`.`id`
            FROM `release` `r`
            WHERE 
            `r`.`project_id`=".$id."
            ORDER BY
            `r`.`id` DESC
            Limit 0,1";
                $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$releases = $command->queryAll();
		$release=$releases[0]['id'];
                          
                     
           $sql="INSERT INTO `version`(
           `number`, 
           `release`, 
           `project_id`,
           `status`,
           `object`,
           `action`,
           `create_user`
           ) VALUES (
           1,
           ".$release.",
           ".$id.",
           1,
           0,
           0,
           ".Yii::app()->user->id.")";
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
    }   
        
        
        
             public function getNextNumber($id,$object, $action)
    {
       
           /*   
        $sql="
           SELECT `v`.`number`
            FROM `version` `v`
            inner join(
            select `project_id`, max(`number`) `vers`
            from `version`
             )`ver`
            on `v`.`project_id` = `ver`.`project_id` and `v`.`number` = `ver`.`vers` 
            WHERE `v`.`project_id`=".$id;
*/
                 
                 $sql=" SELECT `v`.`number`
                        FROM `version` `v`
                        WHERE 
                        `v`.`project_id`=".$id."
                        ORDER BY
                        `v`.`number` DESC
                        Limit 0,1";


 
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		   if (!isset($projects[0]['number'])) {
                    $number='0';
                } ELSE {
                    $number=$projects[0]['number']+1;
                }
          
                
                
          $sql="INSERT INTO `version`(
              `number`,
              `release`, 
              `project_id`,
              `status`,
              `object`,
              `action`,
              `create_date`,
              `create_user`) 
              VALUES
              ('".$number."',
                '".Release::model()->currentRelease($id)."'
                ,".$id.",
                1,
                ".$object.",
                ".$action.",
                now(),
                ".Yii::app()->user->id."
                )";
          
                 $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
       return Yii::app()->db->getLastInsertID();
		
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
