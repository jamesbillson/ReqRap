   
            <?php       
           // print_r($ucDef);
            
           
            ?>
   
<?php


//#######################################################################

class FakeName
{
    public $isNewRecord = false;
    public $primaryKey = 'myid';
    public $myid;
    public $myattr;
 
    public function isAttributeSafe()
    {
        return true;
    }
 
    public function getAttributeLabel()
    {
        return 'Name';
    }
    
    public function getScenario() {
    	return 'update';
    }
}

class FakeDescription
{
    public $isNewRecord = false;
    public $primaryKey = 'myid';
    public $myid;
    public $myattr;
 
    public function isAttributeSafe()
    {
        return true;
    }
 
    public function getAttributeLabel()
    {
        return 'Description';
    }
    
    public function getScenario() {
    	return 'update';
    }
}


class FakeActor
{
    public $isNewRecord = false;
    public $primaryKey = 'myid';
    public $myid;
    public $myattr;
 
    public function isAttributeSafe()
    {
        return true;
    }
    public function getAttribute($attr)
    {
        return $attr;
    }
    public function getAttributeLabel()
    {
        return 'Actor';
    }
    
    public function getScenario() {
    	return 'update';
    }
}



class FakePackage
{
    public $isNewRecord = false;
    public $primaryKey = 'myid';
    public $myid;
    public $myattr;
 
    public function isAttributeSafe()
    {
        return true;
    }
    public function getAttribute($attr)
    {
        return $attr;
    }
    public function getAttributeLabel()
    {
        return 'Package';
    }
    
    public function getScenario() {
    	return 'update';
    }
}


?>

<table class="thumbnail">   
     <tr>
         <td>
           
  <?php           

$title = new FakeName;
$title->myid = 1;
$title->myattr = $ucDef['name'];
 echo '<h4>';
$this->widget(
    'bootstrap.widgets.TbEditableField',
    array(
        'type' => 'text',
        'placement' => 'right',
        'model' => $title,
        'attribute' => 'myattr',
        'url' => 'protoNameSet', //url for submit data
    )
);

echo '</h4></td><td colspan="8">';
$descrip = new FakeDescription;
$descrip->myid = 2;
$descrip->myattr = $ucDef['description'];
 
$this->widget(
    'bootstrap.widgets.TbEditableField',
    array(
        'type' => 'text',
        'model' => $descrip,
        'attribute' => 'myattr',
        'placement' => 'right',
        'url' => 'protoDescriptionSet', //url for submit data
    )
);

?>
             </td>       
            
     </tr>
     <tr>
         <td colspan="3">
            Actor <?php
    $actorselect = new FakeActor;
    $actorselect ->myid = 3;
    $actorselect ->myattr = $ucDef['actor_id'];
             
             $this->widget('editable.EditableField', array(
            'type'      => 'select2',
            'model'     => $actorselect,
            'attribute' => 'myattr',
            'url'       => $this->createUrl('protoActor'), 
            'source'    => Editable::source(Actor::model()->getProjectActors(), 'actor_id', 'name'),
            'placement' => 'right',
    ));
             
             ?>
         </td>
         <td colspan="3">
            Package <?php
    $packageselect = new FakePackage;
    $packageselect ->myid = 4;
    $packageselect ->myattr = $ucDef['package_id'];
             
             $this->widget('editable.EditableField', array(
            'type'      => 'select2',
            'model'     => $packageselect,
            'attribute' => 'myattr',
            'url'       => $this->createUrl('protoPackage'), 
            'source'    => Editable::source(Package::model()->getPackages(), 'package_id', 'name'),
            'placement' => 'right',
    ));
             
             ?>
         </td>
     </tr>
    <?php 
    // $ucDef['flow'][$flowNum]['step'][$stepNum]['rule'][$ruleNum]['name']=$rule['name'];
    // $ucDef['flow'][$flowNum]['step'][$stepNum]['resultname']
    // $ucDef['flow'][$flowNum]['step'][$stepNum]['resulttext']
    if(count($ucDef['flow'])){
     foreach($ucDef['flow'] as $flow) { // LOOP THRU FLOWS

    ?>
   
<tr> 
    <td colspan="4">
      <?php echo $flow['name'];  ?>
    </td>
</tr>
<tr>
               
                <?php   
                foreach($flow['step'] as $step){ 
               $types=array(2=>'warning',12=>'info');
                ?>
        <td valign="middle">
      <a href="#" class="thumbnail" rel="tooltip"
         data-title="<?php echo Version::model()->wikiOutput($step['action'],1);?>">
                <?php 
                $this->widget('bootstrap.widgets.TbBadge', array(
                'type'=>'success',
                'label'=>'Action',
                )); 
             ?>
            </a></td>
            <td valign="middle"><span><i class="icon-arrow-right icon-2x text-info"></i></span></td>
            <td valign="top">
            
            <a href="#" class="thumbnail" style="text-align:center;" rel="tooltip" data-title="<?php  
               echo Version::model()->wikiOutput($step['resulttext'],1);?>">
                  <span style=" text-align:center">
                  <?php if($step['resulttype']==2){ ?>
                  <i class="icon-file-text icon-4x" style="color:#f89406;"></i>
                  <?php }else { ?>
                  <i class="icon-file icon-4x"></i>
                  <?php } ?>
                  <br />
                  <?php  
				  echo $step['resultname'];
                 /*$this->widget('bootstrap.widgets.TbBadge', array(
                'type'=>$types[$step['resulttype']],
                'label'=>$step['resultname'],
                )); */
                 ?> </span> 
               </a>
      
       <?php
        // $ucDef['flow'][$flowNum]['step'][$stepNum]['rule'][$ruleNum]['name']=$rule['name'];
     if (isset($step['rule'])) {
          
      foreach($step['rule'] as $rule){ ?>
      <br>
          <a href="#" class="thumbnail" rel="tooltip" data-title="<?php  
               echo $rule['name'];?>">
            <?php   
                  $this->widget('bootstrap.widgets.TbBadge', array(
                  'label'=>'rule '.$rule['number'],
                  )); 

             ?>
          </a>
            <?php
            }
     }
            ?>  
        </td>             
                <?php     }  ?>
  </tr>   
        <?php  }   }  ?>
        
     
</table> 
   <?php 
   $save=($ucDef['actor_id']!=-1 && $ucDef['package_id']!=-1)?true:false;
   $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Save',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
       'visible'=>$save,
    'url'=>array('project/protoflowsave')
));
      $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Save',
    'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
          'visible'=>!$save,
    'url'=>array('project/prototype')
));
   $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Clear',
    'type'=>'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
       
    'url'=>array('project/protoflowclear')
));

    ?>
 
