<?php

/**
 * 
 * NAILD --
 * 
 * This is the model class for table "addresses".
 *
 * The followings are the available columns in table 'addresses':
 * @property integer $id
 * @property string $name
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $postcode
 * @property integer $state_id
 * @property integer $country_id
 * @property integer $foreign_key
 * @property integer $type
 *
 * The followings are the available model relations:
 * @property Wineries[] $wineries
 */
class Addresses extends CActiveRecord
{
    const TYPE_USER = 1;
    const TYPE_COMPANY = 2;
    const TYPE_ORG = 3;
    const TYPE_PROJ = 4;
    const TYPE_CONTACT = 5;
    public static $destination=array(1=>'user/view',2=>'company/view',3=>'company/view',4=>'project/details',5=>'contact/view');
			
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Addresses the static model class
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
		return 'addresses';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('foreign_key', 'required'),
            array('state_id, country_id, foreign_key, type', 'numerical', 'integerOnly'=>true),
            array('name, address1, address2, city, postcode', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, address1, address2, city, postcode, state_id, country_id, foreign_key, type', 'safe', 'on'=>'search'),
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
			'users' => array(self::HAS_MANY, 'User', 'address_id'),
			'country' =>array(self::BELONGS_TO, 'Countries','country_id'),
			'state' =>array(self::BELONGS_TO, 'States','state_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Address Type',
			'address1' => 'Address Line 1',
			'address2' => 'Address Line 2',
			'city' => 'City',
			'postcode' => 'Postcode',
			'state_id' => 'State',
			'country_id' => 'Country',
            'foreign_key' => 'Foreign Key',
            'type' => 'Type',
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
        $criteria->compare('address1',$this->address1,true);
        $criteria->compare('address2',$this->address2,true);
        $criteria->compare('city',$this->city,true);
        $criteria->compare('postcode',$this->postcode,true);
        $criteria->compare('state_id',$this->state_id);
        $criteria->compare('country_id',$this->country_id);
        $criteria->compare('foreign_key',$this->foreign_key);
        $criteria->compare('type',$this->type);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function getAddressForContact($id)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('foreign_key',$id);
        $criteria->compare('type', Addresses::TYPE_CONTACT);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    public function getAddressForUser($id)    
    {
        $criteria=new CDbCriteria;
        $criteria->compare('foreign_key',$id);
        $criteria->compare('type', Addresses::TYPE_USER);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
       public function getAddressForProject($id)    
    {
        $criteria=new CDbCriteria;
        $criteria->compare('foreign_key',$id);
        $criteria->compare('type', Addresses::TYPE_PROJ);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    function show(){
        $re = '';
        if ($this->address1) 
            $re .= $this->address1.'<br />';
        if ($this->address2) 
            $re .= $this->address2.'<br />';        
        if ($this->city) 
            $re .= $this->city.', ';
        if ($this->state_id) 
            $re .= $this->state->name.', ';   
        if ($this->country_id) 
            $re .= $this->country->country;
        return $re;
    }
}