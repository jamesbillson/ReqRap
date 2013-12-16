
Follower invite to set the type as an invite to bid, or an invite to follow.<br />
Bidders will need a new column in follower to set their type. <br />
Only bidders will see the Tender Requirements.<br />
(/project/_viewFollower)
<?php 
$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Followers',
    'headerIcon' => 'icon-user',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
      'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Consultant',
        'url'=>array('follower/addFollower', 'id'=>$model->id, 'type'=>1)
    )),
));
    $data = Follower::model()->getFollowers($model->id, 1); ?>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
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
                        <?php echo $status[$item['confirmed']];?>
                    </td>
                    <td>
                       <a href="/contact/view/id/<?php echo $item['id'];?>"><i class="icon-eye-open" rel="tooltip" title="View"></i></a> 
                       <a href="/follower/remove?id=<?php echo $item['follower_id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Remove/Uninvite"></i></a> 
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
                        <?php echo $status[$item['confirmed']];?>
                    </td>
                    <td>
                        <a href="/contact/view/id/<?php echo $item['id'];?>"><i class="icon-eye-open" rel="tooltip" title="View"></i></a> 
                        <a href="/follower/remove?id=<?php echo $item['follower_id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Remove/Uninvite"></i></a> 
                        <a href="/follower/resendinvite/id/<?php echo $item['follower_id'];?>/fk/<?php echo $model->id;?>"><i class="icon-envelope" rel="tooltip" title="Reinvite"></i></a> 
                    </td>
                </tr>
            <?php endforeach ?>
        <?php endif; ?>
        </tbody>
    </table>

<?php $this->endWidget(); ?>


