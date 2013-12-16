<?php

/**
 * This is the model class for table "documentversion".
 *
 * The followings are the available columns in table 'documentversion':
 * @property integer $id
 * @property integer $document_id
 * @property string $version
 * @property string $file
 * @property integer $modified
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property User $modified0
 * @property Document $document
 */
class Documentversion extends CActiveRecord
{

    public $doc_parent;
    public $user;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Documentversion the static model class
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
        return 'documentversion';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('document_id, version, date, file, modified, modified_date', 'required'),
            array('document_id, modified', 'numerical', 'integerOnly'=>true),
            array('file', 'file', 'types'=>'doc, bdocx, pdf','maxSize'=>10*1024*1024),
            array('version', 'length', 'max'=>30),
     array('version', 'ext.UniqueAttributesValidator', 'with'=>'document_id'),
    
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, document_id, version, file, modified, modified_date, doc_parent,user', 'safe', 'on'=>'search'),
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
            'document' => array(self::BELONGS_TO, 'Document', 'document_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'document_id' => 'Document',
            'version' => 'Version',
            'file' => 'File',
            'date'=> 'Date',
            'modified' => 'Modified',
            'modified_date' => 'Modified Date',
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
        $criteria->compare('document_id',$this->document_id);
        $criteria->compare('version',$this->version,true);
        $criteria->compare('file',$this->file,true);
        $criteria->compare('date',$this->file,true);
        $criteria->compare('modified',$this->modified);
        $criteria->compare('modified_date',$this->modified_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    public function searchDocument($id)
    {
        $criteria=new CDbCriteria;
        $criteria->addCondition('document_id = '.$id,'AND');
        
        $criteria->with = array('modified0','document');
        $criteria->together = true;
   
        $criteria->compare('modified0.username',$this->user,true);
        $criteria->compare('document.name',$this->doc_parent,true);
        $criteria->compare('t.version',$this->version,true);
        $criteria->compare('t.file',$this->file,true);
        $criteria->compare('t.modified_date',$this->modified_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array(
                'attributes'=>array(
                    'doc_parent'=>array(
                      'asc'=>'document.name',
                      'desc'=>'document.name DESC',
                    ),
                    'user'=>array(
                      'asc'=>'modified0.username',
                      'desc'=>'modified0.username DESC',
                    ),                   
                    '*',
                ),
                'defaultOrder'=>'t.version DESC',
            ),
            'pagination'=>array(
                'pageSize'=>15,
            )
        ));
    }

    protected function beforeValidate(){
        $this->setAttributes(array('modified'=>Yii::app()->user->id,'modified_date' => date('Y-m-d')));
        return parent::beforeValidate();        
    }   
    
    
    
    
    
    
}