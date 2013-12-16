<?php

/**
 * This is the model class for table "contact".
 *
 * The followings are the available columns in table 'contact':
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property integer $user_id
 * @property integer $owner_id
 * @property integer $companyowner_id
 */
class Contact extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Contact the static model class
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
        return 'contact';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('firstname, owner_id, companyowner_id', 'required'),
            array('user_id, owner_id, companyowner_id ,company_id', 'numerical', 'integerOnly'=>true),
            array('firstname, lastname, email', 'length', 'max'=>255),
            array('phone, mobile', 'length', 'max'=>50),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, firstname, lastname, phone, mobile, email, user_id, owner_id, company_id', 'safe', 'on'=>'search'),
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
                'worksfor' => array(self::BELONGS_TO, 'Company', 'company_id'),
        
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'phone' => 'Phone',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'user_id' => 'User',
            'owner_id' => 'Owner',
            'companyowner_id' => 'Companyowner',
            'company_id' => 'Company',
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
        $criteria->compare('firstname',$this->firstname,true);
        $criteria->compare('lastname',$this->lastname,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('mobile',$this->mobile,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('owner_id',$this->owner_id);
        $criteria->compare('companyowner_id',$this->companyowner_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
        
    public function myContacts()
    {
        $company=User::model()->myCompany();
        $criteria=new CDbCriteria;
        $criteria->addCondition('companyowner_id='.$company);
        return new CActiveDataProvider($this, array(
        'criteria'=>$criteria,
             ));
    }
    public function getNonFollowers($fk,$type)
    {
        $mycompanyid= User::model()->myCompany();   
              
        $sql="select `c`.`id`,`c`.`firstname`,`c`.`lastname` from contact `c`
            where `c`.`companyowner_id` =$mycompanyid 
            and
            `c`.`id` not in 
            (select `f`.`contact_id` from `follower` `f` where `f`.`type`=".$type." and `f`.`foreign_key`=".$fk.")";
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $contacts = $command->queryAll();
        return $contacts;
    }
    
    public function connectUser($id)
    {
     
        $sql="UPDATE
                `contact`,
                `follower`,
                `user`
              SET
                `contact`.`user_id` = `user`.`id`
              WHERE
                `contact`.`id` = `follower`.`contact_id`
              AND
                `contact`.`email`=`user`.`email`
              AND
                `follower`.`id` >0
              AND
                `user`.`id`=".$id;

        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
        //redirect('connectUser');
    }
        
    public function getContactName()
    {
       return $this->firstname.' '.$this->lastname;
    }

    protected function beforeValidate(){
        if(empty($this->owner_id))
            $this->setAttributes(array('owner_id'=>Yii::app()->user->id));

        if(empty($this->companyowner_id))
            $this->setAttributes(array('companyowner_id' => User::model()->myCompany()));
        
        return parent::beforeValidate();        
    }
}