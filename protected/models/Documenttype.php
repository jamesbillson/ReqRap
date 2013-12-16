<?php

/**
 * This is the model class for table "documenttype".
 *
 * The followings are the available columns in table 'documenttype':
 * @property string $id
 * @property string $company_id
 * @property string $name
 * @property string $description
 *
 * The followings are the available model relations:
 */
class Documenttype extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Documenttype the static model class
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
        return 'documenttype';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('company_id, name', 'required'),
            array('company_id', 'length', 'max'=>11),
            array('name', 'length', 'max'=>255),
            array('description', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, company_id, name, description', 'safe', 'on'=>'search'),
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
            'Documents' => array(self::HAS_MANY, 'Document', 'document_type'),
            'Company' => array(self::BELONGS_TO, 'Company', 'company_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'company_id' => 'Company',
            'name' => 'Name',
            'description' => 'Description',
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

        $criteria->compare('id',$this->id,true);
        $criteria->compare('company_id',$this->company_id,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('description',$this->description,true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }
    
        public function preload()
	{
		$cid=  User::model()->myCompany();
          $sql="INSERT INTO `documenttype` (`name`, `description`, `company_id`) VALUES
            ('Architectural', 'Architectural', ".$cid."),
            ('Engineering', 'Engineering', ".$cid."),
            ('Services', 'Services', ".$cid."),
            ('Planning', 'Planning', ".$cid."),
            ('General', 'General', ".$cid.")";
	$connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
        }
}