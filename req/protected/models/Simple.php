<?php

/**
 * This is the model class for table "simple".
 *
 * The followings are the available columns in table 'simple':
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Object $object
 */
class Simple extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'simple';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('simple_id, category_id, number, name, description, project_id, release_id', 'required'),
			array('simple_id, category_id, project_id, release_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
                        array('number', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, simple_id, category_id, number, name, description, project_id, release_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		
		return array(
			     
                            'object'=>array(self::BELONGS_TO,
                                    'object','category_id',
                                    'joinType'=>'JOIN',
                                    'foreignKey'=>'category_id',
                                'on'=>'object.project_id=simple.project_id')
                    );
	}


        
	public function attributeLabels()
	{
		return array(
                    'id' => 'ID',
                    'simple_id' => 'Objectprop_id',
                    'project_id' => 'Project',
                    'release_id' => 'Release',
                    'category_id' => 'Object',
                    'name' => 'Name',
                    'number'=>'Number',
                    'description' => 'Description',
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
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        
          public function Renumber($id) // renumber all the packages in current release
	{
          
            $simples=$this->getCategorySimple($id);
            $counter=1;     
            foreach ($simples as $simple) {
            $model=  $this->findbyPK($simple['id']);
            $model->number = $counter;
            $model->save(false);
            $counter++;
          } 
        
        }
        
        
                     public function getNextNumber($id)
    {
                   
        $sql="SELECT max(`r`.`number`)as number
           From `simple` `r`
            WHERE `r`.`category_id`=".$id;
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
        
	
       public function getCategorySimple($id)
    {
          $project=Yii::App()->session['project'];
          $release=Yii::App()->session['release'];
        $sql="
            SELECT 
            `r`.`id`,
            `r`.`simple_id`,
            `r`.`number`,
            `r`.`description`,
            `r`.`name`,
            `v`.`active`
            FROM `simple` `r`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id`
            WHERE 
              `v`.`object`=18
            AND
            `v`.`active`=1
            AND
            `v`.`release`=".$release."
            AND 
            `v`.`project_id`=".$project."
            AND
            
            `r`.`category_id`=".$id." order by `r`.`number`";

     
        
        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
    
    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
