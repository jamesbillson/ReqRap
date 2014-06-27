<?php echo $this->renderPartial('/project/head'); ?>
<h3>Walkthrough</h3>
    
<?php 
if(!empty($model->usecase_id))
    {
    $usecase=Usecase::model()->findbyPK($model->usecase_id);
    $title=Version::model()->instanceName(10, $usecase->usecase_id);
?>
	
        
<br>
<?php 
$data= Walkthrustep::model()->findAll('walkthrupath_id='.$model->id);

?>
Test Status: <?php //echo Testcaseresult::$status[$result->status]; ?>
<?php

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Walk Through Path: <a href="/usecase/view/id/'.$usecase->usecase_id.'">'.$title['number'].' '.$title['name'].'</a>',
    'headerIcon' => 'icon-check',
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
          
           )
));?>
<table><tr><td>Required Preparation: <?php echo $model->preparation;?></td></tr></table>
           
            
<?php  if (count($data)):?>

        <table class="table">

               <thead>
                <tr>
                    
                    <th>Name</th>
                    <th>Action</th>
                    <th>Result</th>
                </tr>
            </thead>
            
            <tbody>
         
            <?php foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                        <?php echo $item['number'];?>
                    </td>

                    <td>   
                        <?php echo $item['action'];?>
                    </td>                  
                                 <td>   
                        <?php echo $item['result'];?>
                    </td>  

                  
                    <td>
                        <a href="/teststep/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="/teststep/delete?id=<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete"></i></a> 
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget();
    }?>

