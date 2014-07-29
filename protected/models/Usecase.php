<?php

/**
 * This is the model class for table "usecase".
 *
 * The followings are the available columns in table 'usecase':
 * @property integer $id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Actorusecase[] $actorusecases
 * @property Interfaceusecase[] $interfaceusecases
 * @property Ruleusecase[] $ruleusecases
 * @property Step[] $steps
 * @property Uses[] $uses
 * @property Uses $uses1
 */
class Usecase extends CActiveRecord
{

 public static $default_description = 'This usecase describes the process of ...';

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usecase';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, usecase_id, package_id, actor_id, number,description,preconditions, project_id, release_id', 'required'),
			array('name', 'length', 'max'=>255),
                    array('usecase_id, project_id, release_id', 'numerical', 'integerOnly'=>true),
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, usecase_id,  name, project_id, release_id', 'safe', 'on'=>'search'),
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
			'actorusecases' => array(self::HAS_MANY, 'Actorusecase', 'usecase_id'),
			'interfaceusecases' => array(self::HAS_MANY, 'Interfaceusecase', 'usecase_id'),
			'ruleusecases' => array(self::HAS_MANY, 'Ruleusecase', 'usecase_id'),
			'steps' => array(self::HAS_MANY, 'Step', 'usecase_id'),
			'usedby' => array(self::HAS_MANY, 'Uses', 'usedby'),
			'uses' => array(self::HAS_ONE, 'Uses', 'uses'),
                        'package' => array(self::BELONGS_TO, 'Package', 
                        array('package_id' => 'package_id'),
                        'on' => 't.project_id = package.project_id',
                ),
   

                        
                    
                    
                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                    'id' => 'ID',
                    'usecase_id' => 'usecase id',
                     'project_id' => 'Project',
                    'release_id' => 'Release',
                    'name' => 'Name',
                    'number' => 'Number',
                    'actor_id'=>'Default Actor',
                    'package_id' => 'Package',
                    'description' => 'Description',
                    'preconditions' => 'Pre Conditions'
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        public function Renumber() // renumber all the packages in current release
	{
          
            $packages=Package::model()->getPackages();
            
            foreach ($packages as $package) 
            {
            $ucs=$this->getPackageUsecases($package['package_id']);
            $counter=1;
                foreach ($ucs as $uc) 
                {
                $model=Usecase::model()->findbyPK($uc['id']);
                $model->number = $counter;
                $model->save(false);
                $counter++;
                }
            }
        
        }    
        
        
   
        
        
        public function toDo()
        {
            
            $ucstublist='<br />Stub usecases: <br />';

        $ucstub=0;

        $uccount=0;

        $data = Usecase::model()->getProjectUCs();

        if (count($data)){
          $uccount=count($data);       
                foreach($data as $item):
                $ucscore=0;
                $steps= Usecase::model()->getAllSteps($item['usecase_id']);
                        foreach ($steps as $step){
                            // go through steps and find if there are any rules, forms or interfaces.
                                     $ifaces = Step::model()->getStepLinks($step['id'], 12, 15);
                                     $rules = Step::model()->getStepLinks($step['id'], 1, 16);
                                     $forms = Step::model()->getStepLinks($step['id'], 2, 14);
                                    $ucscore=$ucscore+count($ifaces)+count($rules)+count($forms);
                        }


                if((count($steps)+$ucscore)<=1) {
                    $ucstub++;
                $ucstublist.= '<a href="/usecase/view/id/'.$item['usecase_id'].'">'.$item['name'].'<br /></a>';
                }
                endforeach;
        }
        if ($uccount>0){
          $ucstubscore=100-(($ucstub/$uccount)*100);
  
        $uctotalscore=($ucstubscore);
        if($uctotalscore==100 )$ucstate=3;
        if($uctotalscore>79 && $uctotalscore<100 )$ucstate=2;
        if($uctotalscore<=79 )$ucstate=1;
        
        
        $result=array('state'=>$ucstate,
            'count'=>$uccount,
            'stub'=>$ucstub,
            'stublist'=>$ucstublist);
                return $result;
  
            }
        }
        
        
    public function weight()
        {
        $UC_rate=2;
        $UC_UI_rate=4;        
        $UC_step_rate=1;
        $UC_rule_rate=3;
        $UC_form_rate=4;
     $score=array();
        $data = Usecase::model()->getProjectUCs();
        if (count($data)){
               
                foreach($data as $item):
                $steps= Usecase::model()->getAllSteps($item['usecase_id']);
                        foreach ($steps as $step){
                        $ifaces = Step::model()->getStepLinks($step['id'], 12, 15);
                        $rules = Step::model()->getStepLinks($step['id'], 1, 16);
                        $forms = Step::model()->getStepLinks($step['id'], 2, 14);
                        
                       
                        $score[$item['usecase_id']]=($UC_UI_rate*count($ifaces))+
                                $UC_step_rate+
                                ($UC_rule_rate*count($rules))+
                                ($UC_form_rate*count($forms));
                                
                        }
                         $score[$item['usecase_id']]= $score[$item['usecase_id']]+$UC_rate;
                endforeach;
                
                
        }
       
           if(count($score)) return $score;
  
            
        }
           
        

                public function getUsecaseActors($id)
    {
            $project=Yii::app()->session['project'];
            $release=Yii::App()->session['release'];
          $sql="

            SELECT `a`.*
            FROM `actor` `a`
            JOIN `step` `s`
            ON `s`.`actor_id`=`a`.`actor_id`
            JOIN `flow` `f`
            ON `f`.`flow_id`=`s`.`flow_id`
            JOIN `usecase` `u`
            ON `u`.`usecase_id`=`f`.`usecase_id`
            
            JOIN `version` `va`
            ON `va`.`foreign_key`=`a`.`id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id`
            JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`            
            

            WHERE 
            `va`.`object`=4 AND `va`.`active`=1 AND `va`.`release`=".$release."  AND  
            `vs`.`object`=9 AND `vs`.`active`=1 AND `vs`.`release`=".$release."  AND                  
            `vf`.`object`=8 AND `vf`.`active`=1 AND `vf`.`release`=".$release."  AND  
            `vu`.`object`=10 AND `vu`.`active`=1 AND `vu`.`release`=".$release."  AND  
           
                      
            `u`.`id`=".$id."
                GROUP BY `a`.`actor_id`

                ";
        
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
    
               public function getAllSteps($id)
    {
            $project=Yii::app()->session['project'];
            $release=Yii::App()->session['release'];
          $sql="
            SELECT `s`.*,
            `f`.`name` as flow
            FROM  `step` `s`
            JOIN `flow` `f`
            ON `f`.`flow_id`=`s`.`flow_id`
            JOIN `usecase` `u`
            ON `u`.`usecase_id`=`f`.`usecase_id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id`
            JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`            
            WHERE 
            `vs`.`object`=9 AND `vs`.`active`=1 AND `vs`.`release`=".$release."  AND                  
            `vf`.`object`=8 AND `vf`.`active`=1 AND `vf`.`release`=".$release."  AND  
            `vu`.`object`=10 AND `vu`.`active`=1 AND `vu`.`release`=".$release."  AND  
            `u`.`usecase_id`=".$id."
            GROUP BY `s`.`step_id`

                ";
        
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
        
     public function getAllReleaseSteps($id,$release)
    {
      
          $sql="
            SELECT `s`.*,
            `f`.`name` as flow
            FROM  `step` `s`
            JOIN `flow` `f`
            ON `f`.`flow_id`=`s`.`flow_id`
            JOIN `usecase` `u`
            ON `u`.`usecase_id`=`f`.`usecase_id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id`
            JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`            
            WHERE 
            `vs`.`object`=9 AND `vs`.`active`=1 AND `vs`.`release`=".$release."  AND                  
            `vf`.`object`=8 AND `vf`.`active`=1 AND `vf`.`release`=".$release."  AND  
            `vu`.`object`=10 AND `vu`.`active`=1 AND `vu`.`release`=".$release."  AND  
            `f`.`id`=".$id."
            GROUP BY `s`.`step_id`

                ";
        
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
    
    
            public function getHistory($id)
    {
         
$history=array();
$data=Usecase::model()->getUsecaseVersions($id);
foreach($data as $uc){


$history[$uc['versionid']]=array(
    'usecase_id'=>$uc['usecase_id'],
    'object_id'=>$uc['usecase_id'],
     'name'=>$uc['name'],
    'detail'=>'',
    'object'=>10,
    'number'=>$uc['number'],
     'action'=>$uc['action'],
     'date'=>$uc['create_date'],
        'firstname'=>$uc['firstname'],
    'lastname'=>$uc['lastname'],
    'active'=>$uc['active'],
     );

    $flows=Usecase::model()->getFlowVersions($uc['usecase_id']);
    foreach($flows as $flow){


$history[$flow['versionid']]=array(
    'object_id'=>$flow['flow_id'],
    'usecase_id'=>$uc['usecase_id'],
     'name'=>$flow['name'],
    'detail'=>'',
    'object'=>8,
    'number'=>$flow['number'],
     'action'=>$flow['action'],
     'date'=>$flow['create_date'],
        'firstname'=>$flow['firstname'],
    'lastname'=>$flow['lastname'],
     'active'=>$flow['active'],
     );

     $steps=Usecase::model()->getStepVersions($flow['flow_id']);
    foreach($steps as $step){

    
$history[$step['versionid']]=array(
    'object_id'=>$step['step_id'],
    'usecase_id'=>$uc['usecase_id'],
    'name'=>$step['name'],
    'detail'=>$step['detail'],
    'object'=>9,
    'number'=>$step['number'],
    'action'=>$step['action'],
    'date'=>$step['create_date'],
    'firstname'=>$step['firstname'],
    'lastname'=>$step['lastname'],
     'active'=>$step['active'],
     );

 
    
    
        $stepifaces=Usecase::model()->getStepifaceVersions($flow['flow_id']);
        foreach($stepifaces as $stepiface){
        $history[$stepiface['versionid']]=array(
            'object_id'=>$stepiface['stepiface_id'],
            'usecase_id'=>$uc['usecase_id'],
            'name'=>$stepiface['name'],
            'detail'=>$stepiface['detail'],
            'object'=>15,
            'number'=>$stepiface['number'],
            'action'=>$stepiface['action'],
            'date'=>$stepiface['create_date'],
            'firstname'=>$stepiface['firstname'],
            'lastname'=>$stepiface['lastname'],
             'active'=>$stepiface['active'],
             );

            }


        $steprules=Usecase::model()->getStepruleVersions($flow['flow_id']);
        foreach($steprules as $steprule){
        $history[$steprule['versionid']]=array(
            'object_id'=>$steprule['steprule_id'],
            'usecase_id'=>$uc['usecase_id'],
            'name'=>$steprule['name'],
            'detail'=>$steprule['detail'],
            'object'=>16,
            'number'=>$steprule['number'],
            'action'=>$steprule['action'],
            'date'=>$steprule['create_date'],
            'firstname'=>$steprule['firstname'],
            'lastname'=>$steprule['lastname'],
             'active'=>$steprule['active'],
             );

            }



        $stepforms=Usecase::model()->getStepformVersions($flow['flow_id']);
        foreach($stepforms as $stepform){
       $history[$stepform['versionid']]=array(
            'object_id'=>$stepform['stepform_id'],
            'usecase_id'=>$uc['usecase_id'],
            'name'=>$stepform['name'],
            'detail'=>'',
            'object'=>14,
            'number'=>$stepform['number'],
            'action'=>$stepform['action'],
            'date'=>$stepform['create_date'],
            'firstname'=>$stepform['firstname'],
            'lastname'=>$stepform['lastname'],
             'active'=>$stepform['active'],
             );

            }
    
    
    }
    
    
    
    
    
    }
}
            
            
		return $history;
    }
        
      public function getUseCaseVersions($id)
    {
          $release=Yii::App()->session['release'];
          $sql="
            SELECT `u`.`name`,
           `u`.`usecase_id`,
           `vu`.`id` as versionid,
           `vu`.`number` as number,
            `vu`.`action`,
            `vu`.`active`,
            `vu`.`create_date`,
            `c`.`firstname` as `firstname`,
            `c`.`lastname` as `lastname`

            FROM  `step` `s`
            JOIN `flow` `f`
            ON `f`.`flow_id`=`s`.`flow_id`
            JOIN `usecase` `u`
            ON `u`.`usecase_id`=`f`.`usecase_id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id`
            JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`      
            JOIN `user` `c`
            ON `vu`.`create_user`=`c`.`id`
            WHERE 
            `vs`.`object`=9 AND `vs`.`release`=".$release." AND                  
            `vf`.`object`=8 AND  `vf`.`release`=".$release."  AND  
            `vu`.`object`=10 AND `vu`.`release`=".$release."  AND  
            `u`.`usecase_id`=".$id."
             group by `versionid`";
        
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
    

    
      public function getFlowVersions($id)
    {
          $release=Yii::App()->session['release'];
          $sql="
             SELECT `f`.`name` as name,
            `f`.`flow_id`,
            `vf`.`action`,
            `vf`.`active`,
            `vf`.`number` as number,
            `vf`.`create_date`,
            `vs`.`create_user`,
            `vf`.`id` as versionid,
            `c`.`firstname` as `firstname`,
            `c`.`lastname` as `lastname`
          
            FROM  `step` `s`
            JOIN `flow` `f`
            ON `f`.`flow_id`=`s`.`flow_id`
            JOIN `usecase` `u`
            ON `u`.`usecase_id`=`f`.`usecase_id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id`
            JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id` 
            JOIN `user` `c`
            ON `vf`.`create_user`=`c`.`id`
            WHERE 
            `vs`.`object`=9 AND `vs`.`release`=".$release." AND                  
            `vf`.`object`=8 AND  `vf`.`release`=".$release."  AND  
            `vu`.`object`=10 AND `vu`.`release`=".$release."  AND  
            `f`.`usecase_id`=".$id."
             group by `versionid`";
        
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
    
    
    
        public function getStepVersions($id)
    {
          $release=Yii::App()->session['release'];
          $sql="
             SELECT `s`.`text` as name,
             `s`.`result` as detail,
             `s`.`step_id`,
            `vs`.`action`,
            `vs`.`active`,
            `vs`.`number` as number,
            `vs`.`create_date`,
            `vs`.`create_user`,
            `vs`.`id` as versionid,
            `c`.`firstname` as `firstname`,
            `c`.`lastname` as `lastname`

            FROM  `step` `s`
            JOIN `flow` `f`
            ON `f`.`flow_id`=`s`.`flow_id`
            JOIN `usecase` `u`
            ON `u`.`usecase_id`=`f`.`usecase_id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id`
            JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`
            JOIN `user` `c`
            ON `vs`.`create_user`=`c`.`id`
            WHERE 
            `vs`.`object`=9 AND `vs`.`release`=".$release." AND                  
            `vf`.`object`=8 AND  `vf`.`release`=".$release."  AND  
            `vu`.`object`=10 AND `vu`.`release`=".$release."  AND  
            `s`.`flow_id`=".$id."
             group by `versionid`";
        
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
    
    
        public function getStepifaceVersions($id)
    {
          $release=Yii::App()->session['release'];
          $sql="
             SELECT `if`.`name` as name,
             `if`.`text` as detail,
             `si`.`stepiface_id`,
            `vsi`.`action`,
            `vsi`.`active`,
            `vsi`.`number` as number,
            `vsi`.`create_date`,
            `vsi`.`create_user`,
            `vsi`.`id` as versionid,
            `c`.`firstname` as `firstname`,
            `c`.`lastname` as `lastname`

            FROM  `stepiface` `si`
            JOIN `step` `s`
            ON `s`.`step_id`=`si`.`step_id`
            JOIN `iface` `if`
            ON `if`.`iface_id`=`si`.`iface_id`
            JOIN `flow` `f`
            ON `f`.`flow_id`=`s`.`flow_id`
            JOIN `usecase` `u`
            ON `u`.`usecase_id`=`f`.`usecase_id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id`
            JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`
            JOIN `version` `vsi`
            ON `vsi`.`foreign_key`=`si`.`id`
            JOIN `version` `vif`
            ON `vif`.`foreign_key`=`if`.`id`      
            JOIN `user` `c`
            ON `vsi`.`create_user`=`c`.`id`
            WHERE 
            `vs`.`object`=9 AND `vs`.`release`=".$release." AND                  
            `vf`.`object`=8 AND  `vf`.`release`=".$release."  AND  
            `vu`.`object`=10 AND `vu`.`release`=".$release."  AND
            `vsi`.`object`=15 AND `vsi`.`release`=".$release."  AND 
            `vif`.`object`=12 AND `vif`.`release`=".$release."  AND    
            `si`.`step_id`=".$id."
             group by `versionid`";
        
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
    

        public function getStepruleVersions($id)
    {
          $release=Yii::App()->session['release'];
          $sql="
              SELECT `r`.`name` as name,
             `r`.`text` as detail,
             `sr`.`steprule_id`,
            `vsr`.`action`,
            `vsr`.`active`,
            `vsr`.`number` as number,
            `vsr`.`create_date`,
            `vsr`.`create_user`,
            `vsr`.`id` as versionid,
            `c`.`firstname` as `firstname`,
            `c`.`lastname` as `lastname`

            FROM  `steprule` `sr`
            JOIN `step` `s`
            ON `s`.`step_id`=`sr`.`step_id`
            JOIN `rule` `r`
            ON `r`.`rule_id`=`sr`.`rule_id`
            JOIN `flow` `f`
            ON `f`.`flow_id`=`s`.`flow_id`
            JOIN `usecase` `u`
            ON `u`.`usecase_id`=`f`.`usecase_id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id`
            JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`
            JOIN `version` `vsr`
            ON `vsr`.`foreign_key`=`sr`.`id`
            JOIN `version` `vr`
            ON `vr`.`foreign_key`=`r`.`id`      
            JOIN `user` `c`
            ON `vsr`.`create_user`=`c`.`id`
            WHERE 
            `vs`.`object`=9 AND `vs`.`release`=".$release." AND                  
            `vf`.`object`=8 AND  `vf`.`release`=".$release."  AND  
            `vu`.`object`=10 AND `vu`.`release`=".$release."  AND
            `vsr`.`object`=16 AND `vsr`.`release`=".$release."  AND 
            `vr`.`object`=1 AND `vr`.`release`=".$release."  AND    
            `sr`.`step_id`=".$id."
             group by `versionid`";
        
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
    
    
        public function getStepformVersions($id)
    {
          $release=Yii::App()->session['release'];
          $sql="
             SELECT 
            `fm`.`name` as name,
            
            `sf`.`stepform_id`,
            `vsf`.`action`,
            `vsf`.`active`,
            `vsf`.`number` as number,
            `vsf`.`create_date`,
            `vsf`.`create_user`,
            `vsf`.`id` as versionid,
            `c`.`firstname` as `firstname`,
            `c`.`lastname` as `lastname`

            FROM  `stepform` `sf`
            JOIN `step` `s`
            ON `s`.`step_id`=`sf`.`step_id`
            JOIN `form` `fm`
            ON `fm`.`form_id`=`sf`.`form_id`
            JOIN `flow` `f`
            ON `f`.`flow_id`=`s`.`flow_id`
            JOIN `usecase` `u`
            ON `u`.`usecase_id`=`f`.`usecase_id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id`
            JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`
            JOIN `version` `vsf`
            ON `vsf`.`foreign_key`=`sf`.`id`
            JOIN `version` `vfm`
            ON `vfm`.`foreign_key`=`fm`.`id`      
            JOIN `user` `c`
            ON `vsf`.`create_user`=`c`.`id`
            WHERE 
            `vs`.`object`=9 AND `vs`.`release`=".$release." AND                  
            `vf`.`object`=8 AND  `vf`.`release`=".$release."  AND  
            `vu`.`object`=10 AND `vu`.`release`=".$release."  AND
            `vsf`.`object`=14 AND `vsf`.`release`=".$release."  AND 
            `vfm`.`object`=2 AND `vfm`.`release`=".$release."  AND    
            `sf`.`step_id`=".$id."
             group by `versionid`";
        
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }    
    
    
    
           public function getPackageUsecases($id)// THIS IS package_id as used in 'Move' 
    {
            $project=Yii::app()->session['project'];
            $release=Yii::App()->session['release'];
          $sql="
            SELECT `u`.*,
            `p`.`number` as packnumber
            FROM `usecase` `u`
            JOIN `package` `p` 
            ON `p`.`package_id`=`u`.`package_id`
            JOIN `project` `r`
            ON `r`.`id` =`p`.`project_id`
            JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`
            JOIN `version` `vp`
            ON `vp`.`foreign_key`=`p`.`id`
            WHERE 
            `p`.`package_id`=".$id." 
            AND
            `vu`.`active`=1 AND `vu`.`object`=10 AND `vu`.`release`=".$release."
            AND
            `vp`.`active`=1 AND `vp`.`object`=5 AND `vp`.`release`=".$release."
            GROUP BY `u`.`id`
            ORDER BY 
            `p`.`number` ASC,              
            `u`.`number` ASC"


          ;
        
        
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
    
        public function getUsecaseParentPackage($id)
    {
            
            $release=Yii::App()->session['release'];
          $sql="
            SELECT `p`.*
            FROM `package` `p` 
            JOIN `usecase` `u`
            ON `p`.`package_id`=`u`.`package_id`
            JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`
            JOIN `version` `vp`
            ON `vp`.`foreign_key`=`p`.`id`
            WHERE 
            `u`.`id`=".$id." 
            AND
             
            `vu`.`active`=1 AND `vu`.`object`=10 AND `vu`.`release`=".$release."
            AND
            `vp`.`active`=1 AND `vp`.`object`=5 AND `vp`.`release`=".$release;
        
        
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects[0];
    }
    
    
      public function getNextNumber($id)
    {
       // GEts the UC sequence number within the package
            $release=Yii::App()->session['release'];
          
            $sql="    
            SELECT max(`u`.`number`)as number
            FROM
            `usecase` `u`
            JOIN `package` `p`
            ON `p`.`package_id`=`u`.`package_id`
            JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`
            JOIN `version` `vp`
            ON `vp`.`foreign_key`=`p`.`id`
            WHERE 
            `p`.`id`=".$id."
            AND
            `vu`.`active`=1 AND `vu`.`object`=10 AND `vu`.`release`=".$release."
            AND
            `vp`.`active`=1 AND `vp`.`object`=5 AND `vp`.`release`=".$release;
        
            
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
    
         public function getNextUC($dir,$id)
    {
             $project=Yii::App()->session['project'];
             $release=Release::model()->currentRelease($project);
       if ($dir==1) {
           $order='ASC';
           $compare='>';
       }
       if ($dir==2) {
           $order='DESC';
           $compare='<';
       }
              

                     $sql=" SELECT `r`.`number`,`r`.`id`
                    From `usecase` `r`
                    WHERE `r`.`number`".$compare.$id."
                   
                        AND 
                    `r`.`project_id`=".$project."
                        AND
                       `r`.`release_id`=".$release."
                    ORDER BY `r`.`number` ".$order."
                        LIMIT 0,1";
                            
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
	
		return $projects[0]['id'];
    }  
    
    
               public function getProjectUCs()
    {
        
      
         $release=Yii::App()->session['release'];  

         $sql="SELECT 
            `u`.*,
            `p`.`name` as packname,
            `p`.`id` as packid,
            `p`.`number` as packnumber,
            `s`.`id` as steps
            FROM `package` `p`

            JOIN  `usecase` `u`
            on `p`.`package_id`=`u`.`package_id`
            
            JOIN `project` `r`
            ON `r`.`id` =`p`.`project_id`
            
            Join `flow` `f`
            ON `u`.`usecase_id`=`f`.`usecase_id`
            
            Join `step` `s`
            ON `f`.`flow_id`=`s`.`flow_id`

            JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`
            
            JOIN `version` `v2`
            ON `v2`.`foreign_key`=`p`.`id`
            
            JOIN `version` `v3`
            ON `v3`.`foreign_key`=`s`.`id`
            
            JOIN `version` `v4`
            ON `v4`.`foreign_key`=`f`.`id`
            WHERE 
            
            `vu`.`active`=1 AND `vu`.`object`=10 
               AND `vu`.`release`=".$release." 
            AND
            `v2`.`active`=1 AND `v2`.`object`=5  
               AND `v2`.`release`=".$release." 
            AND
            `v3`.`active`=1 AND `v3`.`object`=9  
                AND `v3`.`release`=".$release." 
            AND
            `v4`.`active`=1 AND `v4`.`object`=8  
              AND `v4`.`release`=".$release." 
            
                GROUP BY `u`.`id`
                ORDER BY 
             `p`.`number` ASC,              
             `u`.`number` ASC";
  
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }   
    
       public function getAllReleaseUCs()
    {
        
      
   $release=Yii::App()->session['release'];

         $sql="SELECT 
            `u`.*,
            `p`.`name` as packname,
            `p`.`id` as packid,
            `p`.`number` as packnumber,
            `s`.`id` as steps,
            `vu`.`create_date` as create_date
           
            FROM `package` `p`

            JOIN  `usecase` `u`
            on `p`.`package_id`=`u`.`package_id`
            
            JOIN `project` `r`
            ON `r`.`id` =`p`.`project_id`
            
            Join `flow` `f`
            ON `u`.`usecase_id`=`f`.`usecase_id`
            
            Join `step` `s`
            ON `f`.`flow_id`=`s`.`flow_id`

            JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`
            
            JOIN `version` `v2`
            ON `v2`.`foreign_key`=`p`.`id`
            
            JOIN `version` `v3`
            ON `v3`.`foreign_key`=`s`.`id`
            
            JOIN `version` `v4`
            ON `v4`.`foreign_key`=`f`.`id`
            WHERE 
            
            `vu`.`object`=10 
               AND `vu`.`release`=".$release." 
            AND
            `v2`.`object`=5  
               AND `v2`.`release`=".$release." 
            AND
            `v3`.`object`=9  
                AND `v3`.`release`=".$release." 
            AND
            `v4`.`object`=8  
              AND `v4`.`release`=".$release." 
            
                GROUP BY `u`.`id`
                ORDER BY 
             `p`.`number` ASC,              
             `u`.`number` ASC";
  
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }   
    
    
                public function getReleaseUCs($release)
    {
        
      
   

         $sql="SELECT 
            `u`.*,
            `p`.`name` as packname,
            `p`.`id` as packid,
            `p`.`number` as packnumber,
            `s`.`id` as steps,
            `vu`.`create_date` as create_date
           
            FROM `package` `p`

            JOIN  `usecase` `u`
            on `p`.`package_id`=`u`.`package_id`
            
            JOIN `project` `r`
            ON `r`.`id` =`p`.`project_id`
            
            Join `flow` `f`
            ON `u`.`usecase_id`=`f`.`usecase_id`
            
            Join `step` `s`
            ON `f`.`flow_id`=`s`.`flow_id`

            JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`
            
            JOIN `version` `v2`
            ON `v2`.`foreign_key`=`p`.`id`
            
            JOIN `version` `v3`
            ON `v3`.`foreign_key`=`s`.`id`
            
            JOIN `version` `v4`
            ON `v4`.`foreign_key`=`f`.`id`
            WHERE 
            
            `vu`.`active`=1 AND `vu`.`object`=10 
               AND `vu`.`release`=".$release." 
            AND
            `v2`.`active`=1 AND `v2`.`object`=5  
               AND `v2`.`release`=".$release." 
            AND
            `v3`.`active`=1 AND `v3`.`object`=9  
                AND `v3`.`release`=".$release." 
            AND
            `v4`.`active`=1 AND `v4`.`object`=8  
              AND `v4`.`release`=".$release." 
            
                GROUP BY `u`.`id`
                ORDER BY 
             `p`.`number` ASC,              
             `u`.`number` ASC";
  
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
            SELECT `r`.*,`v`.`active`
            FROM `iface` `r`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id`
            WHERE 
              `v`.`object`=12 AND `v`.`active`=1  AND `v`.`project_id`=".$project."
            and        
            `r`.`release_id`=".$release."
            and
            `r`.`project_id`=".$project;

     
        
        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		
		return $projects;
    }  
    
       public function linkedObjectComparison($params)
    {
       
           $relationship=array(1=>16,2=>14);
           
           $paramsold['id']=$params['id'];
           $paramsold['object']=$params['object'];
           $paramsold['relationship']=$relationship[$params['object']];
           $paramsold['release']=$params['old'];
           
           $paramsnew['id']=$params['id'];
           $paramsnew['object']=$params['object'];
           $paramsnew['relationship']=$relationship[$params['object']];
           $paramsnew['release']=$params['new'];
           
        $old = Usecase::model()->getlinkedObjects($paramsold);
        $new = Usecase::model()->getlinkedObjects($paramsnew);
        $deletedObject = array();
        $addedObject=array();
  //find deleted UC's
     $instance_id=Version::$objects[$params['object']] .'_id';
        if (count($old))
            {
                foreach($old as $itemold){
                    
                   $matchingNew=-1;
                    for($i=0;$i<count($new);$i++)
                    {
                    if($new[$i][$instance_id]==$itemold[$instance_id])
                        {
                        $matchingNew=$new[$i][$instance_id];
                        }
                        
                    }
                    if ($matchingNew == -1) array_push($deletedObject,$itemold[$instance_id]);
                }
           
    }
     
      if (count($new))
            {
                foreach($new as $itemnew){
                    
                   $matchingOld=-1;
                    for($i=0;$i<count($old);$i++)
                    {
                    if($old[$i][$instance_id]==$itemnew[$instance_id]) {
                        $matchingOld=$old[$i][$instance_id];
                    }
                        
                    }
                    if ($matchingOld == -1) array_push($addedObject,$itemnew[$instance_id]);
                }
           
    }
    $return=array('add'=>$addedObject,'delete'=>$deletedObject);
    return $return;
    }  
           public function getLinkUsecase($id,$object,$relationship) // id is object_id
    {
           //This is used to show back links from rules, forms and ifaces to UC's
  $release=Yii::App()->session['release'];
               $project=Yii::App()->session['project'];      
            $sql="
                SELECT 
                `f`.`id` as flow_id,
                `f`.`name` as flow_name,
                `u`.`id` as usecase_dbid,
                `u`.`usecase_id` as usecase_id,
                `u`.`name` as usecase_name,
                `u`.`number` as usecase_number,
                `p`.`number` as package_number
                FROM `".Version::$objects[$object]."` `o`
                JOIN `step".Version::$objects[$object]."` `x`
                ON `x`.`".Version::$objects[$object]."_id`=`o`.`".Version::$objects[$object]."_id`
                JOIN `step` `s`
                ON `s`.`step_id`=`x`.`step_id`
                JOIN `flow` `f`
                ON `f`.`flow_id`=`s`.`flow_id`
                JOIN `usecase` `u`
                ON `f`.`usecase_id`=`u`.`usecase_id`
                JOIN `package` `p`
                ON `p`.`package_id`=`u`.`package_id`
                JOIN `version` `vo`
                ON `vo`.`foreign_key`=`o`.`id` 
                JOIN `version` `vx`
                ON `vx`.`foreign_key`=`x`.`id`
                JOIN `version` `vs`
                ON `vs`.`foreign_key`=`s`.`id`
                JOIN `version` `vu`
                ON `vu`.`foreign_key`=`u`.`id`
                JOIN `version` `vp`
                ON `vp`.`foreign_key`=`p`.`id`
                JOIN `version` `vf`
                ON `vf`.`foreign_key`=`f`.`id`
                WHERE 
                `o`.`".Version::$objects[$object]."_id`=".$id."
                AND
                `vo`.`object`=".$object."  AND `vo`.`active`=1  AND `vo`.`release`=".$release." 
                AND
                `vx`.`object`=".$relationship." AND `vx`.`active`=1  AND `vx`.`release`=".$release."
                AND
                `vs`.`object`=9 AND  `vs`.`active`=1  AND `vs`.`release`=".$release."
                AND
                `vu`.`object`=10  AND `vu`.`active`=1  AND `vu`.`release`=".$release."
                AND
                `vp`.`object`=5 AND `vp`.`active`=1  AND `vp`.`release`=".$release." 
                 AND
                `vf`.`object`=8 AND `vf`.`active`=1  AND `vf`.`release`=".$release." 
                GROUP BY `usecase_id`";
         
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
	$projects = $command->queryAll();
	return $projects;
    }  
    
    
    
             public function getLinkedObjects($params)
    {
            $id=$params['id'];
            $object=$params['object'];
            $relationship=$params['relationship'];
            
            if(isset($params['release'])){
                $release=$params['release'];
            } ELSE {
                             
                    $release=Yii::App()->session['release'];
                    }
            $sql="
            SELECT 
            `r`.*,
            `x`.id as xid
            FROM `".Version::$objects[$object]."` `r`
            JOIN `step".Version::$objects[$object]."` `x`
            ON `x`.`".Version::$objects[$object]."_id`=`r`.`".Version::$objects[$object]."_id`
            JOIN `step` `s`
            ON `s`.`step_id`=`x`.`step_id`
            JOIN `flow` `f`
            ON `f`.`flow_id`=`s`.`flow_id`
            JOIN `version` `vr`
            ON `vr`.`foreign_key`=`r`.`id`
            JOIN `version` `vx`
            ON `vx`.`foreign_key`=`x`.`id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id` 
            WHERE
            `f`.`usecase_id`=".$id."
         AND
            `vr`.`object` =".$object." AND `vr`.`active`=1  AND `vr`.`release`=".$release."
            AND
            `vx`.`object` =".$relationship." AND `vx`.`active`=1 AND `vx`.`release`=".$release."   
            AND `vs`.`object` =9 AND `vs`.`active`=1  AND `vs`.`release`=".$release."
            AND `vf`.`object` =8 AND `vf`.`active`=1  AND `vf`.`release`=".$release."
             GROUP BY `r`.`id`
             ORDER BY `r`.`number` ASC";
        
         
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
		return $projects;
    }
    
    
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usecase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
