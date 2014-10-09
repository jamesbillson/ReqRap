


<?php $model=  Company::model()->findByPK(User::model()->myCompany()) ?>



 <?php 
$data = Project::model()->myProjects(1);
$invites = Follower::model()->getMyProjectFollows(1);

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Projects',
    'headerIcon' => 'icon-briefcase',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Project',
        'url'=>UrlHelper::getPrefixLink('/project/create')
    )),
));


?>
        <table class="table" >
            <thead>
            <tr>
                <th>Name</th>
                
                <th>Actions</th>
            </tr>
            </thead>
                <tbody>
                <?php     if (count($data)): ?>
                    
                    <tr class="even"> 
                        
                    <?php     if (count($invites)): ?> 
                    <td colspan="2">
                       My Applications 
                    </td>
                     <?php endif;?>
                    </tr>
                    
                <?php    foreach($data as $item): ?>
                <tr class="odd">  
                    <td>
                       <a href="<?php echo UrlHelper::getPrefixLink('/project/set/id/') ?><?php echo $item['id'];?>"><?php echo $item['name'];?></a> 
                    </td>
                    
                    <td>
                        <?php
       echo CHtml::link(
    '<i class="icon-remove-sign text-error" rel="tooltip" title="Delete Application"></i>',
     array('/project/delete','id'=>$item['id']),
     array('confirm' => 'This will permanently delete this project, there is NO undo.  Are you sure?')
);
    ?>
                        
                        
                        
                        
                       <a href="<?php echo UrlHelper::getPrefixLink('/project/update?id=') ?><?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                
                    </td>
                </tr>
               <?php endforeach?>
       
    
                <?php endif;

 
                if (count($invites)):?>
                    <tr class="even">  
                    <td colspan="2">
                     Collaboration Projects 
                    </td>
                    </tr>
                      
                <?php foreach($invites as $item):?>
                <tr class="odd"> 
             
                    <td>
                       <a href="<?php echo UrlHelper::getPrefixLink('/project/set/id/')?><?php echo $item['id'];?>"><?php echo $item['pname'];?></a> 
                       
                    </td>
                   
                </tr>
               <?php endforeach?>


    <?php endif;?>
        </tbody>
    </table>

<?php $this->endWidget();
?>