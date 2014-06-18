<?php

class Note extends CActiveRecord
{
    

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'note';
    }


    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('object, instance, release_id, owner_id', 'numerical', 'integerOnly'=>true),
            array('text, meta_type, subject', 'safe'),
    // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id,meta_type, subject, text, object, instance, release_id, owner_id', 'safe', 'on'=>'search'),
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
            'release'=>array(self::BELONGS_TO,'Release','release_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'meta_type' => 'Meta',
            'subject' => 'Subject',
            'text' => 'Description',
            'release_id' => 'Release',
            'instance' => 'Instance',
            'object'=>'Object',
            'owner_id' => 'User',
            'create_date' => 'Create Date',
           
        );
    }

   
     public function getNotes($id)
    {
         
       $link=explode('_',$id);
       $sql="
            SELECT `n`.* 
            FROM 
            `note` `n`
            WHERE    
            `n`.`release_id`=".$link[0]."         
            AND            
            `n`.`object`=".$link[1]."
            AND 
            `n`.`instance`=".$link[2];

     
        
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

        $criteria->compare('t.project_id',$this->project_id);
        $criteria->compare('t.file',$this->file,true);


        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    
    
    protected function beforeValidate(){
        if($this->isNewRecord){
            $this->setAttributes(array('owner_id'=>Yii::app()->user->id));
            $this->setAttributes(array('create_date'=>date("Y-m-d H:i:s")));
        }
        return parent::beforeValidate();        
    }
}