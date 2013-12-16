<?php

/**
 * This is the model class for table "document".
 *
 * The followings are the available columns in table 'document':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $type
 * @property integer $foreign_key
 * @property string $modified_date
 * @property integer $modified
 *
 * The followings are the available model relations:
 * @property User $modified0
 * @property Documentversion[] $documentversions
 */
class Document extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Document the static model class
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
        return 'document';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
/*            array('name, description, type, foreign_key, modified_date, modified', 'required'),
            array('type, foreign_key, modified, project_id, document_type', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            array('id, name, description, type, foreign_key, modified_date, modified', 'safe', 'on'=>'search'),*/

            //remove type and foreign_key
            array('name, description, document_type, modified_date, modified', 'required'),
            array('modified, document_type, document_type', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            array('id, name, description, modified_date, modified', 'safe', 'on'=>'search'),
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
            'modified0' => array(self::BELONGS_TO, 'User', 'modified'),
            'project' => array(self::BELONGS_TO, 'Project', 'foreign_key'),
            'documentType'=>array(self::HAS_ONE,'DocumentType','document_type')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
           /* 'type' => 'Type',
            'foreign_key' => 'Foreign Key',*/
            'modified_date' => 'Modified Date',
            'modified' => 'Modified',
        );
    }

	public function getDocs($object, $type)
    {
        $user= Yii::app()->user->id;   
              
        $sql="SELECT * FROM(
            
                SELECT `d`.`name`, `d`.`id` as docid, `d`.`description`, `v`.`version`,`v`.`id` AS `version_id`
                FROM `document` `d`
                Join `documentversion` `v` 
                on `v`.`document_id`=`d`.`id`
            
                WHERE 
                `d`.`foreign_key`=".$object." 
                AND 
                `d`.`document_type`=".$type." 
                ORDER BY `v`.`version` DESC
                
                ) AS temp
                GROUP BY `temp`.`docid`
                
                ";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
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
        $criteria->compare('description',$this->description,true);
/*        $criteria->compare('type',$this->type);
        $criteria->compare('foreign_key',$this->foreign_key);*/
        $criteria->compare('modified_date',$this->modified_date,true);
        $criteria->compare('modified',$this->modified);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    protected function beforeValidate(){
        $this->setAttributes(array('modified'=>Yii::app()->user->id,'modified_date' => date('Y-m-d')));
        return parent::beforeValidate();        
    }
}