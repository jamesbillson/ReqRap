<?php 
$link=Yii::App()->session['release'].'_1_'.$model->rule_id;
echo $this->renderPartial('/project/head',array('tab'=>'rules','link'=>$link));

 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;
?>

 

<h2>Business Rule BR-<?php echo str_pad($model->number, 3, "0", STR_PAD_LEFT); ?></h2>
  
        
            <?php 
    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => $model->name,
    'headerIcon' => 'icon-cogs',
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
              'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButton',
                    'type' => 'link', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'icon'=> 'edit',
                    'visible'=>$edit,
                    'url'=>'/rule/update/id/'.$model->id,
                    
                      ),
   
                  
)
)); 
   ?>

        <table class="table">
            <tbody>
                <tr>
       
                    <td>
                       <?php echo CHtml::encode($model->text); ?>
                    </td>
                </tr>
            </tbody>
        </table>

    <?php $this->endWidget();  ?>


       <h4>Traceability</h4>
        
        <?php 
 //$steprule=(Steprule::model()->findAll('rule_id='.$model->rule_id));
 $steprule=Usecase::model()->getLinkUsecase($model->rule_id,1,16);
 if(!count($steprule)){
  
 ?>
       <div class="row offset1">
 This Rule is an orphan, it is not used by any Use Case.
       </div>
 <div class="row">

     <?php  echo $this->renderPartial('_associate',array('id'=>$model->rule_id)); ?>
 </div>
 <br />
 <?php } ELSE { ?>
 Interface is used in the following UC's:<br />
   <?php foreach($steprule as $item){?>
 <a href="/usecase/view/id/<?php echo $item['usecase_id'];?>">
       <?php  echo 'UC-'.str_pad($item['package_number'], 2, "0", STR_PAD_LEFT).
         str_pad($item['usecase_number'], 3, "0", STR_PAD_LEFT);?>
 </a>
         <?php echo $item['usecase_name'];?> 
         (<a href="/step/update/id/-1/flow/<?php echo $item['flow_id'];?>"><?php echo $item['flow_name'];?> Flow</a>)
           
         <br />
 <?php } ?>
 <?php } ?>
    
<h3>Version History</h3>    
        
   
        <?php $collapse = $this->beginWidget('bootstrap.widgets.TbCollapse'); ?>
   <?php if (count($versions)){?>
        <?php foreach($versions as $item) {?>   
<div class="accordion-group">
        <div class="accordion-heading">
            <table>
                <tr>
                    <td>
                <?php if ($item['active'] != 1 && $item['action']!=3){    ?> 
                <a href="/version/rollback/id/<?php echo $item['versionid'];?>"><i class="icon-repeat" rel="tooltip" data-placement="right" name="Roll Back to this Version"></i></a> 
                <?php  } ELSE { ?> 
                <i class="icon-circle-arrow-right" rel="tooltip" data-placement="right" name="Current Version"></i> 
                <?php   } ?>  
               </td>
               <td>
                <a class="accordion-toggle" data-toggle="collapse"
               data-parent="#accordion<?php echo $item['ver_numb']; ?>" href="#collapse<?php echo $item['ver_numb']; ?>">
                Change #<?php echo $item['ver_numb']; ?> </a>
                </td>
                <td>
            
                <?php echo $item['create_date']; ?> 
                <?php echo $item['firstname'].' '.$item['lastname']; ?> 
                </td>
                <td> 
                Action:  <?php echo Version::$actions[$item['action']]; ?>   
                </td>
                </tr>
            </table>   
        </div>
        <div id="collapse<?php echo $item['ver_numb']; ?>" class="accordion-body collapse">
            <div class="accordion-inner">
                <strong><?php echo $item['name']; ?></strong><br />
                   <?php echo $item['text']; ?>
            </div>
        </div>
    </div>
  <?php } } ?>
<?php $this->endWidget(); ?>

