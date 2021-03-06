<?php

class Version extends CActiveRecord {

    public static $objects = array(1 => 'rule',
        2 => 'form',
        3 => 'formproperty',
        4 => 'actor',
        5 => 'package',
        6 => 'object',
        7 => 'objectproperty',
        8 => 'flow',
        9 => 'step',
        10 => 'usecase',
        11 => 'photo',
        12 => 'iface',
        13 => 'interfacetype',
        14 => 'stepform',
        15 => 'stepiface',
        16 => 'steprule',
        17 => 'category',
        18 => 'simple',
    );
    
      public static $object_labels = array(1 => 'Business Rule',
        2 => 'Form',
        3 => 'Form Property',
        4 => 'Actor',
        5 => 'Package',
        6 => 'Business Object',
        7 => 'Object Property',
        8 => 'Flow',
        9 => 'Step',
        10 => 'Use Case',
        11 => 'Interface Image',
        12 => 'Interface',
        13 => 'Interface Type',
        14 => 'Related Form',
        15 => 'Related Interface',
        16 => 'Related Rule',
        17 => 'Category',
        18 => 'Simple Requirement',
    );
    
     public static $code = array(
        1 => 'BR',
        2 => 'UF',
        4 => 'AC',
        5 => 'PA',
        6 => 'OB',
        10 => 'UC',
        12 => 'UI',
        );
    public static $parents = array(1 => 'none', //rule
        2 => 'none', //form
        3 => 'form', //formproperty
        4 => 'none', //actor
        5 => 'none', //package
        6 => 'none', //object
        7 => 'object', //objectproperty
        8 => 'usecase,startstep,rejoinstep', //flow
        9 => 'flow,actor', //step
        10 => 'package, actor', //usecase
        11 => 'none', //photo
        12 => 'photo,interfacetype', //iface
        13 => 'none', //interfacetype
        14 => 'step,form', //stepform
        15 => 'step,iface', //stepiface
        16 => 'step,rule', //steprule
        17 => 'none', //category
        18 => 'category'//simple
    );
    
    public static $child = array(
        14 => 2, //stepform
        15 => 12, //stepiface
        16 => 1, //steprule
        );
    
      public static $number = array( // used for Import
        1 => 'rule', // whether a object needs its number offset on import
        2 => 'form',
        3 => 'none',
        4 => 'none',
        5 => 'package',
        6 => 'object',
        7 => 'none',
        8 => 'none',
        9 => 'none',
        10 => 'none',
        11 => 'none',
        12 => 'iface',
        13 => 'interfacetype',
        14 => 'none',
        15 => 'none',
        16 => 'none',
        17 => 'category',
        18 => 'none',
    );
    
      
         public static $numberformat = array( // used for Import
        1 => array('prepend'=>'BR','padding'=>3), // whether a object needs its number offset on import
        2 => array('prepend'=>'UF','padding'=>3),// need to handle the Type number
        3 => array('prepend'=>'NONE','padding'=>0),
        4 => array('prepend'=>'Actor','padding'=>0),
        5 => array('prepend'=>'PA','padding'=>0),
        6 => array('prepend'=>'OB','padding'=>3),
        7 => array('prepend'=>'NONE','padding'=>3),
        8 => array('prepend'=>'Flow','padding'=>0),
        9 => array('prepend'=>'NONE','padding'=>0),
        10 => array('prepend'=>'UC','padding'=>3),// need to handle the Package number
        11 => array('prepend'=>'NONE','padding'=>0),
        12 => array('prepend'=>'UI','padding'=>3),
        13 => array('prepend'=>'Type','padding'=>3),
        14 => array('prepend'=>'NONE','padding'=>0),
        15 => array('prepend'=>'NONE','padding'=>0),
        16 => array('prepend'=>'NONE','padding'=>0),
        17 => array('prepend'=>'Section ','padding'=>0),
        18 => array('prepend'=>'NONE','padding'=>3),
    );
      
       public static $display = array(
        1 => array('parent'=>'project','url'=>'/project/view/tab/rules'), //rule
        2 => array('parent'=>'project','url'=>'/project/view/tab/forms'), //form
        3 => array('parent'=>'form','url'=>'/form/view/id/#'), //formproperty
        4 => array('parent'=>'project','url'=>'/project/view/tab/actors'), //actor
        5 => array('parent'=>'project','url'=>'/project/view/tab/usecases'), //package
        6 => array('parent'=>'project','url'=>'/project/view/tab/objects/'), //object
        7 => array('parent'=>'object','url'=>'/object/view/id/#'), //objectproperty
        8 => array('parent'=>'usecase','url'=>'/usecase/view/id/#'), //flow
        9 => array('parent'=>'flow','url'=>'/flow/view/id/#'), //step
        10 => array('parent'=>'package','url'=>'/package/view/id/#'), //usecase
        11 => array('parent'=>'project','url'=>'none'), //photo
        12 => array('parent'=>'project','url'=>'/project/view/tab/ifaces'), //iface
        13 => array('parent'=>'interfacetype','url'=>'/interfacetype/view/id/#'), //interfacetype
        14 => array('parent'=>'form','url'=>'none'), //stepform
        15 => array('parent'=>'iface','url'=>'none'), //stepiface
        16 => array('parent'=>'rule','url'=>'none'), //steprule
        17 => array('parent'=>'project','url'=>'/project/view/tab/category'), //category
        18 => array('parent'=>'category','url'=>'/category/view/id/#'),//simple
    );
    
      
    
    public static $actions = array(1 => 'create',
        2 => 'update',
        3 => 'delete');

      public static $action_labels = array(1 => 'Create',
        2 => 'Update',
        3 => 'Delete');
     public static $action_types = array(1 => 'success',
        2 => 'warning',
        3 => 'important');
    
    public function tableName() {
        return 'version';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('number, foreign_id, foreign_key ,release, project_id, status,object, action,create_date, create_user', 'required'),
            array('project_id, foreign_id, foreign_key ,status', 'numerical', 'integerOnly' => true),
            array('number, release', 'length', 'max' => 6),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, number, release, project_id, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {

        return array(
            'rule' => array(self::BELONGS_TO, 'Rule', 'foreign_key'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'number' => 'Number',
            'release' => 'Release',
            'project_id' => 'Project',
            'status' => 'Status',
            'object' => 'Object',
            'action' => 'Action',
            'foreign_key' => 'dbase key of instance',
            'foreign_id' => 'ID of object',
            'active' => 'Active',
            'create_date' => 'create date',
            'create_user' => 'create user',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('number', $this->number, true);
        $criteria->compare('release', $this->release, true);
        $criteria->compare('project_id', $this->project_id);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    
    	public function wikiInput($input,$parent,$parent_id)
	{
	$release=Yii::App()->session['release'];
        $project=Yii::App()->session['project'];
        // get the text.
        $numberstart =  substr_count($input,"[[");
        $numberend =  substr_count($input,"]]");
        $error=TRUE;
        if ($numberstart == $numberend) {
        $error=FALSE;
            $end=array();
        // parse it for wiki syntax.
        $x=0;
        $start=explode("[[", $input);
      
        $end[$x]=$start[0];
        
        for($i=1;$i<=$numberstart;$i++)
        {
        $split =explode("]]",$start[$i]);
        $end[$x+1]=$split[0];
        $end[$x+2]=$split[1];
        $x=$x+2;
        }
       
        $number=count($end);
        $objects=array('IF'=>12,'UI'=>12,'UF'=>2,'OB'=>6,'BR'=>1);
        
        for($i=1;$i<=$number-1;$i=$i+2)
        {
            // test the content of the wiki brackets
            if (substr_count($end[$i],":")==1)// its an existing wiki link
            {
                $content=  explode(":", $end[$i]); // split into two bits
             
                if(in_array($content[0],array('IF','UF','OB','BR','UI')))
                { // the link is partly valid

                 $instance=($content[1]+1)-1;
                 $object=$objects[$content[0]];
                 //$link=$release."_".$object."_".$instance;  
                 $name=Version::model()->instanceName($object,$instance);

                }


                $end[$i]='[['.Version::$code[$object].':'.$instance.']]';


              
            
            }

              if (substr_count($end[$i],"+")==1) // its a create request
            {
                //separate the object code from the new name
                $content=  explode("+", $end[$i]);
                 
                if(in_array($content[0],array('IF','UF','OB','BR','UI')))
                { // the link is partly valid

                 $newName=$content[1];
                 $object=$objects[$content[0]];
                 //  Need a generic create object that returns the instance.
                 
                 $instance=Version::model()->addObject($object,$newName);
                   
                 $name=Version::model()->instanceName($object,$instance);

                }
                
                $end[$i]='[['.Version::$code[$object].':'.$instance.']]';
  
                
                
                
            }
             
              // if the text area belongs to a step, we should hook up the object
                // to that step with a step-thing relationship.
                // we will need to have the parent type passed through at the top.
                if (isset($name) && $parent==9 && $name['name']!='deleted')
                {// this is a valid object
                   $step=Step::model()->findbyPK($parent_id);
                   // This is a step
                    if ($object==1)
                    { //its a rule
                    // see if this rule is already associated with this step.
                    // object=1 so its a steprule, step=parent_id and rule_id=$instance
                    //get all the rules, leaf through them to find this rule
                    $links = Step::model()->getStepLinks($step->step_id, 1, 16);
                    $exist=0;    
                    foreach ($links as $link) 
                         {
                        if ($instance==$link['rule_id']) $exist=1;
                         } 
                    //if its not there add it
                        if($exist==0) 
                        {
                        $model=new Steprule;
                        $model->steprule_id=Version::model()->getNextID(16);
                        $model->project_id= $project;
                        $model->release_id=$release;
                        
                        $model->step_id=$step->step_id;
                        $model->rule_id=$instance;
                     //                             echo "<pre>";
                      //      print_r($model);
                      //      die;
                            $model->save(false);
                        

                        
                        
                        
                        $version=Version::model()->getNextNumber($project,16,1,$model->primaryKey,$model->steprule_id);

                
                        }
                        
                    
                    }
                    if ($object==2)
                    { //its a form
                   
                    $links = Step::model()->getStepLinks($step->step_id, 2, 14);
                    $exist=0;    
                    foreach ($links as $link) 
                         {
                        if ($instance==$link['form_id']) $exist=1;
                         } 
                    //if its not there add it
                        if($exist==0) 
                        {
                        $model=new Stepform;
                        $model->stepform_id=Version::model()->getNextID(14);
                        $model->project_id= $project;
                        $model->release_id=$release;
                        
                        $model->step_id=$step->step_id;
                        $model->form_id=$instance;
                        $model->save(false);
                        $version=Version::model()->getNextNumber($project,14,1,$model->primaryKey,$model->stepform_id);

                
                        }
                    }
                    if ($object==12)
                    { //its an interface
                        // make a stepiface
                    $links = Step::model()->getStepLinks($step->step_id, 12, 15);
                    $exist=0;    
                    foreach ($links as $link) 
                         {
                        if ($instance==$link['iface_id']) $exist=1;
                         } 
                    //if its not there add it
                        if($exist==0) 
                        {
                        $model=new Stepiface;
                        $model->stepiface_id=Version::model()->getNextID(15);
                        $model->project_id= $project;
                        $model->release_id=$release;
                        
                        $model->step_id=$step->step_id;
                        $model->iface_id=$instance;
                        $model->save(false);
                        $version=Version::model()->getNextNumber($project,15,1,$model->primaryKey,$model->stepiface_id);

                
                        }
                    }

                }
            
            
            
        } // end of loop through string
        }
        $result=$input;
        if(!$error) $result=implode(" ",$end);
        
        return $result  ;  
            
    }

    public function wikiOutput($input,$print)
	{
	$release=Yii::App()->session['release'];
        $project=Yii::App()->session['project'];
        // get the text.
        $numberstart =  substr_count($input,"[[");
        $numberend =  substr_count($input,"]]");
        $error=TRUE;
        if ($numberstart == $numberend) {
        $error=FALSE;
        $end=array();
        // parse it for wiki syntax.
        $x=0;
        $start=explode("[[", $input);
      
        $end[$x]=$start[0];
        
        for($i=1;$i<=$numberstart;$i++)
        {
        $split =explode("]]",$start[$i]);
        $end[$x+1]=$split[0];
        $end[$x+2]=$split[1];
        $x=$x+2;
        }
       
        $number=count($end);
        $objects=array('IF'=>12,'UF'=>2,'OB'=>6,'BR'=>1,'UI'=>12);
        
        for($i=1;$i<=$number-1;$i=$i+2)
        {
            // test the content of the wiki brackets
            if (substr_count($end[$i],":")==1)
            {
                $content=  explode(":", $end[$i]);
             
                if(in_array($content[0],array('IF','UF','OB','BR','UI')))
                { // the link is partly valid

                 $instance=($content[1]+1)-1;
                 $object=$objects[$content[0]];
                 //$link=$release."_".$object."_".$instance;  
                 $name=Version::model()->instanceName($object,$instance);
                    if($name['name']!='deleted' && $print==0)
                        {
                    
                           $end[$i]='<a href="'.Yii::app()->getBaseUrl().'/'.Version::$objects[$object].'/view/id/'.$instance.'" data-id="[['.$content[0].':'.$instance.']]" >'.$name['number'].'-'.stripslashes($name['name']).'</a>';
                        
                        }
                    ELSE 
                        {
                            $end[$i]=$name['number'].'-'.$name['name'];
                        }    
                }
            // THis is the human readable one that shows in the view screen
               
            }
            
        } // end of loop through string
        }
        $result=$input;
        if(!$error)$result=implode(" ",$end);
        return $result  ;  
            
    }

           	public function wikiOffset($step_id, $release, $offset)
	{
	
                   $sql="SELECT `s`.*
                        FROM `step` `s`
                        JOIN `version` `vs`
                        ON `vs`.`foreign_key`=`s`.`id`
                        WHERE 
                        `vs`.`object` =9 AND `vs`.`active`=1 AND `vs`.`release`=".$release."  
                        AND
                        `s`.`step_id`=".$step_id;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$step = $command->queryAll();
		
                
        $input[0]=$step[0]['text'];            
        $input[1]=$step[0]['result'];  
        
        for($z=0;$z<=1;$z++)
        {    
                // get the text.
                $numberstart =  substr_count($input[$z],"[[");
                $numberend =  substr_count($input[$z],"]]");
                if ($numberstart != $numberend) $error=TRUE;

                $end=array();
                // parse it for wiki syntax.
                $x=0;
                $start=explode("[[", $input[$z]);

                $end[$x]=$start[0];

                for($i=1;$i<=$numberstart;$i++)
                {
                $split =explode("]]",$start[$i]);
                $end[$x+1]=$split[0];
                $end[$x+2]=$split[1];
                $x=$x+2;
                }

                $number=count($end);

                for($i=1;$i<=$number-1;$i=$i+2)
                {
                    // test the content of the wiki brackets
                    if (substr_count($end[$i],":")==1)
                    {
                        $content=  explode(":", $end[$i]);

                        if(in_array($content[0],array('IF','UF','OB','BR','UI')))
                        { // the link is partly valid

                         $content[1]=$content[1]+$offset;
                        $end[$i]='[['.$content[0].':'.$content[1].']]'; 
                        }

            }
            
        } // end of loop through string
        
        $input[$z]=implode(" ",$end);
        
    
        }       

        $text = str_replace("'", "\'", $input[0]);
        $result =  str_replace("'", "\'", $input[1]);
        $sql="UPDATE `step` `s`
            SET `s`.`text` = '".$text."' ,
                `s`.`result` = '".$result."'
            WHERE `s`.`id` =".$step[0]['id'];
	
                $connection=Yii::app()->db;
                $command = $connection->createCommand($sql);
                $command->execute();
        
        
        
  }
        
    	public function wikiEdit($input)
	{
	// get the text.
        // parse it for wiki links.
        $release=Yii::App()->session['release'];
        $project=Yii::App()->session['project'];
        // get the text.
        $numberstart =  substr_count($input,"[[");
        $numberend =  substr_count($input,"]]");
        if ($numberstart != $numberend) $error=TRUE;
        
        $end=array();
        // parse it for wiki syntax.
        $x=0;
        $start=explode('[["', $input);
      
        $end[$x]=$start[0];
        
        for($i=1;$i<=$numberstart;$i++)
        {
        $split =explode("]]",$start[$i]);
        $linksplit=explode(':',$split[0]);//split the link into link and name
        $objectsplit=explode('_',$linksplit[0]);//split the link into its parts
        
        $end[$x+1]='[['.Version::$code[$objectsplit[1]].':';//object code
        $end[$x+2]=$objectsplit[2].']]';//instance
        $end[$x+3]=$split[1];//text
        
        $x=$x+3;
        }
        
        
        
        
            //get the name and number of the object
            
            
            // substitute the link in to the text.
                $result=implode(" ",$end);
        
        return $result  ;     
            
            
            
	}   
        
        

        
        	public function addObject($object,$name)
	{
                    
            $object_name=Version::$objects[$object];
            $release=Yii::App()->session['project'];
            $release=Release::model()->currentRelease($release);
            
            if($object==12){ // its an interface, so we need the type
                $ifacetypes=  Interfacetype::model()->getInterfacetypes();
                    foreach ($ifacetypes as $ift)
                    {       
                    if ($ift['name']=='Not Classified')$interfacetype_id=$ift['interfacetype_id'];
                    }
            }            
            $model_name=ucfirst($object_name);
                   $model=new $model_name;
                   $model->project_id= Yii::app()->session['project'];
                   $model->release_id=$release;
                   $model->name=$name;
                   $model->number=Version::model()->getMaxNumber($object,$release)+1;
                   $model[$object_name.'_id']=Version::model()->getNextID($object);
                   if ($object==1) $model->text='stub';
                   if ($object==6) $model->description='stub';
                   if ($object==12) $model->interfacetype_id=$interfacetype_id;
                    
                    if($model->save())
                    {
                    $version=Version::model()->getNextNumber($model->project_id,$object,1,$model->primaryKey,$model[$object_name.'_id']);   
                    
                    
                    return $model[$object_name.'_id'];
                    }
                        
                    
                    
                echo 'it did not save<br><pre>';    
                print_r($model);
                echo '</pre>';
                exit;
            
         
            
	}   
        
    public function createInitial($id) {


        $sql = "SELECT `r`.`id`
            FROM `release` `r`
            WHERE 
            `r`.`project_id`=" . $id . "
            ORDER BY
            `r`.`id` DESC
            Limit 0,1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $releases = $command->queryAll();
        $release = $releases[0]['id'];


        $sql = "INSERT INTO `version`(
           `number`, 
           `release`, 
           `project_id`,
           `status`,
           `object`,
           `action`,
           `foreign_key`,
           `foreign_id`,
           `create_user`,

           ) VALUES (
           1,
           " . $release . ",
           " . $id . ",
           1,
           0,
           0,
           " . Yii::app()->user->id . ")";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
    }

    public function getNextNumber($id, $object, $action, $fk, $fid) {
        $release = Yii::App()->session['release'];
        // get THE VERSION LOG NUMBER for this release
        $sql = " SELECT
                     `v`.`number`
                    FROM `version` `v`
                    WHERE 
                    `v`.`release`=" . $release . "
                    ORDER BY
                    `v`.`number` DESC
                    Limit 0,1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $releases = $command->queryAll();
        if (!isset($releases[0]['number'])) {
            $number = '0';
        } ELSE {
            $number = $releases[0]['number'] + 1;
        }

        $sql = "UPDATE `version` 
                SET 
               `active`=0
                WHERE
               `project_id`=" . $id . "
                AND
               `release`=" . $release . "
                AND
               `object`=" . $object . "
                AND
               `foreign_id`=" . $fid;

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
        $active = 1;
        if ($action == 3)
            $active = 0;


        $sql = "INSERT INTO `version`(
              `number`,
              `release`, 
              `project_id`,
              `status`,
              `object`,
              `action`,
              `foreign_key`,
              `foreign_id`,
              `active`,
              `create_date`,
              `create_user`) 
              VALUES
              ('" . $number . "',
                '" . $release . "'
                ," . $id . ",
                1,
                " . $object . ",
                " . $action . ",
                " . $fk . ",
                " . $fid . ",
                " . $active . ",
                now(),
                " . Yii::app()->user->id . "
                )";

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
        $newversion = Yii::app()->db->getLastInsertID();


        $sql = "
               UPDATE `release` `r`
               SET 
               `r`.`number`=FLOOR(`r`.`number`)+(
                SELECT
                ( MAX( `v`.`number`-`r`.`offset`))*0.0001
                FROM `version` `v`
                
                where
                `v`.`release`=" . $release . "
                )
                WHERE
               `r`.`id`=" . $release;

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();

        return $newversion;
    }

    public function instanceName($object,$instance) {
        $release = Yii::App()->session['release'];
        
        if($object!=12 && $object!=10){ // NOT A USECASE OR AN INTERFACE
        
        $sql = "
        SELECT `r`.*
        from `" . Version::$objects[$object] . "` `r`
        JOIN `version` `v`
        ON `v`.`foreign_key`=`r`.`id`
        WHERE 
        `r`.`" . Version::$objects[$object] . "_id`= " . $instance . "
        AND `v`.`active`=1 
        AND `v`.`object`=" . $object . "
        AND `v`.`release`=" . $release ;    
        } ELSE {// this is an interface or a usecase, so needs a two stage query.
         if($object==12) $parent=13;
         if ($object==10) $parent=5;
        
        $sql = "
        SELECT `r`.*,
        `p`.`number` as parentnum 
        from `" . Version::$objects[$object] . "` `r`
        JOIN `" . Version::$objects[$parent] . "` `p`
        ON `r`.`" . Version::$objects[$parent] . "_id`= `p`.`" . Version::$objects[$parent] . "_id`
        JOIN `version` `v`
        ON `v`.`foreign_key`=`r`.`id`
        JOIN `version` `vp`
        ON `vp`.`foreign_key`=`p`.`id`
        WHERE 
        `r`.`" . Version::$objects[$object] . "_id`= " . $instance . "
        AND `v`.`active`=1 
        AND `v`.`object`=" . $object . "
        AND `v`.`release`=" . $release. " 
        AND `vp`.`active`=1 
        AND `vp`.`object`=" . $parent . "
        AND `vp`.`release`=" . $release ;    
        }
        
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $releases = $command->queryAll();
       if (!empty($releases)){
        $name=$releases[0]['name'];
        $number=(isset($releases[0]['number']))?$releases[0]['number']: 0 ;
        $catnum=(isset($releases[0]['parentnum']))?str_pad($releases[0]['parentnum'], 2, "0", STR_PAD_LEFT):''; 

        $prepend=Version::$numberformat[$object]['prepend'];
        $padded=$prepend.'-'.$catnum.str_pad($number, Version::$numberformat[$object]['padding'], "0", STR_PAD_LEFT);
        $result=array('name'=>$name,'number'=>$padded);
       } ELSE {
        $result=array('name'=>'deleted','number'=>'000');   
       }
        return $result;
    }

    
     public function getNextID($object) {
        $sql = "SELECT `r`.`" . Version::$objects[$object] . "_id` as `number`
       From `" . Version::$objects[$object] . "` `r`
       where `r`.`project_id`=" . Yii::App()->session['project'] . "
       ORDER BY `number` DESC
       LIMIT 0,1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $releases = $command->queryAll();
        if (!isset($releases[0]['number'])) {
            $releases[0]['number'] = '1';
        } ELSE {
            $releases[0]['number'] = $releases[0]['number'] + 1;
        }
        return $releases[0]['number'];
    }
    
    
    public function getProjectDeletedVersions($id, $object) {
        $sql = "
        SELECT *
        from `" . Version::$objects[$object] . "` `r`
        WHERE 
        `r`.`project_id`=" . $id . "  
        AND `r`.`" . Version::$objects[$object] . "_id` NOT IN (
        SELECT `x`.`" . Version::$objects[$object] . "_id`
        FROM `" . Version::$objects[$object] . "` `x`
        JOIN `version` `v`
        ON `v`.`foreign_key`=`x`.`id`
        WHERE 
        `v`.`active`=1 and  
        `v`.`object`=" . $object . " and
        `x`.`project_id`=" . $id . " 
        )
                
        GROUP BY `r`.`number`
        ORDER BY `r`.`id` DESC";



        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $releases = $command->queryAll();

        return $releases;
    }

    public function getObjectDeletedVersions($id, $parent, $object) {
        //this is for children of version controlled objects ie forms and objects
        $sql = "
        SELECT *
        from `" . Version::$objects[$object] . "` `r`
        WHERE 
        `r`.`" . Version::$objects[$parent] . "_id`=" . $id . "  
        AND `r`.`" . Version::$objects[$object] . "_id` NOT IN (
        SELECT `x`.`" . Version::$objects[$object] . "_id`
        FROM `" . Version::$objects[$object] . "` `x`
        JOIN `version` `v`
        ON `v`.`foreign_key`=`x`.`id`
        WHERE 
        `v`.`active`=1 and            
        `x`.`" . Version::$objects[$parent] . "_id`=" . $id . " 
        )
                
        GROUP BY `r`.`number`
        ORDER BY `r`.`id` DESC";



        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $releases = $command->queryAll();

        return $releases;
    }

    public function userDestroy($id) {
 

        $sql = "DELETE 
                FROM
                `version`
                WHERE
                `create_user`=".$id;

  $connection=Yii::app()->db;
                $command = $connection->createCommand($sql);
                $command->execute();  
        
    }
      
    public function getReleaseObjectChangelog($release, $object) {
 

        $sql = "SELECT `r`.id
            FROM `" . Version::$objects[$object] . "` `r`
            LEFT JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id` 
            WHERE 
            `v`.`object`=" . $object . "
            AND            
            `v`.`release`=" . $release . "         
            AND            
            `v`.`active`=" . $id;

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $releases = $command->queryAll();
        if (isset($releases[0]['id'])) {
            return $releases[0]['id'];
        } ELSE {
            return 0;
        }
        
    }
    
    public function getVersion($id, $object) {
        $release = Yii::app()->session['project'];
        $release = Yii::app()->session['release'];

        $sql = "SELECT `r`.id
            FROM `" . Version::$objects[$object] . "` `r`
            LEFT JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id` 
            WHERE 
            `v`.`object`=" . $object . "
            AND
            `v`.`active`=1
            AND            
            `v`.`release`=" . $release . "         
            AND            
            `v`.`foreign_id`=" . $id;

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $releases = $command->queryAll();
        if (isset($releases[0]['id'])) {
            return $releases[0]['id'];
        } ELSE {
            return 0;
        }
        
    }

      public function getObject($id, $object) {
       $sql = "SELECT `r`.*
            FROM `" . Version::$objects[$object] . "` `r`
            WHERE 
            `r`.`id`=" . $id;

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $releases = $command->queryAll();

        if(isset($releases[0])) return $releases[0];
    }
    public function renumber($object,$parentid) {
        $parent=Version::$display[$object]['parent'].'_id';
        $sql="SELECT * FROM `".Version::$objects[$object]."` `s`
             WHERE  `s`.`".$parent."`=".$parentid."
                 ORDER BY `s`.`number` ASC";
	
             	$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$releases = $command->queryAll();
                if (count($releases)){
                    $x=0;
                     foreach($releases as $object){
                         $x++;
                $sql="UPDATE `".Version::$objects[$object]."` SET `number`=".$x."
                    WHERE `id`=".$object['id'];
	
                $connection=Yii::app()->db;
                $command = $connection->createCommand($sql);
                $command->execute();      
                         
                }
                }
        
        
    }
            
      public function getChildObjects($id,$object) // $object is the Child object type
    {
          $release=Yii::App()->session['project'];
          $release=Yii::App()->session['release'];
        $sql="
            SELECT 
            `r`.*
            FROM `".Version::$objects[$object]."` `r`
            JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id`
            WHERE 
            `v`.`object`=".$object."
            AND
            `v`.`active`=1
            AND
            `v`.`release`=".$release."
            AND
            `r`.`".Version::$display[$object]['parent']."_id`=".$id." order by `r`.`number`";

     
        
        $connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$releases = $command->queryAll();
		
		return $releases;
    }  
    
    
    public function getVersions($id, $object) {  // Object_id
        $release = Yii::app()->session['release'];
        $sql = "SELECT 
                `r`.*,
                `v`.`id` as versionid,
                `v`.`active`,
                `v`.`number` as ver_numb,
                `v`.`release`,
                `v`.`action`,
                `v`.`create_date`,
                `v`.`create_user`,
                `u`.`firstname`,
                `u`.`lastname`
                FROM `" . Version::$objects[$object] . "` `r`
                
                JOIN `version` `v`
                ON `r`.`id`=`v`.`foreign_key`
                JOIN `user` `u`
                ON `u`.`id`=`v`.`create_user`
               
                WHERE 
                `v`.`object`=" . $object . " AND `v`.`release`=" . $release . "
               
                AND
                `r`.`" . Version::$objects[$object] . "_id`=" . $id . " 
                ORDER BY `v`.`active` DESC,
                ver_numb DESC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $releases = $command->queryAll();

        return $releases;
    }

     public function getMaxVersionNumber($release) {  // Object_id
        $sql = "SELECT 
                `v`.`number`
                FROM  `version` `v`
                WHERE 
                `v`.`release`=" . $release."
                ORDER BY `number` DESC
                LIMIT 0,1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $releases = $command->queryAll();

        return $releases[0]['number'];
    }
    
    
    public function rollback($object_id, $object, $id) 
                {
        $release=Yii::App()->session['release'];
       
        //SET ALL Existing TO INACTIVE
        $sql = "UPDATE `version`
                  Set `active`=0
                  WHERE
                  `object`=" . $object . "
                  AND
                  `foreign_id`=" . $object_id . "
                  AND
                  `release`=" . $release;
        
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();

        // set the rollback entry to be active, and update the user and time.

        $sql = "UPDATE `version`
                  Set active=1,
                  create_date='" . date('Y-m-d h:m:s')  . "',
                  create_user=" . Yii::app()->user->id . "
                  WHERE
                  `id`=" . $id;
               
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
    }

      public function rollbackInactivate($object_id, $object) 
                {
        $release=Yii::App()->session['release'];
       
        //SET ALL Existing TO INACTIVE
        $sql = "UPDATE `version`
                  Set `active`=0
                  WHERE
                  `object`=" . $object . "
                  AND
                  `foreign_id`=" . $object_id . "
                  AND
                  `release`=" . $release;
        
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();

     
    }
    // USed to get the parent UC in the Diff function
     public function getStepObjectParentUC($id,$release,$object)
    {
        $sql="SELECT `u`.*,
            `p`.`number`
            FROM `usecase` `u`
            JOIN `package` `p`
            ON `p`.`package_id`=`u`.`package_id`
            JOIN `flow` `f` 
            ON `f`.`usecase_id`=`u`.`usecase_id`
            JOIN `step` `s`
            ON `f`.`flow_id`=`s`.`flow_id`
            JOIN `".Version::$objects[$object]."` `o`
            ON `o`.`step_id`=`s`.`step_id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id`
            JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`  
            JOIN `version` `vo`
            ON `vo`.`foreign_key`=`o`.`id`  
            JOIN `version` `vp`
            ON `vp`.`foreign_key`=`p`.`id`  
            
            WHERE 
            `o`.`id`=".$id."
            AND 
            `vu`.`object` =10 AND  `vu`.`release`=".$release."
            AND 
            `vs`.`object` =9 AND  `vs`.`release`=".$release."
            AND 
            `vp`.`object` =5 AND  `vp`.`release`=".$release."            
            AND 
            `vo`.`object` =".$object." AND `vo`.`release`=".$release."
            AND
            `vf`.`object` =8 AND  `vf`.`release`=".$release." 
             ORDER BY `vo`.`number` DESC, `vu`.`number` DESC, `vs`.`number` DESC, 
             `vp`.`number` DESC, `vf`.`number` DESC
             LIMIT 1";
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$releases = $command->queryAll();
		if(isset($releases[0])) return $releases[0];
    }
    
       public function getObjectStepObjectParentUC($id,$link,$release,$object)
    {
        $sql="SELECT `u`.*
            FROM `usecase` `u`
            JOIN `flow` `f` 
            ON `f`.`usecase_id`=`u`.`usecase_id`
            JOIN `step` `s`
            ON `f`.`flow_id`=`s`.`flow_id`
            JOIN `step".Version::$objects[$object]."` `l`
            ON `l`.`step_id`=`s`.`step_id`
            JOIN `".Version::$objects[$object]."` `o`
            ON `o`.`".Version::$objects[$object]."_id`=`l`.`".Version::$objects[$object]."_id`
            JOIN `version` `vs`
            ON `vs`.`foreign_key`=`s`.`id`
            JOIN `version` `vf`
            ON `vf`.`foreign_key`=`f`.`id`
            JOIN `version` `vu`
            ON `vu`.`foreign_key`=`u`.`id`  
            JOIN `version` `vl`
            ON `vl`.`foreign_key`=`l`.`id` 
            JOIN `version` `vo`
            ON `vo`.`foreign_key`=`o`.`id`  
            WHERE 
            `o`.`id`=".$id."
            AND 
            `vu`.`object` =10 AND `vu`.`active`=1 AND `vu`.`project_id`=".$release."
            AND 
            `vs`.`object` =9 AND `vs`.`active`=1 AND `vs`.`project_id`=".$release."
            AND 
            `vl`.`object` =".$link." AND `vl`.`active`=1 AND `vl`.`project_id`=".$release."
            AND 
            `vo`.`object` =".$object." AND `vo`.`active`=1 AND `vo`.`project_id`=".$release."
            AND
            `vf`.`object` =8 AND `vf`.`active`=1 AND `vf`.`project_id`=".$release;
		$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$releases = $command->queryAll();
		if(isset($releases[0])) return $releases[0];
    }
    
    public function getParent($object, $id) {
       $sql = "
                  SELECT `x`.`".Version::$display[$object]['parent']."_id` as `id`
                  from
                  `" . Version::$objects[$object] . "` `x`
                  JOIN `version` `v`
                  ON `x`.`id`=`v`.`foreign_key`
                  WHERE
                  `v`.`id`=".$id;

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $releases = $command->queryAll();

        return $releases[0]['id'];
    }

  public function getStepObject($object, $id, $release) {
       $sql = "  
                SELECT `x`.*
                FROM `".Version::$display[$object]['parent']."` `x` 
                JOIN `step".Version::$display[$object]['parent']."` `s`
                ON 
                `s`.".Version::$display[$object]['parent']."_id=`x`.`".Version::$display[$object]['parent']."_id`
                JOIN `version` `v`
                ON `x`.`id` =`v`.`foreign_key`
                WHERE 
                `s`.`id`=".$id."
                AND  
                `v`.`release`=".$release."  
                AND `v`.`active`=1  
                AND `v`.`object`=".Version::$child[$object];


        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $object = $command->queryAll();

        return $object[0];
    }
    
    // getDiffObject usese the object_id to find the current object as opposed to the one above.
    public function getDiffObject($object, $id, $release) {
       $sql = "  
                SELECT `x`.*
                FROM `".Version::$objects[$object]."` `x` 
                JOIN `version` `v`
                ON `x`.`id` =`v`.`foreign_key`
                WHERE 
                `x`.`".Version::$objects[$object]."_id`=".$id."
                AND  
                `v`.`release`=".$release."  
                AND `v`.`active`=1  
                AND `v`.`object`=".$object;


        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $object = $command->queryAll();

        return $object[0];
    }
     public function objectList($object, $release) {

        $sql = "
                  SELECT `x`.* from
                  `" . Version::$objects[$object] . "` `x`
                  JOIN `version` `v`
                  ON `x`.`id`=`v`.`foreign_key`
                  WHERE
                  `v`.`active`=1 
                  AND 
                  `v`.`object`=" . $object . "
                  AND
                  `v`.`release`=" . $release;

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $releases = $command->queryAll();

        return $releases;
    }
    
    
    public function objectCount($object) {
        $release = Yii::App()->session['release'];
        $sql = "
                  SELECT count(`v`.`id`) as number
                  from
                  `version` `v`
                  WHERE
                  `v`.`active`=1 
                  AND 
                  `v`.`object`=" . $object . "
                  AND
                  `v`.`release`=" . $release;

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $releases = $command->queryAll();

        return $releases[0]['number'];
    }

    public function objectChildCount($object,$id) { // the object is child, the id is the parent
        $release = Yii::App()->session['release'];
        $sql = "
                SELECT count(`c`.`id`) as number
                FROM
                ".Version::$objects[$object]." `c`
                JOIN `version` `v`
                ON `v`.`foreign_key`=`c`.`id`
                WHERE `".Version::$display[$object]['parent']."_id`=".$id." 
                AND
                `v`.`active`=1 
                AND 
                `v`.`object`=" . $object . "
                AND
                `v`.`release`=" . $release;

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $releases = $command->queryAll();

        return $releases[0]['number'];
    }
    public function getMaxNumber($object, $release) {

        $sql = "
            SELECT 
            max(`r`.`number`) as number
            FROM `" . Version::$objects[$object] . "` `r`
            LEFT JOIN `version` `v`
            ON `v`.`foreign_key`=`r`.`id` 
            WHERE 
            `v`.`object`=" . $object . "
            AND
            `v`.`active`=1
            AND            
            `v`.`release`=" . $release;

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $releases = $command->queryAll();


        if (!isset($releases[0]['number'])) {
            $releases[0]['number'] = 0;
        } ELSE {
            $releases[0]['number'] = $releases[0]['number'];
        }
        return $releases[0]['number'];
    }

    public function getMaxID($release) {
        $sql = "
                  SELECT max(`v`.`foreign_id`) as number
                  from
                  `version` `v`
                  WHERE
                  `v`.`project_id`=" . $release;

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $releases = $command->queryAll();
        //print_r($releases);
        return $releases[0]['number'];
    }
  public function getLastChange($release) {
        $sql = "
                  SELECT max(`v`.`number`) as number
                  from
                  `version` `v`
                  WHERE
                  `v`.`release`=" . $release;

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $releases = $command->queryAll();
        //print_r($releases);
        return $releases[0]['number'];
    }
    public function importObject($object, $id, $release, $newrelease, $offset, $numberoffset) {
        // this function imports objects and updates their relationships with an offset so
        //objects can be added to an existing project without clashing with existing objects
        $number = 0.1;


        $sql = "
    DROP TEMPORARY TABLE IF EXISTS tmptable_1; 
    CREATE TEMPORARY TABLE tmptable_1
    SELECT *
    FROM " . Version::$objects[$object] . " 
    WHERE id=" . $id . ";
    UPDATE tmptable_1 SET project_id = " . $release . ",
     " . Version::$objects[$object] . "_id = (" . Version::$objects[$object] . "_id)+" . $offset . ",
    release_id=" . $newrelease . ";";

        // now we have to update all the cross references with the offset.

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();

        //SELECT WHAT OBJECT AND WHAT TO UPDATE BY OFFSET
        // echo 'updating '.Version::$objects[$object].' with id '.$id;
        // get an array of the parents
        $sql = '';
        //echo 'this object has these parents '.Version::$parents[$object];
        if (Version::$parents[$object] != 'none' && $offset > 0) {
            $parents = explode(',', Version::$parents[$object]);
            foreach ($parents as $parent) {
                $sql .= " UPDATE tmptable_1 SET " . $parent . "_id = (" . $parent . "_id)+$offset ;";
            }

            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $command->execute();
        }

        //update the number, by picking the highest number so far in the temp table.
        //the first temp transfer will need to know the highest starting number, much like the offset.
        // we should get this first.
        $sql = '';

        if (Version::$number[$object]!='none') {
            $sql .= " UPDATE tmptable_1 SET number = (number)+$numberoffset ;";
//test
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $command->execute();
        }




        // go through the array and form up one big query.
        // for each object type get the array of relationships and update them by the offset.


        $sql = "
    ALTER TABLE  tmptable_1 MODIFY id INT NULL;
    UPDATE tmptable_1 SET id=NULL;
    INSERT INTO " . Version::$objects[$object] . " SELECT * FROM tmptable_1;
    DROP TEMPORARY TABLE IF EXISTS tmptable_1;
    INSERT INTO `version`
    (`number`, 
    `release`, 
    `project_id`, 
    `status`, 
    `object`, 
    `action`, 
    `foreign_key`, 
    `foreign_id`, 
    `active`, 
    `create_date`, 
    `create_user`
    ) VALUES (
    " . $number . ",
    " . $newrelease . ",
    " . $release . ",
    1,
    " . $object . ",
    1,
    LAST_INSERT_ID(),
    ((SELECT `" . Version::$objects[$object] . "_id` FROM " . Version::$objects[$object] . " WHERE id=LAST_INSERT_ID())),
    1,
    now(),
    " . Yii::App()->user->id . "
    )
";



        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();
    }

    
    
    
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
