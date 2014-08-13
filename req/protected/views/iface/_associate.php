<?php
/* @var $this IfaceController */
/* @var $model Iface */
/* @var $form CActiveForm */


$usecases = CHtml::listData(Usecase::model()->getProjectUCs(),'usecase_id','name');
$ucid=-1;
$stepid=-1;
?>
<div class="row span6 offset1">

    <div class="form">
    
    <form method="POST" action="/stepiface/associate">
   	<div class="row">
            <p>Usecase</p>
            
        <?php           echo CHtml::dropDownList('usecase_id',$ucid,$usecases, 
			array('empty' => 'Select Usecase',
			'ajax' => array(
			'type'=>'POST', //request type
			'url'=>CController::createUrl('/usecase/dynamicsteps'), //url to call.
			'update'=>'#step_id', //selector to update
			))); 
	   if($ucid==-1)
            {
                $steps=array();
            }
            else {
    
                $steps=CHtml::listData(Steps::model()->getSteps($ucid),'id','name');
     
            }?></p>
        </div>
      
         <div class="row">
           <p>Step</p>
            <?php 	echo CHtml::dropDownList('step_id',$stepid, $steps,
			array('empty' => 'Select Step',
	            )
              ); 
	 ?> 
           <input type="hidden" name="iface" value="<?php echo $id;?>">
        </div>
        
	<div class="row buttons">
            <input type="submit">
            </form>
	</div>
</div>



</div><!-- form -->

