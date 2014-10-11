

<b>Project Description</b> <a href="<?php echo UrlHelper::getPrefixLink('/project/update')?>"><i class="icon-edit"></i></a>
<br /><?php echo $model->description; ?><br />

 <br /> 
  External Link: <input type="text" class="span8" value ="http://www.reqrap.com/project/extview/id/<?php echo $model->extlink; ?>" onclick="this.select()">
 <a href="<?php echo UrlHelper::getPrefixLink('/project/resetlink/id/')?><?php echo $model->id; ?>">Reset the link</a>
  <br /> 
 <br /> 
<?php 
$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Interface Types',
    'headerIcon' => 'icon-picture',
     'htmlOptions' => array('class'=>'bootstrap-widget-table'),
      'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Interface Type',
        'visible'=>Yii::App()->session['permission']==1,
        'url'=>UrlHelper::getPrefixLink(('interfacetype/create')
    ),
           array(
        'class' => 'bootstrap.widgets.TbButton',
        'type'=>'link',
        'icon'=> 'question-sign',
         'url'=>UrlHelper::getPrefixLink('/help/popview/scope/ifacetypes'),
        'htmlOptions' => array('id' => 'popup',),
    ),
          )
));
    $data = Interfacetype::model()->getInterfacetypes(); 
?>
    <table class="table">
	
        <thead>
        <tr>
            <th>Name</th>
    

                <?php if(Yii::App()->session['permission']==1 ){ ?>  
            <th>Actions</th>
        </tr> <?php } ?>
        </thead>
        <tbody>
        <?php if (count($data)):
            foreach($data as $item):?>
            <?php if(Yii::App()->session['permission']==1){ ?> 
                <tr class="odd">  
                    <td>   
                        <a href="<?php echo UrlHelper::getPrefixLink('/interfacetype/view/id/')?><?php echo $item['interfacetype_id'];?>"><?php echo str_pad($item['number'], 2, "0", STR_PAD_LEFT).'-';?><?php echo $item['name'];?></a>
                    </td>
                   
                    <td>
                    <?php if(Yii::App()->session['permission']==1 && $item['number']!=1){ ?>    
                       <a href="<?php echo UrlHelper::getPrefixLink('/interfacetype/update/id/')?><?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Update"></i></a> 
                       <a href="<?php echo UrlHelper::getPrefixLink('/interfacetype/remove?id=')?><?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Remove"></i></a> 
                    <?php } ?>
                    </td>
            </tr> <?php } ?>
            <?php endforeach ?>
        <?php endif ?>
        </tbody></table>
    <?php $this->endWidget(); ?>