
<h3>Project: <a href="/project/view/tab/objects/id/<?php echo $model->project->id; ?>"><?php echo $model->project->name; ?></a></h3>
<?php 

if(!empty($model->usecase_id))
    {
    $usecase=Usecase::model()->findbyPK($model->usecase_id);?>
<h4><a href="/usecase/view/id/<?php echo $usecase->id; ?>"><?php echo $usecase->name; ?></a></h4>

   <?php  }


?>
 	
        
<br>
<?php 
$data=  Teststep::model()->findAll('testcase_id='.$model->id);


$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Test Case: '.$model->name,
    'headerIcon' => 'icon-user',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButton',
                    'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'label'=> 'Run this Test Case',
                    'url'=>'/testcase/run/id/'.$model->id,
                    
                      ),
     
)
));?>
<table><tr><td>Test Preparation: <?php echo $model->preparation;?></td></tr></table>
           
            
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
$this->endWidget(); ?>

