<?php

class Photo extends CActiveRecord
{
    

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'photo';
    }


    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('photo_id, project_id, release_id, user_id', 'numerical', 'integerOnly'=>true),
            array('file', 'length', 'max'=>255),
            array('file', 'file', 'types'=>'jpg,jpeg,gif,icon,png','maxSize'=>10*1024*1024,'allowEmpty'=>true),
            array('photo_id, project_id, release_id', 'numerical', 'integerOnly'=>true),
// The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, photo_id, project_id, release_id, file, user_id, create_date', 'safe', 'on'=>'search'),
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
            'project'=>array(self::BELONGS_TO,'Project','project_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'photo_id'=>'Photo ID',
             'project_id' => 'Project',
                    'release_id' => 'Release',
            'file' => 'File',
            'user_id' => 'User',
            'create_date' => 'Create Date',
           
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

        $criteria->compare('t.project_id',$this->project_id);
        $criteria->compare('t.file',$this->file,true);


        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    public function thumbSearch($proj_id,$limit=6)
    {
        if(isset($proj_id) && Diary::model()->findByPk($proj_id)){
            $criteria=new CDbCriteria;
            
            if($limit !== -1){
                $criteria->limit=6;
            }
            $criteria->addCondition('t.project_id='.$proj_id,'AND');

            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'pagination'=>false,
            ));
        }
        
    }
    protected function beforeValidate(){
        if($this->isNewRecord){
            $this->setAttributes(array('user_id'=>Yii::app()->user->id));
            $this->setAttributes(array('create_date'=>date("Y-m-d H:i:s")));
        }
        return parent::beforeValidate();        
    }
}