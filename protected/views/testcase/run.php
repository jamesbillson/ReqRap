
<h3>Project: <a href="/project/view/tab/objects/id/<?php echo $model->project->id; ?>"><?php echo $model->project->name; ?></a></h3>
<?php 

if(!empty($model->usecase_id))
    {
    $usecase=Usecase::model()->findbyPK($model->usecase_id);?>
<?php if(!empty($teststep_id)) ;?>
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
                    'label'=> 'Re-Run this Test Case',
                    'url'=>'/testcase/rerun/id/'.$model->id,
                    
                      ),
     
)
));?>
<table>
<tr><td>Test Preparation: <?php echo $model->preparation;?></td></tr>
<tr><td><?php if ($complete==1){?>
        <?php if ($pass==1) echo 'PASS'; ELSE echo 'FAIL';?>
   <?php if ($block==1) echo ' - Test Case is BLOCKED';?>
        <?php   } ?> 
    <?php if(!empty($teststep_id)){
        $lasttest=  Testresult::model()->find('teststep_id='.$laststep) ;
     ?>
        <br /><?php echo 'Latest Test Run: '.$lasttest->testrun->number;?> <br />
         <?php echo 'Last Test Date: '.$lasttest->date;?> <br />
 
      
    <?php   } ?>  
    </td></tr>
</table>
        
            
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
                       
                          <?php if($teststep_id>$item['id']) { ?>
                
                    <?php    $testresult=  Testresult::model()->find(array(
                                      'condition'=>'testrun_id=:x AND teststep_id=:y',
                                      'params'=>array(':x'=>$testrun,':y'=>$item['id']))); ?>
                        <?php echo Testresult::$testresult[$testresult->result];?>
                        <br />
                            <?php  echo $testresult->comments;?>                        


                        <?php   } ?>
                        <?php if($teststep_id==$item['id'] && $complete==0) { ?>
                  
                                   <div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'testresult-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($newresult); ?>
	<?php echo $form->hiddenField($newresult,'teststep_id',array('value'=>$teststep_id)); ?>
	<?php echo $form->hiddenField($newresult,'testrun_id',array('value'=>$testrun)); ?>
        <div class="row">
	
		<?php echo $form->dropDownList($newresult,'result',  Testresult::$testresult); ?>
	
	</div>

	<div class="row">
		<?php echo $form->labelEx($newresult,'comments'); ?>
		<?php echo $form->textArea($newresult,'comments',array('rows'=>6, 'cols'=>50,'value'=>'none')); ?>

	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($newresult->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>      
                           
                     <?php   } ?>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget(); ?>

