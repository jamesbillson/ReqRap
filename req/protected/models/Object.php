<?php


class Object extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'object';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('object_id, name, number, description, project_id, release_id', 'required'),
			array('object_id, project_id, release_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, object_id, name, number, project_id, release_id', 'safe', 'on'=>'search'),
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
			'objectproperties' => array(self::HAS_MANY, 'Objectproperty', 'object_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
                    'object_id'=>'Object_id',
			'name' => 'Name',
                    'description'=>'Description',
			 'project_id' => 'Project',
                    'release_id' => 'Release',
                    'number'=>'Number'
		);
	}

public function toDo()
	{
	$obstublist='<br />Stub objects: <br />';
$obstate=1;
$objectcount=0;
$obstub=0;

$data = Object::model()->getProjectObjects(Yii::app()->session['project']);
if (count($data)){
    $objectcount=count($data);
  // echo 'Stub forms: <br />';    
        foreach($data as $item):

        $fields=  Objectproperty::model()->getObjectProperty($item['object_id']);
        if(count($fields)==0) 
            {
            $obstub++;
            $obstublist.='<a href="/object/view/id/'.$item['object_id'].'"> OB-'.str_pad($item['number'], 3, "0", STR_PAD_LEFT).' '.$item['name'].'</a><br />';
            }

        endforeach;
        $obstubscore=100-(($obstub/$objectcount)*100);
        $obtotalscore=$obstubscore;
        if($obtotalscore==100 )$obstate=3;
        if($obtotalscore>79 && $obtotalscore<100 )$obstate=2;
        if($obtotalscore<=79 )$obstate=1;
        
//echo ' object score is '.$obtotalscore.'  state is '.$obstate;
        
        
                        $result=array(
                    'state'=>$obstate,
                    'count'=>$objectcount,
                    'stub'=>$obstub,
                    'stublist'=>$obstublist,
                   
                          );
                        return $result;

}
	}
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

            public function getNextNumber()
    {
       $id=Yii::App()->session['project'];        
        $sql="
            SELECT `r`.`number`
            From `object` `r`
            WHERE `r`.`project_id`=".$id."
            ORDER BY `number` DESC
            LIMIT 0,1";
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
           
      public function getProjectObjects()
    {
       $release=Yii::App()->session['release'];
        $sql="
            SELECT `o`.*
            FROM `object` `o`
            LEFT JOIN `version` `v`
            ON `v`.`foreign_key`=`o`.`id`
            WHERE 
            `v`.`object`=6
            AND
            `v`.`active`=1
            AND
            `v`.`release`=".$release."         
            ORDER BY `o`.`number`+1";         
     

     
        
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
