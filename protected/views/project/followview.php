<h1><?php echo $model->company->name; ?></h1>
<h2><?php echo $model->name; ?></h2>
(/Project / Follower View)<br />
<br />
<?php

// Need to find the contact related to this user, and therefore the follower.
$rights = Follower::model()->getProjectFollowerDetails($model->id);
//print_r($rights);
$company=User::model()->myCompany();
if ($company ==-1 && $rights['tenderer']==1){ ?>
<div class="well">
    To respond to this tender you will need to <a href="/company/mycreate/">create a company.</a><br />
</div>
        <?php } ?>

<br />



<!-- make tab -->
<?php $tabs = array()?>

<!-- Setup condition -->
<?php 
$active = array();

$active['documents']=FALSE;
$active['tender']=FALSE;
$active['issues']=FALSE;
$active['tasks']=FALSE;
$active[$tab]=TRUE;



 $tabs[] = array('id' => 'documents',
            'label' => 'Documents',
            'content' => $this->renderPartial('_viewFollowDocs',
                    compact('model'),true,true),'active'=>$active['documents']);
   
if ($model->stage==4 && $company!=-1) // Bidding and Has a Company (Builder or PM)
    {
    $tabs[] = array('id' => 'tender',
            'label' => 'Tender Requirements',
            'content' => $this->renderPartial('_viewTenderqs',
                    compact('model'),true,true),'active'=>$active['tender']);
    }
   
      
    $tabs[] = array('id' => 'issues',
            'label' => 'Issues',
            'content' => 'coming soon'); // $this->renderPartial('_viewFollowerIssues', compact('model'),true,true));
        
        
    $tabs[] = array('id' => 'tasks',
            'label' => 'Tasks',
            'content' => 'coming soon'); // $this->renderPartial('_viewFollowerTasks', compact('model'),true,true));
      
    ?>
  

    
    
    <?php  $this->widget('bootstrap.widgets.TbTabs', array(
    'id' => 'mytabs',
    'type' => 'tabs',
    'tabs' => $tabs,
    //'events'=>array('shown'=>'js:loadContent')
)); ?>

