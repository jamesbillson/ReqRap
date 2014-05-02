<?php 
echo $this->renderPartial('/project/head',array('tab'=>'rules'));

$permission=(Yii::App()->session['permission']==1)?true : false; 
?>
<h2>Actor <?php echo $model->name; ?>     

    <a href="/actor/update/id/<?php echo $model->id;?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
           </h2>
<a href="/project/view/tab/actors/">Back to Actors</a><br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('name')); ?>:</b>
        <br />
	<?php echo CHtml::encode($model->name); ?>
	<br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('description')); ?>:</b>
	<br />
            <?php echo CHtml::encode($model->description); ?>
        <br />
<b><?php echo CHtml::encode($model->getAttributeLabel('pretest')); ?>:</b>
	<br />
            <?php echo CHtml::encode($model->pretest); ?>

        <h4>Traceability</h4>
<?php 
$permission=(Yii::App()->session['permission']==1)?true : false; 
$data = Actor::model()->getActorParentSteps($model->id);
if (count($data)){
$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Uses',
    'headerIcon' => 'icon-film',
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
)); 
    if (count($data)):?>

        <table class="table">
            <thead>
                <tr>
                    
                    <th>Usecase</th>
                   
                    
                    
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                        <a href="/usecase/view/id/<?php echo $item['usecaseid'];?>">UC-<?php echo str_pad($item['packagenumber'], 2, "0", STR_PAD_LEFT); ?><?php echo str_pad($item['usecasenumber'], 3, "0", STR_PAD_LEFT); ?></a>
 <?php echo $item['usecasename'];?>
                    </td>
                  
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget();
} ELSE {// end if any uses  ?>
<br />This actor has not been used for any use cases.
<?php  }?>

<?php 
 
$data = Actor::model()->getActorParentDefaultUC($model->actor_id);
if (count($data)){
$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Default Actor',
    'headerIcon' => 'icon-film',
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
)); 
    if (count($data)):?>

        <table class="table">
            <thead>
                <tr>
                    
                    <th>Usecase</th>
                   
                    
                   
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                        <a href="/usecase/view/id/<?php echo $item['usecase_id'];?>">UC-<?php echo str_pad($item['packagenumber'], 2, "0", STR_PAD_LEFT); ?><?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?></a>
 <?php echo $item['name'];?>
                    </td>
                   
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget();
} ELSE {// end if any uses  ?>
<br />This actor has not been assigned as default actor to any usecases.
<?php  }?>


  <?php if($permission){ ?>

  
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
                <a href="/formproperty/rollback/id/<?php echo $item['id'];?>"><i class="icon-repeat" rel="tooltip" data-placement="right" title="Roll Back to this Version"></i></a> 
                <?php  } ELSE { ?> 
                <i class="icon-circle-arrow-right" rel="tooltip" data-placement="right" title="Current Version"></i> 
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
                   <?php echo $item['description']; ?>
            </div>
        </div>
    </div>
  <?php } } ?>
<?php $this->endWidget(); 

  }?>

