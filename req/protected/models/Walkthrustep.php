<?php

class Walkthrustep extends CActiveRecord
{

	public function tableName()
	{
		return 'walkthrustep';
	}


	public function rules()
	{

		return array(
			array('action, result', 'safe'),
			array('id, action, result', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
	return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
                        'walkthrupath_id' => 'Walk Through Path',
                        'number'=>'Number',
			'action' => 'Action',
			'result' => 'Result',
		);
	}

        
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('result',$this->result,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
  public function getLastStep($id)
    {
       
              
            $sql="SELECT t.id, t.number
                    From `walkthrustep` `t`
                    WHERE `t`.`walkthrupath_id`=".$id."
                ORDER BY number DESC Limit 1        
                ";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects[0]['number'];
    }  
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Walkthrustep the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
