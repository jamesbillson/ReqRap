
<?php 
echo $this->renderPartial('/project/head'); 

?>

<?php 

if(!empty($model->usecase_id))
    {
    $usecase=Usecase::model()->findbyPK($model->usecase_id);?>
<h4><a href="/usecase/view/id/<?php echo $usecase->usecase_id; ?>"><?php echo $usecase->name; ?></a></h4>

   <?php  }


?>
 	
        
<br>
<?php 
$data=  Teststep::model()->findAll('testcase_id='.$model->id);
/*
$result=Testcaseresult::model()->findbyPK($model->testcaseresult->id);
$new=false;
$running=false;
if($result->status == 1)$new=true;
if($result->status == 2) $running=true;

 * 
 */
?>
Test Status: <?php //echo Testcaseresult::$status[$result->status]; ?>
<?php

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Test Case: '.$model->name,
    'headerIcon' => 'icon-user',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
            
           /*
                array(
                    'class' => 'bootstrap.widgets.TbButton',
                    'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'label'=> 'Start Test Run',
                    'url'=>'/testcase/run/id/'.$model->id,
                    'visible'=>$new,
                    
                      ),
                array(
                    'class' => 'bootstrap.widgets.TbButton',
                    'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'label'=> 'Continue Run',
                    'url'=>'/testcase/run/id/'.$model->id,
                    'visible'=>$running,
                      ),     

            * 
            */
           )
));?>
<table><tr><td>Test Preparation: <?php echo $model->preparation;?></td></tr></table>
           
            
<?php  if (count($data)):?>

        <table class="table">

               <thead>
                <tr>
                    
                    <th>Number</th>
                    <th>Action</th>
                    <th>Result</th>
                    <th></th>
                </tr>
            </thead>
            
            <tbody>
         
            <?php foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                        <?php echo $item['number'];?>
                    </td>

                    <td>   
                        <?php echo Version::model()->wikiOutput($item['action']);?>
                    </td>                  
                                 <td>   
                        <?php echo Version::model()->wikiOutput($item['result']);?>
                    </td>  

                  
                    <td>
                        <a href="/teststep/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                       <?php if(count($data)>1){;?> <a href="/teststep/delete/id/<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete"></i></a> <?php } ?>
                      <a href="/teststep/create/id/<?php echo $item['testcase_id'];?>/step/<?php echo $item['id'];?>"><i class="icon-plus-sign-alt" rel="tooltip" title="Add new step after"></i></a> 
                   
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget(); ?>

