<?php


class Iface extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'iface';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, iface_id, name, interfacetype_id, project_id, release_id', 'required'),
			array('iface_id, number, interfacetype_id, photo_id, project_id, release_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
                        array('text', 'safe'),
		
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, iface_id, photo_id,number, name, interfacetype_id, project_id, release_id', 'safe', 'on'=>'search'),
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
			'type' => array(self::BELONGS_TO, 'Interfacetype', 'interfacetype_id'),
                        'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
                        'photo' => array(self::BELONGS_TO, 'Photo', 'project_id'),	
                    );
	}
	public function toDo()
	{
		$ifstublist='<br />Stub interfaces: <br />';
                $iforphanlist='<br />Orphan interfaces: <br />';
                $ifstub=0;
                $ifstate=1;
                $ifcount=0;
                $iforphan=0;
                $ifcount=0;
                //$ifstate=1;
                $types = Interfacetype::model()->getInterfacetypes();
                foreach($types as $type){
                $data = Iface::model()->getCategoryIfaces($type['interfacetype_id']);
                if (count($data)):
                $ifcount=$ifcount+count($data);
                    foreach($data as $item){
                    if(!count(Iface::model()->getCurrentImage($item['iface_id'],Yii::App()->session['release'])) && $item['text']=='') 
                        {
                        $ifstub++;
                        $ifstublist.='<a href="/iface/view/id/'.$item['iface_id'].'"> UI-'.str_pad($type['number'], 2, "0", STR_PAD_LEFT).str_pad($item['number'], 3, "0", STR_PAD_LEFT).' '.$item['name'].'</a><br />';

                        } 
                $uses=Usecase::model()->getLinkUsecase($item['iface_id'],12,15);
                    if(count($uses)==0)
                           { 
                           $iforphan++;
                        $iforphanlist.='<a href="/iface/view/id/'.$item['iface_id'].'"> UI-'.str_pad($type['number'], 2, "0", STR_PAD_LEFT).str_pad($item['number'], 3, "0", STR_PAD_LEFT).' '.$item['name'].'</a><br />';

                           }
                }
  

                endif;
                if($ifcount>0){
                      $ifstubscore=100-(($ifstub/$ifcount)*100);
                        $iforphanscore=100-(($iforphan/$ifcount)*100);
                        $iftotalscore=($ifstubscore+$iforphanscore)/2;
                        if($iftotalscore==100 )$ifstate=3;
                        if($iftotalscore>79 && $iftotalscore<100 )$ifstate=2;
                        if($iftotalscore<=79 )$ifstate=1;
                }
                }

                $result=array(
                    'state'=>$ifstate,
                    'count'=>$ifcount,
                    'stub'=>$ifstub,
                    'stublist'=>$ifstublist,
                    'orphan'=>$iforphan,
                    'orphanlist'=>$iforphanlist
                          );
                        return $result;

	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'iface_id' => 'ifaceID',
                        'number' => 'Number',
			'name' => 'Name',
                    'text' => 'Text',
			'interfacetype_id' => 'Type',
                     'project_id' => 'Project',
                    'release_id' => 'Release',
                    'photo_id'=>'Image'
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
		$criteria->compare('number',$this->number);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('interfacetype_id',$this->interfacetype_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

         public function getIfaces($id)
    {
   // GET All interfaces belonging to steps that belong to this UC.
             $project=Yii::App()->session['project']; 
             $release=Yii::App()->session['release'];
        $sql="SELECT 
            `i`.`number`,
            `i`.`iface_id`,
            `i`.`name`, 
            `i`.`interfacetype_id`,
            `i`.`id`,
            `t`.`name` as type, 
            `t`.`interfacetype_id` as typenum,
            `x`.`id` as xid
            FROM `iface` `i`
            JOIN `interfacetype` `t` 
            on `i`.`interfacetype_id`=`t`.`interfacetype_id`
            JOIN `stepiface` `x`
            ON `x`.`iface_id`=`i`.`iface_id`            
            JOIN `step` `s`
            ON `s`.`step_id`=`x`.`step_id`
            JOIN `flow` `f`
            ON `f`.`flow_id`=`s`.`flow_id`

            JOIN `version` `vr`
            ON `vr`.`foreign_key`=`i`.`id`
            JOIN `version` `vx`
            ON `vx`.`foreign_key`=`x`.`id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id` 

WHERE
            `f`.`usecase_id`=".$id."
            AND `f`.`project_id`=".$project."    
            AND `i`.`project_id`=".$project."
            AND `s`.`project_id`=".$project."
            AND `x`.`project_id`=".$project."
            AND `t`.`project_id`=".$project."
                            AND
            `f`.`release_id`=".$release."    
            AND `i`.`release_id`=".$release."
            AND `s`.`release_id`=".$release."
            AND `x`.`release_id`=".$release."
            AND `t`.`release_id`=".$release."
            AND
            `vr`.`object` =12 AND `vr`.`active`=1  
                 AND `vr`.`release`=".$release."
            AND
            `vx`.`object` =15 AND `vx`.`active`=1     
                 AND `vx`.`release`=".$release."
            AND
            `vs`.`object` =9 AND `vs`.`active`=1 
                 AND `vs`.`release`=".$release."
            AND
            `vf`.`object` =8 AND `vf`.`active`=1  
                 AND `vf`.`release`=".$release."
 



             GROUP BY `i`.`id`
             ORDER BY typenum ASC, `i`.`number` ASC";
        
      
        
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
        
   
      
     public function getProjectIfaces()
    {
         $project=Yii::App()->session['project'];
          $release=Yii::App()->session['release'];
        $sql="
            SELECT 
            `r`.`id` itemid,
            `r`.*,
            `p`.*,
            `t`.`name` as type,
            `t`.`interfacetype_id` as typenumber
            FROM
            `iface` `r`
            JOIN `interfacetype` `t`
            ON `t`.`interfacetype_id`=`r`.`interfacetype_id`            
            LEFT JOIN `photo` `p`
            ON `r`.`photo_id`=`p`.`id`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id`
            JOIN `version` `vt`
            ON `vt`.`foreign_key`=`t`.`id`
            WHERE 
            `v`.`object`=12 
            AND 
            `v`.`active`=1 
            AND 
            `v`.`release`=".$release."
            AND 
            `vt`.`object`=13 
            AND 
            `vt`.`active`=1 
            AND 
            `vt`.`release`=".$release." 
            AND           
            `r`.`release_id`=".$release."
                GROUP BY `r`.`iface_id`";

     
        
        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
    
    
         public function getStepIfaces($id)  //this is iface_id
    {
        $release=Yii::App()->session['release'];
          
             $sql="SELECT
                 `r`.*,
                 `x`.`id` as xid
            From `iface` `r`
            JOIN `stepiface` `x`
            ON `x`.`iface_id`=`r`.`iface_id`
            JOIN `step` `s`
            ON `s`.`step_id`=`x`.`step_id`

            JOIN `version` `vr`
            ON `vr`.`foreign_key`=`r`.`id`
            JOIN `version` `vx`
            ON `vx`.`foreign_key`=`x`.`id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
          
        WHERE
            `s`.`step_id`=".$id."
            AND
            `vr`.`object` =12 AND `vr`.`active`=1 AND `vr`.`release`=".$release."
            AND
            `vx`.`object` =15 AND `vx`.`active`=1  AND `vx`.`release`=".$release."           
            AND
            `vs`.`object` =9 AND `vs`.`active`=1  AND `vs`.`release`=".$release."


             GROUP BY `r`.`id`
             ORDER BY `r`.`number` ASC";
         
          
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }  
    
    
       public function getCategoryIfaces($interfacetype_id)
    {
         
           
          $release=Yii::App()->session['release'];
     
         $sql="
            SELECT 
            `r`.`id` itemid,
            `r`.*,
          
            `t`.`name` as type,
            `t`.`interfacetype_id` as typenumber
            FROM
            `iface` `r`
            JOIN `interfacetype` `t`
            ON `t`.`interfacetype_id`=`r`.`interfacetype_id`            
        
            JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id`
           
            JOIN `version` `vt`
            ON `vt`.`foreign_key`=`t`.`id`
            WHERE 
            `v`.`object`=12 AND `v`.`active`=1 AND `v`.`release`=".$release."
            AND 
            `vt`.`object`=13 AND `vt`.`active`=1 AND `vt`.`release`=".$release." 
            AND  
                 
           
            `r`.`release_id`=".$release."
            AND
            `t`.`interfacetype_id`=".$interfacetype_id."
                GROUP BY `r`.`iface_id`";

        
        
        
        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
    
    
        public function getIfaceType($iface)
    {
         
           
          $release=Yii::App()->session['release'];
     
         $sql="
            SELECT 
            `r`.*,
            `t`.`name` as type,
            `t`.`interfacetype_id` as typenumber
            FROM
            `iface` `r`
            JOIN `interfacetype` `t`
            ON `t`.`interfacetype_id`=`r`.`interfacetype_id`            
        
            JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id`
           
            JOIN `version` `vt`
            ON `vt`.`foreign_key`=`t`.`id`
            WHERE 
            `v`.`object`=12 AND `v`.`active`=1 AND `v`.`release`=".$release."
            AND 
            `vt`.`object`=13 AND `vt`.`active`=1 AND `vt`.`release`=".$release." 
            AND  
            `r`.`iface_id`=".$iface;
            

        
        
        
        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects[0];
    }  
    
    
         public function getCurrentImage($iface_id,$release)
    {
        //$release=Yii::App()->session['release'];
          
        $sql="
            SELECT 
            `p`.*
            FROM
            `photo` `p`
            JOIN `iface` `r`
            ON `r`.`photo_id`=`p`.`photo_id`
            LEFT OUTER JOIN `version` `vp`
            ON `vp`.`foreign_key`=`p`.`id`
            JOIN `version` `vi`
            ON `vi`.`foreign_key`=`r`.`id`
            WHERE 
            `r`.`iface_id`=".$iface_id." AND
            `vp`.`object`=11 AND `vp`.`active`=1 AND `vp`.`release`=".$release."
             AND 
             `vi`.`object`=12 AND `vi`.`active`=1 AND `vi`.`release`=".$release."
             ORDER BY `vp`.`create_date` DESC
             LIMIT 0,1";

            $connection=Yii::app()->db;
            $command = $connection->createCommand($sql);
            $projects = $command->queryAll();
            if (!empty($projects)) $projects=$projects[0];
            return $projects;
    }  
    
    
    
      public function getNextIfaceNumber()
    {
          $project=Yii::App()->session['project'];         
        $sql="SELECT max(`r`.`number`)as number
                From `iface` `r`
                WHERE `r`.`project_id`=".$project;
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
    
          public function createTypes($id)
    {
      $initial=array(0=>'Not Classified',1=>'Web interface',2=>'Email');
         for ($case = 0; $case <= 2; $case++) 
         {       
      
       $interfacetype_id=Version::model()->getNextID(13);
       $sql="INSERT INTO `interfacetype`(
           `number`, 
           `interfacetype_id`,
           `release_id`,
           `name`,
           `project_id`) 
           VALUES 
           (0,
           ".$interfacetype_id.",
           ".Release::model()->currentRelease(Yii::app()->session['project']).",
           '".$initial[$case]."',
           ".$id.")";
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
        
        $sql="select `a`.`id` 
            from `interfacetype` `a` 
            where
            `a`.`interfacetype_id` = ".$interfacetype_id."
            AND                
            `a`.`project_id`=".$id;
      
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        Version::model()->getNextNumber($id,13,1,$result[0]['id'],$interfacetype_id); 
           }
    
        
    }            
    public function addImage($iface,$id){
            $release=Yii::App()->session['release'];
            $project=Yii::App()->session['project'];
            $model=Iface::model()->findByPk(Version::model()->getVersion($iface,12));
            
            $this->name=$model->name;
            $this->interfacetype_id=$model->interfacetype_id;
            $this->number=$model->number;
            $this->photo_id=$id;
            $this->number=$model->number;
            $this->project_id=$project;
            $this->iface_id=$model->iface_id;
            $this->release_id=$release;	
            if($this->save()){
            $version=Version::model()->getNextNumber($this->project_id,12,2,$this->primaryKey,$this->iface_id); 
              return true;
            }
            else{
              return false;
            }
    }     
                    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
