



<?php 
$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Interface Types',
    'headerIcon' => 'icon-picture',
     'htmlOptions' => array('class'=>'bootstrap-widget-table'),
      'headerButtons' => array(
  
          
          )
));
    $data=array();
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
            <?php if(Yii::App()->session['permission']==1 && $item['number']!=1){ ?> 
                <tr class="odd">  
                    <td>   
                        <?php echo $item['name'];?>
                    </td>
                   
                    <td>
                    <?php if(Yii::App()->session['permission']==1){ ?>    
                       <a href="<?php echo UrlHelper::getPrefixLink('/interfacetype/update/id/')?><?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Update"></i></a> 
                       <a href="/interfacetype/remove?id=<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Remove"></i></a> 
                    <?php } ?>
                    </td>
            </tr> <?php } ?>
            <?php endforeach ?>
        <?php endif ?>
        </tbody></table>
    <?php $this->endWidget(); ?>