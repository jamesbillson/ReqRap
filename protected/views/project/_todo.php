
<?php

$label=array(
    3=>array('label'=>'final', 'style'=>'success'),
    2=>array('label'=>'core', 'style'=>'warning'),
    1=>array('label'=>'initial', 'style'=>'important'));


// #####################  USE CASES
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
  
}



// ########################## RULES
$stub=0;
$orphan=0;
$stublist='<br />Stub rules: <br />';
$orphanlist='<br />Orphan rules: <br />';
$data = Rule::model()->getProjectRules($model->id);
if (count($data)){
         $rulecount=count($data);
    foreach($data as $item) {
   
        if ($item['text']=='stub') {
            $stub++; 
$stublist.='<a href="/rule/view/id/'.$item['rule_id'].'"> BR-'.str_pad($item['number'], 3, "0", STR_PAD_LEFT).' '.$item['name'].'</a><br />';
        
        }
        $uses=Usecase::model()->getLinkUsecase($item['rule_id'],1,16);
      
        if(count($uses)==0){$orphan++;
        $orphanlist.='<a href="/rule/view/id/'.$item['rule_id'].'"> BR-'.str_pad($item['number'], 3, "0", STR_PAD_LEFT).' '.$item['name'].'</a><br />';

        }
        }
        $stubscore=100-(($stub/$rulecount)*100);
        $orphanscore=100-(($orphan/$rulecount)*100);
        $totalscore=($stubscore+$orphanscore)/2;
        if($totalscore==100 )$state=3;
        if($totalscore>79 && $totalscore<100 )$state=2;
        if($totalscore<=79 )$state=1;
  
}


// ########################## INTERFACES

$ifstublist='<br />Stub interfaces: <br />';
$iforphanlist='<br />Orphan interfaces: <br />';
$ifstub=0;
$iforphan=0;
$ifcount=0;
//$ifstate=1;
$types = Interfacetype::model()->getInterfacetypes();
foreach($types as $type){
$data = Iface::model()->getCategoryIfaces($type['interfacetype_id']);
if (count($data)):
$ifcount=$ifcount+count($data);
    foreach($data as $item){
    if(!count(Iface::model()->getCurrentImage($item['iface_id'],Yii::App()->session['release']))) 
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
      $ifstubscore=100-(($ifstub/$ifcount)*100);
        $iforphanscore=100-(($iforphan/$ifcount)*100);
        $iftotalscore=($ifstubscore+$iforphanscore)/2;
        if($iftotalscore==100 )$ifstate=3;
        if($iftotalscore>79 && $iftotalscore<100 )$ifstate=2;
        if($iftotalscore<=79 )$ifstate=1;
}


// #################### ----------------------  FORMS
$formstublist='<br />Stub forms: <br />';
$formorphanlist='<br />Orphan forms: <br />';

$formstub=0;
$formorphan=0;
$data = Form::model()->getProjectForms(Yii::app()->session['project']);
if (count($data)){
    $formcount=count($data);
  // echo 'Stub forms: <br />';    
        foreach($data as $item):

        $fields=  Formproperty::model()->getFormProperty($item['form_id']);
        if(count($fields)==0) 
            {
            $formstub++;
            $formstublist.='<a href="/form/view/id/'.$item['form_id'].'"> UF-'.str_pad($item['number'], 3, "0", STR_PAD_LEFT).' '.$item['name'].'</a><br />';
            }
                $uses=Usecase::model()->getLinkUsecase($item['form_id'],2,14);
                if(count($uses)==0) 
                    {
                    $formorphan++;
                    $formorphanlist.='<a href="/form/view/id/'.$item['form_id'].'"> UF-'.str_pad($item['number'], 3, "0", STR_PAD_LEFT).' '.$item['name'].'</a><br />';
                    }
        endforeach;
        $formstubscore=100-(($formstub/$formcount)*100);
        $formorphanscore=100-(($formorphan/$formcount)*100);
        $formtotalscore=($formstubscore+$formorphanscore)/2;
        if($formtotalscore==100 )$formstate=3;
        if($formtotalscore>79 && $formtotalscore<100 )$formstate=2;
        if($formtotalscore<=79 )$formstate=1;

}



//##############################                OBJECTS @@
$obstublist='<br />Stub objects: <br />';


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
        

}


//#######################  ACTORS
$actorphanlist='<br />Orphan Actors: <br />';
$actcount=0;
$actorphan=0;
$data = Actor::model()->getProjectActors($model->id);

if (count($data)){
    $actcount=count($data);
    foreach($data as $item) {
       $uses=Actor::model()->getActorParentSteps($item['id']);

       if(count($uses)==0){
           $actorphan++;
           $actorphanlist.='<a href="/actor/view/id/'.$item['actor_id'].'">'.$item['name'].'</a><br />';
           
       }
        }
        $actorphanscore=100-(($actorphan/$actcount)*100);
        $acttotalscore=$actorphanscore;
        if($acttotalscore==100 )$actstate=3;
        if($acttotalscore>79 && $acttotalscore<100 )$actstate=2;
        if($acttotalscore<=79 )$actstate=1;
          

}
$coef=array('UC'=>10,
            'BR'=>5,
            'UI'=>5,
            'UF'=>1,
            'OB'=>1,
            'ACT'=>10,
    );
$projectscore=FLOOR((
        ($ucstate*$coef['UC'])+
        ($state*$coef['BR'])+
        ($ifstate*$coef['UI'])+
        ($formstate*$coef['UF'])+
        ($obstate*$coef['OB'])+
        ($actstate*$coef['ACT'])
        )/32);

echo '<h3>To Do List. (completeness:';
  $this->widget('bootstrap.widgets.TbBadge', array(
    'type'=>$label[$projectscore]['style'], // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>$label[$projectscore]['label'],
    )); 
?>
)</h3>


<?php
 //PRINT OUT SECTION
// #####################  USE CASES

if ($uccount>0){
    echo '<h4>';
        
    $this->widget('bootstrap.widgets.TbBadge', array(
    'type'=>$label[$ucstate]['style'], // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>$label[$ucstate]['label'],
    )); 

  echo ' Use Cases</h4>';
    
echo '<br>'.$ucstub.' of '.$uccount.' stub Usecases, completeness: '.number_format((float)FLOOR(100-($ucstub/$uccount)*100), 0, '.', '').'%';
if ($ucstub>0) echo $ucstublist;

} else {
    echo '<h4>Use Cases</h4>No use cases';
}
?>
<br />


<?php
//#########################   RULES
$stub=0;
$orphan=0;
$stublist='<br />Stub rules: <br />';
$orphanlist='<br />Orphan rules: <br />';
$data = Rule::model()->getProjectRules($model->id);
if ($rulecount>0){

  echo '<h4>';
        
    $this->widget('bootstrap.widgets.TbBadge', array(
    'type'=>$label[$state]['style'], // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>$label[$state]['label'],
    )); 

  echo ' Rules</h4>';

echo $stub.' of '.count($data).' stub Rules, completeness: '.number_format((float)($stubscore), 0, '.', '').'%';
if($stub>0) echo $stublist;
echo '<br>Orphans: '.$orphan.', completeness: '.number_format((float)FLOOR($orphanscore), 0, '.', '').'%';
if($orphan>0) echo $orphanlist;

        } else {
    echo '<h4>Rules</h4>No Rules';
}
?>




<?php

// ########################## INTERFACES


if($ifcount>0){
    
    
    echo '<h4>';
        
    $this->widget('bootstrap.widgets.TbBadge', array(
    'type'=>$label[$ifstate]['style'], // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>$label[$ifstate]['label'],
    )); 

  echo ' Interfaces</h4>';
    
echo '<br>'.$ifstub.' of '.$ifcount.' Interfaces with no images, completeness: '.number_format((float)(100-($ifstub/$ifcount)*100), 0, '.', '').'%';
echo $ifstublist;
echo '<br>Orphans: '.$iforphan.', completeness: '.number_format((float)FLOOR(100-($iforphan/$ifcount)*100), 0, '.', '').'%';
echo $iforphanlist;

} ELSE {
    echo '<h4>Interfaces</h4>No Interfaces';
}
?>


<?php
// #################### ----------------------  FORMS
if ($formcount>0)
    {

 echo '<h4>';
        
    $this->widget('bootstrap.widgets.TbBadge', array(
    'type'=>$label[$formstate]['style'], // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>$label[$formstate]['label'],
    )); 

  echo ' Forms</h4>';
echo '<br>'.$formstub.' of '.count($data).' stub Forms, completeness: '.number_format((float)(100-($formstub/count($data))*100), 0, '.', '').'%';
if($formstub>0) echo $formstublist;
echo '<br>Orphans: '.$formorphan.', completeness: '.number_format((float)FLOOR(100-($formorphan/count($data))*100), 0, '.', '').'%';
if($formorphan>0) echo $formorphanlist;
} else {
    
    echo '<h4>Forms</h4>No Forms';
}



?>



<?php

//##############################                OBJECTS @@

if ($objectcount>0){
   echo '<h4>';
        
    $this->widget('bootstrap.widgets.TbBadge', array(
    'type'=>$label[$obstate]['style'], // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>$label[$obstate]['label'],
    )); 

  echo ' Objects</h4>';
echo '<br>'.$obstub.' of '.count($data).' stub Objects, completeness: '.number_format((float)(100-($obstub/count($data))*100), 0, '.', '').'%';
if($obstub>0) echo $obstublist;
        

} else {
    
    echo '<h4>Objects</h4>No Forms';
}

?>





<?php

//#######################  ACTORS

 if ($actcount>0){
           
   echo '<h4>';
        
    $this->widget('bootstrap.widgets.TbBadge', array(
    'type'=>$label[$actstate]['style'], // 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>$label[$actstate]['label'],
    ));       
        
        
echo ' Actors</h4> Orphans: '.$actorphan.', completeness: '.number_format((float)FLOOR(100-($actorphan/$actcount)*100), 0, '.', '').'%';
if($actorphan>0) echo $actorphanlist;

       } else {
    echo '<h4>Actors</h4>No Actors';
}
?>