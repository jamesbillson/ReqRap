
<?php 
$release=Yii::App()->session['release'];
$link=$release.'_0_0';
if (!isset($tab)) $tab='testcases';
if ($tab=='details' || $tab=='walkthru') $tab='testcases';
echo $this->renderPartial('/project/head',array('tab'=>$tab,'link'=>$link)); 
if ($tab=='photos') $tab='interfaces';
?>
 
<?php // if this company project owner is current viewer
  
    //$type = Company::model()->findbyPK($mycompany)->type; 
   
     $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;
    $phase=Release::model()->findbyPK($release)->status;
 
?>


<?php $tabs = array()?>

<!-- Setup condition -->
<?php 
$active = array();


$active['testcases']=FALSE;
$active['testruns']=FALSE;


 $active[$tab]=TRUE;
 
   
    $tabs[] = array('id' => 'testcases',
            'label' => 'Test Cases',
        'visible' => ($phase==2),
            'visible' => ($phase==2 && in_array($edit,array(1,2,4,5))),
            'content' => $this->renderPartial('_testcases',
                    compact('model','status','permission'),true,false),'active'=>$active['testcases']); 

    $tabs[] = array('id' => 'testruns',
            'label' => 'Test Runs',
           'visible' => ($phase==2),
            'content' => $this->renderPartial('_testruns',
                    compact('model','status'),true,false),'active'=>$active['testruns']); 
  

?>
<?php  $this->widget('bootstrap.widgets.TbTabs', array(
    'id' => 'mytabs',
    'type' => 'tabs',
    'tabs' => $tabs,
    //'events'=>array('shown'=>'js:loadContent')
)); ?>

<!-- End make tab -->  


