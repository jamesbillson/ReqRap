<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>



    <h3>Documents</h3>


      
    <?php 

$rights = Follower::model()->getProjectFollowerDetails($model->id);
$upload = $rights['upload'];
if($upload==1){ // THIS FOLLOWER HAS UPLOAD RIGHTS
$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Documents',
	'headerIcon' => 'icon-book',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
        'headerButtons' => array(
	array(
		'class' => 'bootstrap.widgets.TbButton',
		'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		'label'=> 'Add Document',
            'url'=>'/document/create?id='.$model->project->id,
	),))); 
 }
 ELSE
 { // THIS USER IS VIEWER ONLY
 $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Documents',
	'headerIcon' => 'icon-book',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
      ));     
 }
 
 //echo 'checking for '.$model->project->company->name.' id: '.$model->project->company->id;
 
 $types = Documenttype::model()->findAll('company_id='.$model->project->company->id);
 if (count($types)):
     ?>
 <table class="table">
	<thead>
	<tr>
		<th>Name</th>
		 <th>Description</th>
                 <th>Version</th>
               
                <th>Actions</th>

	</tr>
	</thead>
         <?php
     foreach($types as $type){
      $data = Document::model()->getDocs($model->project->id,$type['id']);
 ?>

                <?php
if (count($data)):?>


        <tbody>
             <tr class="even">  
                    <td colspan="4">   
                        <?php echo $type['name'];?>
                    </td>
                 
                </tr>

        <?php foreach($data as $item) {?>
        <tr class="odd">  
        <td>   
        <?php echo $item['name'];?>
        </td>
     <td>   
        <?php echo $item['description'];?>
        </td>
        
          <td>   
        <?php echo $item['version'];?>
        </td>


        
              

      <td>
                   <a href="/document/view/id/<?php echo $item['docid'];?>"><i class="icon-eye-open" rel="tooltip" title="View Document History"></i></a> 
            
                   <?php if($upload==1){ ?>
                   <a href="/documentversion/create/id/<?php echo $item['docid'];?>"><i class="icon-upload" rel="tooltip" title="Upload New Version"></i></a> 
                   <?php } ?>
                 
            
            </td>
        </tr>
       <?php }
       endif;
     }?>
   	</tbody>
</table>

<?php
endif;
$this->endWidget();
   ?>
    