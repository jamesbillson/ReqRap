<?php

/**
 * This is the model class for table "diary".
 *
 * The followings are the available columns in table 'diary':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $project_id
 * @property integer $user_id
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Project $project
 */
class Diary extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'diary';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, project_id, user_id', 'required'),
			array('project_id, user_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, content, project_id, user_id, create_date', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
		);
	}

    public function getCompanyFeed()
    {
        $company=User::model()->myCompany();  
              
        $sql="Select `d`.`id`,
            `d`.`title`,`d`.`content`,
            `d`.`create_date`, `p`.`name`,
            `p`.`id` as pid,
            `u`.`firstname`, `u`.`lastname`
            FROM `diary` `d`
            JOIN `user` `u`
            ON `u`.`id`=`d`.`user_id`
            JOIN `project` `p`
            ON `p`.`id`=`d`.`project_id`            
            JOIN `company` `c` 
            ON `c`.`id`=`p`.`company_id`
            
           WHERE
           `c`.`id`=".$company."
               ORDER BY create_date DESC
               LIMIT 10";
	 $connection=Yii::app()->db;
      $command = $connection->createCommand($sql);
      $result = $command->queryAll();
      
      return $result;

    
    }
       public function getProjectFeed($id)
    {
      
              
        $sql="Select `d`.`id`,
            `d`.`title`,`d`.`content`,
            `d`.`create_date`, `p`.`name`,
            `p`.`id` as pid,
            `u`.`firstname`, `u`.`lastname`
            FROM `diary` `d`
            JOIN `user` `u`
            ON `u`.`id`=`d`.`user_id`
            JOIN `project` `p`
            ON `p`.`id`=`d`.`project_id`            

            
           WHERE
           `p`.`id`=".$id."
               ORDER BY create_date DESC
               LIMIT 10";
	 $connection=Yii::app()->db;
      $command = $connection->createCommand($sql);
      $result = $command->queryAll();
      
      return $result;

    
    }   
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'content' => 'Content',
			'project_id' => 'Project',
			'user_id' => 'User',
			'create_date' => 'Create Date',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Diary the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
}
