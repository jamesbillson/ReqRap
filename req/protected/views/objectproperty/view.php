<?php 
$link=Yii::App()->session['release'].'_7_'.$model->object_id;
echo $this->renderPartial('/project/head',array('tab'=>'objects','link'=>$link));


 $edit=(Yii::App()->session['edit']==1)?TRUE:FALSE;
?>

<h1>View Object Property <?php echo $model->name; ?></h1>
<h1><a href="<?php echo UrlHelper::getPrefixLink('/project/view/tab/rules/id/')?><?php echo $model->object->project->id;?>"><?php echo $model->object->project->name;?></a></h1>


<h2>Property <?php echo $model->number; ?> for <?php echo $model->object->name; ?> form.    
    <a href="<?php echo UrlHelper::getPrefixLink('/objectproperty/update/id/')?><?php echo $model->id;?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
           </h2>


	<b><?php echo CHtml::encode($model->getAttributeLabel('name')); ?>:</b>
        <br />
	<?php echo CHtml::encode($model->name); ?>
	<br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('description')); ?>:</b>
	<br />
            <?php echo CHtml::encode($model->description); ?>

    
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
                <a href="<?php echo UrlHelper::getPrefixLink('/version/rollback/id/')?><?php echo $item['versionid'];?>"><i class="icon-repeat" rel="tooltip" data-placement="right" title="Roll Back to this Version"></i></a> 
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
<?php $this->endWidget(); ?>

