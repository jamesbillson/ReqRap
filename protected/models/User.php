<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $password
 * @property integer $address_id
 * @property string $salt
 * @property string $username
 *
 * The followings are the available model relations:
 * @property Lifespan[] $lifespans
 * @property Notes[] $notes
 * @property Points[] $points
 * @property Addresses $address
 */
class User extends CActiveRecord
{
  
  public $cpassword;
  /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('password','safe', 'on'=>'update'),
                        array('email','email'),
                        array('username', 'unique','message'=>'User ID/email must be unique.'),
                    
                        array('email', 'required', 'on' => 'resendConfirmation'),
                        array('password, cpassword', 'required', 'on' => 'newPassword'),
                        array('password', 'compare', 'skipOnError'=>false, 'compareAttribute'=>'cpassword', 'on' => 'newPassword'),
                        array('password', 'length', 'min' => 4),                    
			array('firstname, lastname, email, username', 'required', 'on'=>'update'),
			array('firstname, lastname, email, password, salt, username', 'required','except' => 'register, resendConfirmation, newPassword'),
			array('address_id', 'numerical', 'integerOnly'=>true),
			array('firstname, lastname, email, password', 'length', 'max'=>255),
			array('salt, username', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, firstname, lastname, email, password, address_id, salt, username', 'safe', 'on'=>'search'),
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
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
			/*'contact' => array(self::HAS_MANY,'Contact','user_id'),*/
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'firstname' => 'First Name',
			'lastname' => 'Last Name',
			'email' => 'Email',
			'password' => 'Password',
			'address_id' => 'Address',
			'salt' => 'Salt',
			'username' => 'Username',
                        'cpassword'=>'Confirm Password'
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('address_id',$this->address_id);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('username',$this->username,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        // hash password
    public function hashPassword($password, $salt)
    {
        //return md5($salt.$password);
        return md5($password);
    }
            
    // password validation
    public function validatePassword($password)
    {
        return $this->password == md5($password);
    }
            
    //generate salt
    public function generateSalt()
    {
        return uniqid('',true); 
    }
            
    public function beforeValidate()
    {
        $this->salt = $this->generateSalt();
        return parent::beforeValidate();
    }
            
    public function beforeSave()
    {
     
        $this->password = md5($this->password); 
        
     
        return parent::beforeSave();
    }
       public function myCompany()
    {
            $user= Yii::app()->user->id;   
              
        $sql="SELECT `c`.`id` FROM `company` `c` 
            join `user` `u` 
            on `u`.`company_id`=`c`.`id`
            WHERE `u`.`id`=".$user;
      $connection=Yii::app()->db;
      $command = $connection->createCommand($sql);
      $company = $command->queryAll();
      if (!empty($company)) {
          return $company[0]['id'];
      } Else {
         
      return -1;
      }
    }
    
        public function myCompanyType()
    {
            $user= Yii::app()->user->id;   
              
        $sql="SELECT `c`.`id`, `c`.`type` FROM `company` `c` 
            join `user` `u` 
            on `u`.`company_id`=`c`.`id`
            WHERE `u`.`id`=".$user;
      $connection=Yii::app()->db;
      $command = $connection->createCommand($sql);
      $company = $command->queryAll();
      if (!empty($company)) {
          return $company[0]['type'];
      } Else {
         
      return -1;
      }
    }
        public function companyUsers()
    {
            $company= User::model()->myCompany();   
              
        $sql="SELECT `u`.*
            FROM `user` `u`
            Join `company` `c` 
            on `u`.`company_id`=`c`.`id`
            WHERE `c`.`id`=".$company;
      $connection=Yii::app()->db;
      $command = $connection->createCommand($sql);
      $users = $command->queryAll();
      return $users;
    }
    
    
     public function sendInvite($id)
    {

       $user = $this->findByPk($id);   
       $creator = User::model()->findbyPk(Yii::app()->user->id);
       $mail = new YiiMailer();
       $mail->setFrom($creator->username,$creator->firstname.' '.$creator->lastname);
       $mail->setTo($user->email);
               
        
            //if the user has an account send an email saying they've been invite to follow

            $mail->setSubject('You have been invited to join '.$creator->company->name);
            $mail->setBody($user->firstname.',
            <br /><br />
            You\'ve been invited to create on ReqRap, the rapid web requirements tool.
            The account invitation is to join '.$creator->company->name.' as an employee. 
            <br />
            Click here to accept <a href="http://'.Yii::app()->params['server'].'/user/accept/id/'.$user->salt.'">'.Yii::app()->params['server'].'/user/accept/id/'.$user->salt.'</a>                   
            <br />
            If you were not expecting this message, simply ignore it and it will expire.<br />
            If you have any questions, please do not hesitate to contact
            .'.$creator->firstname.' '.$creator->lastname.' or support@reqrap.com.
          
            
            ');

       
        $mail->Send();          
    }
    
            public function activate($id)
    {
               
              
        $sql="UPDATE user
            SET type=1, active=1
            WHERE
            `id`=".$id;
     $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
    }
         public function setcompany($id)
    {
               
              
        $sql="UPDATE user
            SET company_id=".$id."
            WHERE
            `id`=".Yii::app()->user->id;
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
    } 
         public function setcompanyowner($id)
    {
               
              
        $sql="UPDATE user
            SET company_id=".$id.",
                admin=1
            WHERE
            `id`=".Yii::app()->user->id;
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
    } 

    public function behaviors() {
        return array(
            'user_meta' => array(
                'class' => 'ext.yiiext.behaviors.model.eav.EEavBehavior',
                'tableName' => 'user_meta',
                'entityField' => 'user_id',
                'attributeField' => 'meta_name',
                'valueField' => 'meta_value',
                'modelTableFk' => 'user_id',
                'safeAttributes' => array(),
            )
        );
    }
}