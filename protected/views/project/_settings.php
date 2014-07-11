

<b>Description</b> <a href="/project/update?id=<?php echo $model->id; ?>"><i class="icon-edit"></i></a>
<br /><?php echo $model->description; ?><br />

 <br /> 
  External Link: <input type="text" value ="http://www.reqrap.com/project/extview/id/<?php echo $model->extlink; ?>" onclick="this.select()">
 <a href="/project/resetlink/id/<?php echo $model->id; ?>">Reset the link</a>
 
 
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
        'url'=>array('interfacetype/create')
    ),
           array(
        'class' => 'bootstrap.widgets.TbButton',
        'type'=>'link',
        'icon'=> 'question-sign',
         'url'=>'/help/popview/scope/ifacetypes',
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
    

                <?php if(Yii::App()->session['permission']==1){ ?>  
            <th>Actions</th>
        </tr> <?php } ?>
        </thead>
        <tbody>
        <?php if (count($data)):
            foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                        <?php echo $item['name'];?>
                    </td>
                   
                    <td>
                    <?php if(Yii::App()->session['permission']==1 && $item['name']!='Not Classified'){ ?>    
                       <a href="/interfacetype/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Update"></i></a> 
                       <a href="/interfacetype/remove?id=<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Remove"></i></a> 
                    <?php } ?>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
        </tbody></table>
    <?php $this->endWidget(); ?>