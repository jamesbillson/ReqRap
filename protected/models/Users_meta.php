<?php


class Users_meta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users_meta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, name, value', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>255),
                    array('value', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,user_id, name, value', 'safe', 'on'=>'search'),
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
			
		);
	}

    public function ShowMessage($message)
    {
        $id=Yii::App()->user->id;
              
        $sql="
            SELECT 
            `u`.*
            FROM `users_meta` `u`
       
            WHERE
           `u`.`user_id`=".$id."
               AND
            `u`.`name`='".$message."'   
               ORDER BY `id`
               LIMIT 1";
	 $connection=Yii::app()->db;
      $command = $connection->createCommand($sql);
      $result = $command->queryAll();
      
      $return = (count($result))? TRUE : FALSE;
      return $result;
      

    
    }

        public function Seen($message)
    {
        $id=Yii::App()->user->id;
              
        $sql="
INSERT INTO `users_meta`
(
`user_id`, 
`name`, 
`value`
) 
VALUES 
(
".$id.",
'".$message."',
1)            
    ";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
      

    
    }
    
    
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'value' => 'Value',
			'user_id' => 'User',
		
		);
	}

	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('value',$this->value,true);
	
		$criteria->compare('user_id',$this->user_id);
	

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users_meta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
}
