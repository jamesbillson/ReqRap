


<h1>My Tenders</h1>

<!-- make tab -->
<?php $tabs = array()?>

<!-- Setup condition -->
<?php 
    //MY Tenders
    
        $tabs[] = array('id' => 'mytenders',
            'label' => 'My Tenders',
            'content' => $this->renderPartial('_mytenders',
                    compact('model'),true,true),'active'=>true);
     
    //Follower Tenders
    
        $tabs[] = array('id' => 'followtenders',
            'label' => 'Tenders I am Following',
            'content' => $this->renderPartial('_followTenders',
                    compact('model'),true,true));
    
   
    
?>
<?php  $this->widget('bootstrap.widgets.TbTabs', array(
    'id' => 'mytabs',
    'type' => 'tabs',
    'tabs' => $tabs,
    //'events'=>array('shown'=>'js:loadContent')
)); ?>