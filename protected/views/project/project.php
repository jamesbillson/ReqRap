
<?php 
if (!isset($tab)) $tab='usecases';
echo $this->renderPartial('/project/head',array('tab'=>$tab)); ?>

 
<?php // if this company project owner is current viewer
  
    //$type = Company::model()->findbyPK($mycompany)->type; 
    $permission=Yii::App()->session['permission'];
    $phase=Yii::App()->session['phase'];
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
$active['followers']=FALSE;
$active['settings']=FALSE;
$active['notes']=FALSE;
$active['todo']=FALSE;


 $active[$tab]=TRUE;

   
    $tabs[] = array('id' => 'details',
            'label' => 'Details',
            'visible' => $owner,
            'content' => $this->renderPartial('_details',
                    compact('model'),true,false),'active'=>$active['details']);
   
    $tabs[] = array('id' => 'documents', 
        'label' => 'Documents',
        'visible' => $owner,
        'content' => $this->renderPartial('_documents',
                compact('model'),true,false),'active'=>$active['documents']);
 
    $tabs[] = array('id' => 'followers', 
        'label' => 'Collaborators', 
        'visible' => $owner,
        'content' => $this->renderPartial('_followers',
                compact('model'),true,false),'active'=>$active['followers']);
    $tabs[] = array('id' => 'settings',
            'label' => 'Settings',
            'visible' => $owner,
            'content' => $this->renderPartial('_settings',
                    compact('model'),true,false),'active'=>$active['settings']);
        $tabs[] = array('id' => 'notes',
            'label' => 'Notes',
            'visible' => $owner,
            'content' => $this->renderPartial('_notes',
                    compact('model'),true,false),'active'=>$active['notes']);
        $tabs[] = array('id' => 'todo',
            'label' => 'To Do',
            'visible' => $owner,
            'content' => $this->renderPartial('_todo',
                    compact('model'),true,false),'active'=>$active['todo']);

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