
<?php 
echo $this->renderPartial('/project/head',array('tab'=>'usecases')); ?>

 
<?php // if this company project owner is current viewer
  
    //$type = Company::model()->findbyPK($mycompany)->type; 
    $permission=Yii::App()->session['permission'];
    $totalstages=0;
    $status = array('invited','confirmed');
    $owner=($permission==1)? True : False;
?>



<!-- make tab -->
<?php $tabs = array()?>

<!-- Setup condition -->
<?php 
$active = array();
$active['details']=FALSE;
$active['documents']=FALSE;
$active['objects']=FALSE;
$active['category']=FALSE;
$active['packages']=FALSE;
$active['actors']=FALSE;
$active['followers']=FALSE;
$active['rules']=FALSE;
$active['interfaces']=FALSE; 
$active['usecases']=FALSE;
$active['forms']=FALSE;
$active['followers']=FALSE;
$active['testcases']=FALSE;

 $active[$tab]=TRUE;

   
    $tabs[] = array('id' => 'details',
            'label' => 'Details',
            'visible' => $owner,
            'content' => $this->renderPartial('_details',
                    compact('model'),true,true),'active'=>$active['details']);
   
    $tabs[] = array('id' => 'documents', 
        'label' => 'Documents',
        'visible' => $owner,
        'content' => $this->renderPartial('_documents',
                compact('model'),true,true),'active'=>$active['documents']);
 
    $tabs[] = array('id' => 'followers', 
        'label' => 'Collaborators', 
        'visible' => $owner,
        'content' => $this->renderPartial('_followers',
                compact('model'),true,true),'active'=>$active['followers']);
    $tabs[] = array('id' => 'category', 
        'label' => 'Sections', 
        'content' => $this->renderPartial('_category',
                compact('model'),true,true),'active'=>$active['category']);
    
    $tabs[] = array('id' => 'objects', 
        'label' => 'Objects', 
        'content' => $this->renderPartial('_objects',
                compact('model'),true,true),'active'=>$active['objects']);
    
    $tabs[] = array('id' => 'actors',
            'label' => 'Actors',
            'content' => $this->renderPartial('_actors',
                    compact('model','status'),true,true),'active'=>$active['actors']);
/*
    $tabs[] = array('id' => 'package',
            'label' => 'Packages', 
            'content' => $this->renderPartial('_packages',
                    compact('model'),true,true),'active'=>$active['packages']);
 */
    $tabs[] = array('id' => 'usecases',
            'label' => 'Use Cases',
            'content' => $this->renderPartial('_usecases',
                    compact('model','status'),true,true),'active'=>$active['usecases']);
    
    $tabs[] = array('id' => 'rules',
            'label' => 'Rules',
            'content' => $this->renderPartial('_rules',
                    compact('model','status'),true,true),'active'=>$active['rules']);

    $tabs[] = array('id' => 'forms',
            'label' => 'Forms',
            'content' => $this->renderPartial('_forms',
                    compact('model','status'),true,true),'active'=>$active['forms']);
    
    $tabs[] = array('id' => 'interfaces',
            'label' => 'Interfaces',
            'content' => $this->renderPartial('_interfaces',
                    compact('model','status'),true,true),'active'=>$active['interfaces']);

 
       $tabs[] = array('id' => 'testcases',
            'label' => 'Test Cases',
            'content' => $this->renderPartial('_testcases',
                    compact('model','status'),true,true),'active'=>$active['testcases']); 

    
?>
<?php  $this->widget('bootstrap.widgets.TbTabs', array(
    'id' => 'mytabs',
    'type' => 'tabs',
    'tabs' => $tabs,
    //'events'=>array('shown'=>'js:loadContent')
)); ?>

<!-- End make tab -->  
<script  type="text/javascript">
    jQuery(document).ready(function(){
      jQuery('h3 a.btn-small').each(function(){
          jQuery(this).parent().after('<div class="formadd"></div>');
      });
      jQuery('h3 a.btn-small').click(function(){
          jQuery(this).parent().next().load(this.href);
          return false;
      });
    });
</script>