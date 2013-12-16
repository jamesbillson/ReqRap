<?php

class Follower extends CActiveRecord
{
    public static $foreigntype= array(1=>'project', 2=>'package');  
    public static $followerupload= array(0=>'view only', 2=>'can upload');
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Follower the static model class
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
        return 'follower';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('contact_id, type, foreign_key, modified, modified_date', 'required'),
            array(' contact_id, type, foreign_key, tenderer, confirmed, modified', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, contact_id, type, foreign_key, tenderer, confirmed, modified, modified_date', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
             'project' => array(self::BELONGS_TO, 'Project', 'foreign_key','condition'=>'type=1',),
             'package' => array(self::BELONGS_TO, 'Package', 'foreign_key','condition'=>'type=2',),
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.

                
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'contact_id'=> 'Contact',
            'type' => 'Type',
            'tenderer' => 'Tenderer',
            'foreign_key' => 'Foreign Key',
            'confirmed' => 'Confirmed',
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
                $criteria->compare('contact_id',$this->contact_id);
        $criteria->compare('type',$this->type);
        $criteria->compare('foreign_key',$this->foreign_key);
        $criteria->compare('confirmed',$this->confirmed);
        $criteria->compare('modified',$this->modified);
        $criteria->compare('tenderer',$this->tenderer);
        $criteria->compare('modified_date',$this->modified_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
        
    public function getFollowers($fk,$type)
    {
      
        $sql="SELECT  `c`.`firstname` ,  `c`.`lastname` ,  `c`.`id` ,
                `c`.`email` ,  `f`.`confirmed` ,  `f`.`id` AS follower_id,
                `u`.`id` AS user_id
            FROM  `contact`  `c` 
                JOIN  `follower`  `f` ON  `f`.`contact_id` =  `c`.`id` 
                JOIN  `user`  `u` ON  `u`.`id` =  `c`.`user_id` 
            WHERE
              `f`.`type`=".$type." AND  
                 `f`.`confirmed`=1
             AND
                 `f`.`tenderer`=0
            AND
                `f`.`foreign_key`=".$fk;
        
        
         
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $contacts = $command->queryAll();
        
        return $contacts;
    }

        public function getTenderers($fk,$type)
    {
      
        $sql="SELECT  `c`.`firstname` ,  `c`.`lastname` ,  `c`.`id` ,
                `c`.`email` ,  `f`.`confirmed` ,  `f`.`id` AS `follower_id`,
                `u`.`id` AS `user_id`, `k`.`id` as `company_id`, `k`.`name` as `companyname`
            FROM  `contact`  `c` 
                JOIN  `follower`  `f` ON  `f`.`contact_id` =  `c`.`id` 
                JOIN `company` `k` ON `c`.`company_id`=`k`.`id`
                JOIN  `user`  `u` ON  `u`.`id` =  `c`.`user_id` 
            WHERE
                
                `f`.`tenderer`=1            
            AND
                `f`.`foreign_key`=".$fk;
        //`f`.`type`=".$type."  AND
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $contacts = $command->queryAll();
        
        return $contacts;
    }
    
    public function getFollowerPendingInvites($fk,$type)
    {
      
        $sql="SELECT  `c`.`firstname` ,  `c`.`lastname` ,  `c`.`id` ,
                `c`.`email` ,  `f`.`confirmed` ,  `f`.`id` AS follower_id
          
            FROM  `contact`  `c` 
                JOIN  `follower`  `f` ON  `f`.`contact_id` =  `c`.`id` 
            
            WHERE
                `f`.`type`=".$type." 
            AND
                `f`.`confirmed`=0 
                        AND
                `f`.`tenderer`=0 
            AND            
                `f`.`foreign_key`=".$fk;
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $contacts = $command->queryAll();
        
        return $contacts;
    }
   
        public function getTendererPendingInvites($fk,$type)
    {
      
        $sql="SELECT  `c`.`firstname` ,  `c`.`lastname` ,  `c`.`id` ,
                `c`.`email` ,  `f`.`confirmed` ,  `f`.`id` AS follower_id
          
            FROM  `contact`  `c` 
                JOIN  `follower`  `f` ON  `f`.`contact_id` =  `c`.`id` 
            
            WHERE
                `f`.`type`=".$type." 
            AND
                `f`.`confirmed`=0 
                 AND
                `f`.`tenderer`=1 
            AND            
                `f`.`foreign_key`=".$fk;
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $contacts = $command->queryAll();
        
        return $contacts;
    }
    
    public function sendInvite($id)
    {

       $follower = $this->findByPk($id);   
       if($follower->type == 1) {
           $project=Project::model ()->findbyPK($follower->foreign_key);
           $extlink=$project->extlink;
            }
       if($follower->type == 2) {
           $package=Package::model()->findbyPK($follower->foreign_key);
           $extlink=$package->project->extlink;
                             }
       $creator = User::model()->findbyPk(Yii::app()->user->id);
       $contact = Contact::model()->findbyPk($follower->contact_id);
       $matchuser = User::model()->find("username = '".$contact->email."'");
       $mail = new YiiMailer();
       $mail->setFrom($creator->username,$creator->firstname.' '.$creator->lastname);
       $mail->setTo($contact->email);
               
        if (count($matchuser))
        {
            //if the user has an account send an email saying they've been invite to follow

            $mail->setSubject('You have been invited to follow a project');
            $mail->setBody($contact->firstname.',
            <br /><br />
            You\'ve been invited to follow a Naild project. 
            <br />As you already have a Naild
            account, just click the link below to get instant access to the project\'s
                    resources.
            <br />
            Click here to accept <a href="http://'.Yii::app()->params['server'].'/follower/accept/id/'.$follower->link.'">'.Yii::app()->params['server'].'/follower/accept/id/'.$follower->link.'</a>                   
            <br />
            You can access the project documents without logging in directly here:
            <a href="http://'.Yii::app()->params['server'].'/project/extview/id/'.$extlink.'">'.Yii::app()->params['server'].'/project/extview/id/'.$extlink.'</a>          
            
            
            ');

        }else {
            //if the user has no account send an instruction to join.

            $mail->setSubject('You have been invited to follow a project');
            $mail->setBody($contact->firstname.',
            <br /><br />
            You\'ve been invited to follow a Naild project.  You can follow the link below
            to create an account on Naild and to get access to project resources.
            <br />
            Click here to accept <a href="http://'.Yii::app()->params['server'].'/follower/accept/id/'.$follower->link.'">'.Yii::app()->params['server'].'/follower/accept/id/'.$follower->link.'</a>                   
            <br />
             You can access the project documents without logging in directly here:
            <a href="http://'.Yii::app()->params['server'].'/project/extview/id/'.$extlink.'">'.Yii::app()->params['server'].'/project/extview/id/'.$extlink.'</a>          
            
            ');
        }
        $mail->Send();          
    }
     
    
       public function sendAcceptConfirm($id)
    {

       $follower = $this->findByPk($id);   
       if($follower->type == 1) {
           $project=Project::model ()->findbyPK($follower->foreign_key);
           $projectName=$project->name;
           $companyName=$project->company->name;
           $extlink=$project->extlink;
            }
       if($follower->type == 2) {
           $package=Package::model()->findbyPK($follower->foreign_key);
           $extlink=$package->project->extlink;
           $projectName=$package->project->name;
           $companyName=$package->project->company->name;
                             }
       $contact = Contact::model()->findbyPk($follower->contact_id);
        $creator=User::model()->findbyPK($follower->modified);
       $mail = new YiiMailer();
       $mail->setFrom($creator->username,$creator->firstname.' '.$creator->lastname);
       $mail->setTo($contact->email);
     
          

            $mail->setSubject('You are now following '.$projectName);
            $mail->setBody($contact->firstname.',
            <br /><br />
            You\'ve accepted the invitation to follow '.$projectName.' managed by '.$companyName.'. 
            <br />The system will send you notifications when documents are updated by default, 
            but you can change the settings whenever you like by going to your account page.
             <a href="http://www.naild.com.au/user/myaccount/">http://www.naild.com.au/user/myaccount/</a>
            <br />
            Don\'t forget you can access the project documents without logging in directly here:
            <a href="http://'.Yii::app()->params['server'].'/project/extview/id/'.$extlink.'">'.Yii::app()->params['server'].'/project/extview/id/'.$extlink.'</a>          
               <br />
                  <br />
                  Thanks for using Nail\'d.
            
            ');

        
        $mail->Send(); 
        
       $mail = new YiiMailer();
       $mail->setFrom('info@naild.com.au','Nail\'d System - '.$companyName);
       $mail->setTo($contact->email);
     
          

            $mail->setSubject($contact->firstname.' '.$contact->lastname.' is now following '.$projectName);
            $mail->setBody($creator->firstname.',
            <br /><br />
            Hi, this is to notify you that your contact '.$contact->firstname.'  from 
                '.$contact->worksfor->name.' has accepted the invitation to follow your project '.$projectName.'. 
            <br />
            <br />
            Thanks for keeping it Nail\'d.
            
            ');

        
        $mail->Send(); 
        
        
    }
    
    
      public function sendNewDocumentNotification($id)// PROJECT ID
    {

          
          // Find all followers of the project and its child packages who have notification set on.
          //loop through the array of followers
          // create an email for each one.
          
          
          
          
          
          
       $follower = $this->findByPk($id);   
       if($follower->type == 1) {
           $project=Project::model ()->findbyPK($follower->foreign_key);
           $projectName=$project->name;
           $companyName=$project->company->name;
           $extlink=$project->extlink;
            }
       if($follower->type == 2) {
           $package=Package::model()->findbyPK($follower->foreign_key);
           $extlink=$package->project->extlink;
           $projectName=$package->project->name;
           $companyName=$package->project->company->name;
                             }
       $contact = Contact::model()->findbyPk($follower->contact_id);
       $creator=User::model()->findbyPK($follower->modified);
       $mail = new YiiMailer();
       $mail->setFrom($creator->username,$creator->firstname.' '.$creator->lastname);
       $mail->setTo($contact->email);
     
            $mail->setSubject('New Documents for '.$projectName);
            $mail->setBody($contact->firstname.',
            <br /><br />
            New documents have been uploaded to the document repository 
            for '.$projectName.' managed by '.$companyName.'. 
            <br />
            Don\'t forget you can access the project documents without logging in directly here:
            <a href="http://'.Yii::app()->params['server'].'/project/extview/id/'.$extlink.'">
            http://'.Yii::app()->params['server'].'/project/extview/id/'.$extlink.'</a>          
            <br />
            <br />
            Thanks for using Nail\'d.<br />
            Note: The system will send you notifications when documents are updated by default, 
            but you can change the settings whenever you like by going to your account page. 
            <a href="http://www.naild.com.au/user/myaccount/">http://www.naild.com.au/user/myaccount/</a>
            <br />
            ');
  
        $mail->Send(); 
        
    }
    
    
    public function getMyProjectFollows($id)
    {
        //$id is the accepted state where 0=invite, 1=follow
        $sql="SELECT  `p`.`name` as pname, `p`.`id`, `p`.`stage`,
                `f`.`modified_date` ,  `f`.`id` as fid ,  `f`.`link` ,
                `k`.`name` AS cname,  `k`.`id` cid, `f`.`type`
            FROM  `follower`  `f` 
                JOIN  `contact`  `c` ON  `f`.`contact_id` =  `c`.`id` 
                JOIN  `user`  `u` ON  `u`.`username` =  `c`.`email` 
                JOIN  `project`  `p` ON  `p`.`id` =  `f`.`foreign_key` 
                JOIN  `company`  `k` ON  `k`.`id` =  `p`.`company_id` 
            WHERE  `f`.`confirmed` =".$id."
                    AND `f`.`type`=1
                AND  `u`.`id` =".Yii::app()->user->id;
            
            $connection=Yii::app()->db;
            $command = $connection->createCommand($sql);
            $invites = $command->queryAll();
            
            return $invites;
    }

    public function getMyPackageFollows($id)
    {
         //$id is the accepted state where 0=invite, 1=follow   
        $sql="SELECT   `q`.`name` , `q`.`id`,
                `f`.`modified_date` ,  `f`.`id` as fid ,  `f`.`link` ,
                `k`.`name` AS cname, `p`.`name` as pname, `k`.`id` cid, `f`.`type`
            FROM  `follower`  `f` 
                JOIN  `contact`  `c` ON  `f`.`contact_id` =  `c`.`id` 
                JOIN  `user`  `u` ON  `u`.`username` =  `c`.`email` 

                JOIN  `package`  `q` ON  `q`.`id` =  `f`.`foreign_key` 
                JOIN  `project`  `p` ON  `p`.`id` =  `q`.`project_id`
                JOIN  `company`  `k` ON  `k`.`id` =  `p`.`company_id` 
            WHERE  `f`.`confirmed` =".$id."
                AND `f`.`type`=2     
                AND  `u`.`id` =".Yii::app()->user->id;
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $invites = $command->queryAll();
        
        return $invites;
    }
        
    public function getProjectFollowerDetails($project_id)
    {
         //$id is the accepted state where 0=invite, 1=follow   
        $sql="SELECT  `f`.`upload`,`f`.`id`,`f`.`type` ,`f`.`tenderer`
            FROM  `follower`  `f` 
                JOIN  `contact`  `c` ON  `f`.`contact_id` =  `c`.`id` 
                JOIN  `user`  `u` ON  `u`.`username` =  `c`.`email` 
            WHERE  
                `f`.`confirmed` =1
            AND `f`.`foreign_key` = ".$project_id."
                AND  `u`.`id` =".Yii::app()->user->id;
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $details = $command->queryAll();
        
        return $details[0];
    }       
    
    public function createManualSubcontractor($followid,$packid) // subcontractor_id,package
    {

      $sql="INSERT INTO follower 
          (name, description, type, subcontract_id, amount, unit, price)
          SELECT t.name, t.description,t.type, ".$id." ,0,t.unit ,0
            FROM `tenderqs` t
            WHERE 
            _id=".$packid;
            $connection=Yii::app()->db;
            $command = $connection->createCommand($sql);
            $data = $command->queryAll();
            
        
            } 
    
    
}