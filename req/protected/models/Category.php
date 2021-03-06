<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property string $name
 * @property integer $project_id
 *
 * The followings are the available model relations:
 * @property Project $project
 * @property Categoryproperty[] $categoryproperties
 */
class Category extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, name, number, description, order, project_id, release_id', 'required'),
			array('category_id, project_id, release_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
                        array('order', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, category_id, name, number, order, description, project_id, release_id', 'safe', 'on'=>'search'),
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
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'categoryproperties' => array(self::HAS_MANY, 'Categoryproperty', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
                        'category_id'=>'Category_id',
			'name' => 'Name',
                        'description'=>'Description',
                        'order'=>'Order',
			'project_id' => 'Project',
                        'release_id' => 'Release',
                        'number'=>'Number'
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('project_id',$this->project_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

            public function getNextNumber($id)
    {
               
        $sql="SELECT max(`r`.`number`)as number
           From `category` `r`
            WHERE `r`.`project_id`=".$id;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		   if (!isset($projects[0]['number'])) {
                    $projects[0]['number']='1';
                } ELSE {
                    $projects[0]['number']=$projects[0]['number']+1;
                }
		return $projects[0]['number'];
      
    
    }   
    
      public function getProjectCategory()
    {
       $release=Yii::App()->session['release'];
       $project=Yii::App()->session['project'];
        $sql="
            SELECT `r`.*,`v`.`active`
            FROM `category` `r`
            LEFT JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id`
            WHERE 
            `v`.`object`=17
            AND
            `v`.`active`=1
        and            
            `r`.`release_id`=".$release."         
        and            
            `r`.`project_id`=".$project;

     
        
        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
        
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Category the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
