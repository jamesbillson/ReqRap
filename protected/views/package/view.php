
<a href="/project/view/id/<?php echo $model->project->id; ?>/tab/documents"><h2><?php echo $model->project->name; ?></h2></a>
<h3>PA-<?php echo $model->sequence; ?> <?php echo $model->name; ?></h3>

<br />

<?php


  
$active = array(
    'details'=>false,
    /*'documents'=>false*/
    'usecases'=>false,
    'subbies'=>false,

    $tab=>true
);
 
    $tabs[] = array(
        'id' => 'details', 
        'label' => 'Details', 
        'content' => $this->renderPartial('_details',
            compact('model'),true,false),
        'active'=>$active['details']);

    $tabs[] = array('id' => 'subbies', 
        'label' => 'Followers', 
       
        'content' => $this->renderPartial('_follower',
            compact('model'),true,false),
        'active'=>$active['subbies']);
   $tabs[] = array('id' => 'usecases', 
        'label' => 'Use Cases', 
       
        'content' => $this->renderPartial('_usecases',
            compact('model'),true,false),
        'active'=>$active['usecases']);
   
                  
     
?>

<?php  
$this->widget('bootstrap.widgets.TbTabs', array(
    'id' => 'mytabs',
    'type' => 'tabs',
    'tabs' => $tabs,
    //'events'=>array('shown'=>'js:loadContent')
)); ?>
    
