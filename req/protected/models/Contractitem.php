<?php

/**
 * This is the model class for table "contractitem".
 *
 * The followings are the available columns in table 'contractitem':
 * @property integer $id
 * @property string $amount
 * @property integer $package_id
 * @property integer $variation_id
 */
class Contractitem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contractitem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('amount, variation_id', 'required'),
			array('package_id, claimstage_id, variation_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'length', 'max'=>10),
                        array('note', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, amount, note, package_id, claimstage_id, variation_id', 'safe', 'on'=>'search'),
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
         'variation' => array(self::BELONGS_TO, 'Variation', 'variation_id'),
	
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'amount' => 'Amount',
                        'note'=>'Note',
			'package_id' => 'Package',
                    'claimstage_id'=>'Claim Stage',
			'variation_id' => 'Variation',
                 
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
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('package_id',$this->package_id);
                $criteria->compare('note',$this->package_id);
		$criteria->compare('variation_id',$this->variation_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

 
        
        
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contractitem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
              public function addfrompackages($vid,$pid)
	{
		//create contractitems from packages
        $sql="
        INSERT into `contractitem`
        (`amount`,`package_id`,`variation_id`,`note`)
        SELECT
        `i`.`budget`,
        `i`.`id`,
        ".$vid.",
        ''
        FROM `package` `i`
        WHERE
        `i`.`project_id`=".$pid;
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
	}
        
                     public function addfromstages($vid,$pid,$contract)
	{
		//create contractitems from packages
        $sql="
        INSERT into `contractitem`
        (`amount`,`note`,`claimstage_id`,`variation_id`)
        SELECT
        (`c`.`amount` * ".$contract."/100),
         `c`.`name`,
        `c`.`id`,
        ".$vid."
        
        FROM `claimstage` `c`
        JOIN `project` `p`
        ON `p`.`id`=`c`.`project_id`
        WHERE
        `c`.`project_id`=".$pid;
        
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
	}
        
               public function cleanupClaimStage($claimstage)
	{
		//create contractitems from packages
        $sql="
        DELETE
        FROM `contractitem`
        WHERE
        `claimstage_id`=".$claimstage;
        
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
	}
}
