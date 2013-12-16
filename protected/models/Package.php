<?php

/**
 * This is the model class for table "package".
 *
 * The followings are the available columns in table 'package':
 * @property integer $id
 * @property string $name
 * @property integer $project_id
 */
class Package extends CActiveRecord
{
 public static $packagestage= array(1=>'Bidding', 2=>'Let', 3=>'Progress',4=>'Complete'); 	
public static $packagestageicon= array(1=>'icon-time text-warning',
                                        2=>'icon-check text-success',
                                        3=>'icon-play',
                                        4=>'icon-ok-sign'); 	

    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Package the static model class
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
		return 'package';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, project_id, stage, sequence', 'required'),
			array('project_id', 'numerical', 'integerOnly'=>true),
                        array('budget, stage', 'numerical', 'integerOnly'=>false),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, stage, project_id, sequence', 'safe', 'on'=>'search'),
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
              'subcontract'=>array(self::HAS_ONE,'Subcontract','package_id'),
              'packagedocument'=>array(self::HAS_ONE,'Packagedocument','package_id'),
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
		'project_id' => 'Project',
                'budget'=>'Budget',
                'sequence'=>'Sequence'
                   
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('project_id',$this->project_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
         public function addfromtemplate($pid,$tid)// project // template
	{
		//$this->redirect(array('viewc-'.$cid.'p-'.$pid));
          $sql="  
        insert into `package`
        ( `name`, `sequence`,`project_id`)
         Select `i`.`name`, 
        `i`.`sequence`,".$pid." 
        from `packagetemplateitem` `i`
        join packagetemplate t
        on t.id=i.template_id
        where 
        t.id=".$tid;
                  
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
        
        $sql = "
        insert into tenderqs 
        (package_id, name, description, unit, parent_type, type, sequence)
         select id,'Fixed Price',
        'Fixed price for the entire scope of works as described in the documents provided.',
        'Item',
        2, 3, 1
        from package where project_id=".$pid;
	   $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();  
	}
        
         public function getPackages($id) // project id
    {
     
              
        
      $sql="SELECT p.id, p.name, p.sequence, p.budget,p.stage
         FROM package  p
         WHERE
         p.project_id=".$id." 
         group by p.id
         order by p.sequence ASC";
      /*
             $sql="SELECT p.id, p.name, p.sequence, p.budget,p.stage, 
         
         (select sum(a.amount) from costallocation a where a.package_id=p.id ) as amount,
         (select sum(b.extension) from boqitem b where b.package_id=p.id) as boq,
         (select sum(i.amount) from contractitem i
         JOIN variation v
         ON v.id=i.variation_id
         where i.package_id=p.id 
         and
         v.contract=0
         and
         v.status=2) as variation,
         
         (select sum(i.amount) from contractitem i
         JOIN variation v
         ON v.id=i.variation_id
         where i.package_id=p.id and
         v.contract=1
         and v.status=2) as contract
         
         FROM package  p
         WHERE
         p.project_id=".$id." 
         group by p.id
         order by p.sequence ASC";
       */
  
      
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $contacts = $command->queryAll();
        return $contacts;
        }
        
        
        
              public function getPackageAllocations($id) // project id
    {
     
      $sql="SELECT  
          sum(a.amount) as allocated
          from package  p
          left outer join costallocation a
          on a.package_id=p.id
          WHERE
          p.id=".$id;
      
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $results = $command->queryAll();
        return $results[0]['allocated'];
     }
        
              public function getPackageBoQs($id) // project id
    {
     // Get a sum of the BOQ extensions for a given package
      $sql="SELECT  
          sum(b.extension) as boq
          from package  p
          left outer join boqitem b
          on b.package_id=p.id
          WHERE
          p.id=".$id;
      
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $results = $command->queryAll();
        if(!empty($results)) return $results[0]['boq'];
     }
     
               public function getPackageBoQProgress($id) // project id
    {
     // get a % complete of the BoQ items for a package.
      $sql="SELECT  
          (sum(b.extension * a.amount/100)/sum(b.extension))*100 as boq
          from package  p
          left join boqitem b
          on b.package_id=p.id
          left join progressassessment a
          on a.boqitem_id = b.id
          WHERE
          p.id=".$id;
      
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $results = $command->queryAll();
        if(!empty($results)) return $results[0]['boq'];
     }
     
                public function getPackageClaimAssessment($claim,$pack) // project id
    {
     
      $sql="SELECT  
          `b`.`amount`, `b`.`id`, `b`.`assessment`
          from `package`  `p`
          left join `claimassessment` `b`
          on `b`.`package_id`=`p`.`id`
          WHERE
          `b`.`claim_id`=".$claim."
          AND
          `p`.`id`=".$pack;
      
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $results = $command->queryAll();
        if(!empty($results)): 
        $result['amount']= $results[0]['amount'];
        $result['id']= $results[0]['id'];
        $result['assessment']= $results[0]['assessment'];
        else: 
        $result['amount']=0;
        $result['id']=-1;
        $result['assessment']=0;
                endif;
        return $result;
        
     }
     
      public function getPackageClaimed($pack) // project id
    {
     
      $sql="SELECT  
          sum(`b`.`assessment`) as claimed
          FROM `claimassessment` `b`
          join `claim` `c`
          on `b`.`claim_id`=`c`.`id`
          WHERE
          `c`.`status`=2
          AND
          `b`.`package_id`=".$pack;
      
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $results = $command->queryAll();
        if(!empty($results)): 
        $result['claimed']= $results[0]['claimed'];
        else: 
        $result['claimed']=0;
                endif;
        return $result;
        
     }
     
        
                     public function getAllocations($id) // project id
    {
     
        $sql="SELECT a.id as allocationid, p.id, a.amount, k.name as name, a.notes, c.id as costid
          from package  p
          left outer join costallocation a
          on a.package_id=p.id
          join cost c
          on c.id=a.cost_id
          join company k
          on k.id=c.supplier_id
          WHERE
          p.id=".$id;
      
  
      
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $contacts = $command->queryAll();
        return $contacts;
        }
        
        
       public function getSubbieBids($id) // get all bids related to an ORganisation for packages
    {
     
        $sql="SELECT 
               g.id as packid, g.name as packname, p.name as projname, 
                c.name as compname, k.firstname, f.id,
                f.modified_date
                FROM package g
                JOIN project p ON p.id=g.project_id
                JOIN follower f ON f.foreign_key=g.id
                JOIN contact k ON f.contact_id=k.id
                JOIN company c ON k.company_id=c.id

                WHERE
                c.id=".$id."
                AND
                f.type=2";
         $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $contacts = $command->queryAll();
        return $contacts;
        }   
              public function matchExistingbyName($name)
    {
        $company=User::model()->myCompany();  
              
        $sql="Select `p`.`id` 
            FROM `package` `p`
            join `project` `q`
            on `q`.`id`=`p`.`project_id`
           WHERE
           `p`.`name` like '".$name."'
               AND
            `q`.`company_id`=".$company;
	 $connection=Yii::app()->db;
      $command = $connection->createCommand($sql);
      $result = $command->queryAll();
      
      return $result;

    
    }


      
                    public function matchExistingbyNumber($sequence,$project)
    {
    $candidates = Yii::app()->db->createCommand()
                  ->select('id')
                  ->from('package u')
                  ->where('sequence like :name and project_id = :project'  , 
                  array(':name'=>$sequence,':project'=>$project))
                  ->queryRow();
    return $candidates['id'];
    
    }
    
                      public function newUpload($item)
    {
      
                  	$model=new Package;
                        $model->name='New Package';
                        $model->sequence=$item['package'];
                        $model->project_id=$item['project_id'];
			$model->save();
                        $result=$model->primaryKey;
                  
                      return $result;
    }
    
    
}