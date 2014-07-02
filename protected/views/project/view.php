
<?php 
$release=Yii::App()->session['release'];
$link=$release.'_0_0';
if (!isset($tab)) $tab='usecases';
if ($tab=='details' || $tab=='walkthru') $tab='usecases';
echo $this->renderPartial('/project/head',array('tab'=>$tab,'link'=>$link)); 
if ($tab=='photos') $tab='interfaces';
?>
 
<?php // if this company project owner is current viewer
  
    //$type = Company::model()->findbyPK($mycompany)->type; 
    $permission=Yii::App()->session['permission'];
    $phase=Release::model()->findbyPK($release)->status;
    //$totalstages=0;
   // $status = array('invited','confirmed');
    //$owner=($permission==1)? True : False;
if ($permission==1 ) $this->renderPartial('_contributor',compact('model','permission','tab','phase'));
if ($permission==3 ) $this->renderPartial('_approver',compact('model','permission','tab','phase'));
if ($permission==2 ) $this->renderPartial('_tester',compact('model','permission','tab','phase'));

?>



<!-- make tab -->
<?php /*
 $tabs = array()?>

<!-- Setup condition -->
<?php 
$active = array();

$active['objects']=FALSE;
$active['category']=FALSE;
$active['packages']=FALSE;
$active['actors']=FALSE;
$active['followers']=FALSE;
$active['rules']=FALSE;
$active['interfaces']=FALSE; 
$active['usecases']=FALSE;
$active['forms']=FALSE;
$active['structure']=FALSE;
$active['testcases']=FALSE;
$active['testruns']=FALSE;
$active['walkthru']=FALSE;

 $active[$tab]=TRUE;

     $tabs[] = array('id' => 'category', 
        'label' => 'Sections', 
        'visible' => in_array($permission,array(1)),
        'content' => $this->renderPartial('_category',
                compact('model'),true,false),'active'=>$active['category']);
    
    $tabs[] = array('id' => 'objects', 
        'label' => 'Objects', 
        'visible' => in_array($permission,array(1)),
        'content' => $this->renderPartial('_objects',
                compact('model'),true,false),'active'=>$active['objects']);
    
    $tabs[] = array('id' => 'actors',
            'label' => 'Actors',
        'visible' => in_array($permission,array(1)),
            'content' => $this->renderPartial('_actors',
                    compact('model','status'),true,false),'active'=>$active['actors']);

    $tabs[] = array('id' => 'usecases',
            'label' => 'Use Cases','visible' => in_array($permission,array(1)),
            'content' => $this->renderPartial('_usecases',
                    compact('model','status'),true,false),'active'=>$active['usecases']);
    
    $tabs[] = array('id' => 'rules',
            'label' => 'Rules',
        'visible' => in_array($permission,array(1)),
            'content' => $this->renderPartial('_rules',
                    compact('model','status'),true,false),'active'=>$active['rules']);

    $tabs[] = array('id' => 'forms',
            'label' => 'Forms',
        'visible' => in_array($permission,array(1)),
            'content' => $this->renderPartial('_forms',
                    compact('model','status'),true,false),'active'=>$active['forms']);
    
    $tabs[] = array('id' => 'interfaces',
            'label' => 'Interfaces',
        'visible' => in_array($permission,array(1)),
            'content' => $this->renderPartial('_interfaces',
                    compact('model','status'),true,false),'active'=>$active['interfaces']);
    
  
    $tabs[] = array('id' => 'category', 
        'label' => 'Sections', 
        'visible' => in_array($permission,array(2,3,4,5)),
        'content' => $this->renderPartial('_vcategory',
                compact('model'),true,false),'active'=>$active['category']);
    
    $tabs[] = array('id' => 'objects', 
        'label' => 'Objects', 
        'visible' => in_array($permission,array(2,3,4,5)),
        'content' => $this->renderPartial('_vobjects',
                compact('model'),true,false),'active'=>$active['objects']);
    
    $tabs[] = array('id' => 'actors',
            'label' => 'Actors',
        'visible' => in_array($permission,array(2,3,4,5)),
            'content' => $this->renderPartial('_vactors',
                    compact('model','status'),true,false),'active'=>$active['actors']);

    $tabs[] = array('id' => 'usecases',
            'label' => 'Use Cases','visible' => in_array($permission,array(1,2,3,4,5)),
            'content' => $this->renderPartial('_vusecases',
                    compact('model','status'),true,false),'active'=>$active['usecases']);
    
    $tabs[] = array('id' => 'rules',
            'label' => 'Rules',
        'visible' => in_array($permission,array(2,3,4,5)),
            'content' => $this->renderPartial('_vrules',
                    compact('model','status'),true,false),'active'=>$active['rules']);

    $tabs[] = array('id' => 'forms',
            'label' => 'Forms',
        'visible' => in_array($permission,array(2,3,4,5)),
            'content' => $this->renderPartial('_vforms',
                    compact('model','status'),true,false),'active'=>$active['forms']);
    
    $tabs[] = array('id' => 'interfaces',
            'label' => 'Interfaces',
        'visible' => in_array($permission,array(2,3,4,5)),
            'content' => $this->renderPartial('_vinterfaces',
                    compact('model','status'),true,false),'active'=>$active['interfaces']);
    
    $tabs[] = array('id' => 'structure',
            'label' => 'Structure',
        'visible' => in_array($permission,array(1)),
      
            'content' => $this->renderPartial('_structure',
                    compact('model','status'),true,false),'active'=>$active['structure']); 
 
    $tabs[] = array('id' => 'testcases',
            'label' => 'Test Cases',
        'visible' => ($phase==2),
            'visible' => ($phase==2 && in_array($permission,array(1,2,4,5))),
            'content' => $this->renderPartial('_testcases',
                    compact('model','status'),true,false),'active'=>$active['testcases']); 

    $tabs[] = array('id' => 'testruns',
            'label' => 'Test Runs',
           'visible' => ($phase==2),
            'content' => $this->renderPartial('_testruns',
                    compact('model','status'),true,false),'active'=>$active['testruns']); 
    $tabs[] = array('id' => 'walkthru',
            'label' => 'Walkthru',
            'visible' => ($phase==2 && in_array($permission,array(1,2,3))),
            'content' => $this->renderPartial('_walkthru',
                    compact('model'),true,false),'active'=>$active['walkthru']);

?>
<?php  $this->widget('bootstrap.widgets.TbTabs', array(
    'id' => 'mytabs',
    'type' => 'tabs',
    'tabs' => $tabs,
    //'events'=>array('shown'=>'js:loadContent')
)); 


*/?>

