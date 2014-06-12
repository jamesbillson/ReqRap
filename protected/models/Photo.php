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
            array('project_id, photo_id, release_id, user_id', 'numerical', 'integerOnly'=>true),
            array('file', 'length', 'max'=>255),
            array('description', 'safe'),
            array('file', 'file', 'types'=>'jpg,jpeg,gif,icon,png','maxSize'=>10*1024*1024,'allowEmpty'=>true),
            array('project_id, release_id, photo_id', 'numerical', 'integerOnly'=>true),
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
            'photo_id' => 'Photo',
            'project_id' => 'Project',
            'description' => 'Description',
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
    
         public function getProjectImages()
    {
       $release=Yii::App()->session['release'];
        $sql="
            SELECT `r`.*
            FROM `photo` `r`
            
            JOIN `version` `vr`
            ON `vr`.`foreign_key`=`r`.`id`
           
            WHERE 
            `vr`.`object`=11 AND `vr`.`active`=1 AND `vr`.`release`=".$release;

     
        
        $connection=Yii::app()->db;
	$command = $connection->createCommand($sql);
	$projects = $command->queryAll();
		
	return $projects;
    }  
        
    
      public function orphanPics()
    {
       $release=Yii::App()->session['release'];
              
        $sql="SELECT
            `p`.*
            FROM `photo` `p`
            JOIN `version` `vp`
            ON `vp`.`foreign_key`=`p`.`id`
            where `vp`.`active`=1 AND `vp`.`object`=11 AND `vp`.`release`=".$release."
                
            and `p`.`photo_id` 
            NOT IN (
            SELECT `i`.`photo_id`
            FROM `iface` `i`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`i`.`id`
            WHERE
            `v`.`active`=1 AND `v`.`object`=12 AND `v`.`release`=".$release." 
            )";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
          
          
    }
     
       public function checkIface($id)
    {
       $release=Yii::App()->session['release'];
              
        $sql="SELECT
              `i`.*
              FROM `iface` `i`
              JOIN `version` `v`
              ON `v`.`foreign_key`=`i`.`id`
              WHERE 
               `v`.`active`=1 AND `v`.`object`=12 AND `v`.`release`=".$release." 

              AND 
              `i`.`photo_id` =".$id;
            
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		if (empty($projects)) $flag=-1;
                if (!empty($projects)) $flag=$projects[0];
                return $flag;
          
          
    }
    
    public function thumbSearch($proj_id,$limit=6)
    {
        if(isset($proj_id)){
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
    
     public function makePhotoCopy($file, $id,$release)
    {
       
      //rename the file with the release appended.
       $path = Yii::getPathOfAlias("webroot").Yii::app()->params['photo_folder'];
                if(file_exists($path.$file)){
                $newfile=substr($file,8);
                $newfile=str_pad($release, 8, "0", STR_PAD_LEFT).$newfile;
                copy($path.$file, $path.$newfile);
                }
   $sql = "
        UPDATE `photo` `p`
        SET `p`.`file`='".$newfile."'
        WHERE `p`.`release_id`=".$release."
        AND `p`.`file`='".$file."'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
         
      //update the photo record with the new file name
         
         
         
    }
    
    protected function beforeValidate(){
        if($this->isNewRecord){
            $this->setAttributes(array('user_id'=>Yii::app()->user->id));
            $this->setAttributes(array('create_date'=>date("Y-m-d H:i:s")));
        }
        return parent::beforeValidate();        
    }
}