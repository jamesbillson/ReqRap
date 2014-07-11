<?php $tabs = array()?>

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


 $active[$tab]=TRUE;

      $tabs[] = array('id' => 'structure',
         'label' => 'Structure',
        'visible' => in_array($permission,array(5)),
        'content' => $this->renderPartial('_structure',
         compact('model','status','permission'),true,false),'active'=>$active['structure']); 
      
  $tabs[] = array('id' => 'category', 
        'label' => 'Sections', 
        'visible' => in_array($permission,array(5)),
        'content' => $this->renderPartial('_vcategory',
                compact('model','permission'),true,false),'active'=>$active['category']);
    
    $tabs[] = array('id' => 'objects', 
        'label' => 'Objects', 
        'visible' => in_array($permission,array(5)),
        'content' => $this->renderPartial('_vobjects',
                compact('model','permission'),true,false),'active'=>$active['objects']);
    
    $tabs[] = array('id' => 'actors',
            'label' => 'Actors',
        'visible' => in_array($permission,array(5)),
            'content' => $this->renderPartial('_vactors',
                    compact('model','status','permission'),true,false),'active'=>$active['actors']);

    $tabs[] = array('id' => 'usecases',
            'label' => 'Use Cases','visible' => in_array($permission,array(5)),
            'content' => $this->renderPartial('_vusecases',
                    compact('model','status','permission'),true,false),'active'=>$active['usecases']);
    
    $tabs[] = array('id' => 'rules',
            'label' => 'Rules',
        'visible' => in_array($permission,array(5)),
            'content' => $this->renderPartial('_vrules',
                    compact('model','status','permission'),true,false),'active'=>$active['rules']);

    $tabs[] = array('id' => 'forms',
            'label' => 'Forms',
        'visible' => in_array($permission,array(5)),
            'content' => $this->renderPartial('_vforms',
                    compact('model','status','permission'),true,false),'active'=>$active['forms']);
    
    $tabs[] = array('id' => 'interfaces',
            'label' => 'Interfaces',
        'visible' => in_array($permission,array(5)),
            'content' => $this->renderPartial('_vinterfaces',
                    compact('model','status','permission'),true,false),'active'=>$active['interfaces']);
  
   

?>
<?php  $this->widget('bootstrap.widgets.TbTabs', array(
    'id' => 'mytabs',
    'type' => 'tabs',
    'tabs' => $tabs,
    //'events'=>array('shown'=>'js:loadContent')
)); ?>

<!-- End make tab -->  
