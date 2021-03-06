

<?php 
$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Collaborators',
    'headerIcon' => 'icon-user',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
      'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Collaborator',
        'visible'=>Yii::App()->session['permission']==1,
        'url'=>UrlHelper::getPrefixLink('follower/addFollower/?id=').$model->id.'&type=1'
    ),
           array(
        'class' => 'bootstrap.widgets.TbButton',
        'type'=>'link',
        'icon'=> 'question-sign',
         'url'=>UrlHelper::getPrefixLink('/help/popview/scope/followers'),
        'htmlOptions' => array('id' => 'popup',),
    ),
          )
));
    $data = Follower::model()->getFollowers(Yii::app()->session['project'], 1); 
	$status=array('pending','confirmed');
	
	?>
    <table class="table">
	
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
                <?php if(Yii::App()->session['permission']==1){ ?>  
            <th>Actions</th>
        </tr> <?php } ?>
        </thead>
        <tbody>
        <?php if (count($data)):
            foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                        <?php echo $item['firstname']." ".$item['lastname'];?>
                    </td>
                    <td>
                        <?php echo $item['email'];?>
                    </td>
                                    <td>
                        <?php echo Follower::$type[$item['role']];?>
                    </td>
                    <td>   
                        <?php echo $status[$item['confirmed']];?>
                    </td>
                    <td>
                    <?php if(Yii::App()->session['permission']==1){ ?>    
                       <a href="<?php echo UrlHelper::getPrefixLink('/contact/view/id/')?><?php echo $item['id'];?>"><i class="icon-eye-open" rel="tooltip" title="View"></i></a> 
                       <a href="<?php echo UrlHelper::getPrefixLink('/follower/remove?id=')?><?php echo $item['follower_id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Remove/Uninvite"></i></a> 
                    <?php } ?>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
        
        <?php       
        $data = Follower::model()->getFollowerPendingInvites($model->id, 1);      
        if (count($data)):
            foreach($data as $item): ?>
                <tr class="odd">  
                    <td>   
                        <?php echo $item['firstname']." ".$item['lastname'];?>
                    </td>
                    <td>
                        <?php echo $item['email'];?>
                    </td>
                    <td>
                        <?php echo Follower::$type[$item['role']];?>
                    </td>
                    <td>   
                        <?php echo Follower::$followerstatus[$item['confirmed']];?>
                    </td>
                    <td>
                        <a href="<?php echo UrlHelper::getPrefixLink('/contact/view/id/')?><?php echo $item['id'];?>"><i class="icon-eye-open" rel="tooltip" title="View"></i></a> 
                        <a href="<?php echo UrlHelper::getPrefixLink('/follower/remove?id=')?><?php echo $item['follower_id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Remove/Uninvite"></i></a> 
                        <a href="<?php echo UrlHelper::getPrefixLink('/follower/resendinvite/id/')?><?php echo $item['follower_id'];?>/fk/<?php echo $model->id;?>"><i class="icon-envelope" rel="tooltip" title="Reinvite"></i></a> 
                    </td>
                </tr>
            <?php endforeach ?>
        <?php endif; ?>
        </tbody>
    </table>

<?php $this->endWidget(); ?>


