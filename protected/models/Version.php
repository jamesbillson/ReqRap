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
        12 => 'photo', //iface
        13 => 'none', //interfacetype
        14 => 'step,form', //stepform
        15 => 'step,iface', //stepiface
        16 => 'step,rule', //steprule
        17 => 'none', //category
        18 => 'category'//simple
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
        14 => array('parent'=>'project','url'=>'none'), //stepform
        15 => array('parent'=>'project','url'=>'none'), //stepiface
        16 => array('parent'=>'project','url'=>'none'), //steprule
        17 => array('parent'=>'project','url'=>'/project/view/tab/category'), //category
        18 => array('parent'=>'category','url'=>'/category/view/id/#'),//simple
    );
    
      
    
    public static $actions = array(1 => 'create',
        2 => 'update',
        3 => 'delete');

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
        if ($numberstart != $numberend) $error=TRUE;
        
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
                if ($parent==9 && $name['name']!='deleted')
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
        
        $result=implode(" ",$end);
        
        return $result  ;  
            
    }

       	public function wikiOutput($input)
	{
	$release=Yii::App()->session['release'];
        $project=Yii::App()->session['project'];
        // get the text.
        $numberstart =  substr_count($input,"[[");
        $numberend =  substr_count($input,"]]");
        if ($numberstart != $numberend) $error=TRUE;
        
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
                $end[$i]='<a href="/'.Version::$objects[$object].'/view/id/'.$instance.'">'.$name['number'].'-'.$name['name'].'</a>';
           
                }
// THis is the human readable one that shows in the view screen
               
            }
            
        } // end of loop through string
        
        $result=implode(" ",$end);
        
        return $result  ;  
            
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
            $project=Yii::App()->session['project'];
            $release=Release::model()->currentRelease($project);
            
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
                    $version=Version::model()->getNextNumber($project,$object,1,$model->primaryKey,$model[$object_name.'_id']);   
                    
                    
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
        $projects = $command->queryAll();
        if (!isset($projects[0]['number'])) {
            $number = '0';
        } ELSE {
            $number = $projects[0]['number'] + 1;
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
        $projects = $command->queryAll();
       if (!empty($projects)){
        $name=$projects[0]['name'];
        $number=$projects[0]['number'];
        $catnum=(isset($projects[0]['parentnum']))?str_pad($projects[0]['parentnum'], 2, "0", STR_PAD_LEFT):''; 

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
        $projects = $command->queryAll();
        if (!isset($projects[0]['number'])) {
            $projects[0]['number'] = '1';
        } ELSE {
            $projects[0]['number'] = $projects[0]['number'] + 1;
        }
        return $projects[0]['number'];
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
        $projects = $command->queryAll();

        return $projects;
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
        $projects = $command->queryAll();

        return $projects;
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
        $projects = $command->queryAll();
        if (isset($projects[0]['id'])) {
            return $projects[0]['id'];
        } ELSE {
            return 0;
        }
        
    }
    
    public function getVersion($id, $object) {
        $project = Yii::app()->session['project'];
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
        $projects = $command->queryAll();
        if (isset($projects[0]['id'])) {
            return $projects[0]['id'];
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
        $projects = $command->queryAll();

        return $projects[0];
    }
    public function renumber($object,$parentid) {
        $parent=Version::$display[$object]['parent'].'_id';
        $sql="SELECT * FROM `".Version::$objects[$object]."` `s`
             WHERE  `s`.`".$parent."`=".$parentid."
                 ORDER BY `s`.`number` ASC";
	
             	$connection=Yii::app()->db;
		$command = $connection->createCommand($sql);
		$projects = $command->queryAll();
                if (count($projects)){
                    $x=0;
                     foreach($projects as $object){
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
          $project=Yii::App()->session['project'];
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
		$projects = $command->queryAll();
		
		return $projects;
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
        $projects = $command->queryAll();

        return $projects;
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
        $projects = $command->queryAll();

        return $projects[0]['number'];
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
        $projects = $command->queryAll();

        return $projects[0]['id'];
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
        $projects = $command->queryAll();

        return $projects;
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
        $projects = $command->queryAll();

        return $projects[0]['number'];
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
        $projects = $command->queryAll();

        return $projects[0]['number'];
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
        $projects = $command->queryAll();


        if (!isset($projects[0]['number'])) {
            $projects[0]['number'] = 0;
        } ELSE {
            $projects[0]['number'] = $projects[0]['number'];
        }
        return $projects[0]['number'];
    }

    public function getMaxID($project) {
        $sql = "
                  SELECT max(`v`.`foreign_id`) as number
                  from
                  `version` `v`
                  WHERE
                  `v`.`project_id`=" . $project;

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $projects = $command->queryAll();
        //print_r($projects);
        return $projects[0]['number'];
    }

    public function importObject($object, $id, $project, $newrelease, $offset, $numberoffset) {
        // this function imports objects and updates their relationships with an offset so
        //objects can be added to an existing project without clashing with existing objects
        $number = 0.1;


        $sql = "
    DROP TEMPORARY TABLE IF EXISTS tmptable_1; 
    CREATE TEMPORARY TABLE tmptable_1
    SELECT *
    FROM " . Version::$objects[$object] . " 
    WHERE id=" . $id . ";
    UPDATE tmptable_1 SET project_id = " . $project . ",
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
    " . $project . ",
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
