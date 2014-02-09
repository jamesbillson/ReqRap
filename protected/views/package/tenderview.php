<?php //PACKAGE / VIEW ?>
Follower View
<h1><?php echo $model->project->company->name; ?></h1>
 <h2><?php echo $model->project->name; ?></h2>
 <h3><?php echo $model->number; ?> <?php echo $model->name; ?></h3>



OK, you are bidding on this package, well done.
<br>
I should be able to see tabs with the tender requirements etc

<!-- make tab -->
<?php $tabs = array()?>

<!-- Setup condition -->


<?php
 
$active = array();


$active['documents']=FALSE;
$active['bidder']=FALSE;


 $active[$tab]=TRUE;
 

         
        $tabs[] = array('id' => 'documents', 
        'label' => 'Documents', 
        'content' => $this->renderPartial('_documents',
                compact('model'),true,true),'active'=>$active['documents']);

        //condition tender - show the Requirements
   
        $tabs[] = array('id' => 'bidder',
            'label' => 'Tender Requirements',
            'content' => $this->renderPartial('_viewTenderqs',
                    compact('model'),true,true),'active'=>$active['bidder']);
   

 
    
 $this->widget('bootstrap.widgets.TbTabs', array(
    'id' => 'mytabs',
    'type' => 'tabs',
    'tabs' => $tabs,
    //'events'=>array('shown'=>'js:loadContent')
)); ?>

<!-- End make tab -->  
    