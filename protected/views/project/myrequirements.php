


<?php $model=  Company::model()->findByPK(User::model()->myCompany()) ?>



 <?php 
$data = Project::model()->myProjects(1);
$invites = Follower::model()->getMyProjectFollows(1);

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Applications',
    'headerIcon' => 'icon-briefcase',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Application',
        'url'=>array('project/create')
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
                       <a href="/project/set/id/<?php echo $item['id'];?>"><?php echo $item['name'];?></a> 
                    </td>
                    
                    <td>
                        <a href="/project/delete?id=<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Delete Application"></i></a> 
                  <a href="/project/update?id=<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                
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
                       <a href="/project/view/id/<?php echo $item['id'];?>/tab/documents"><?php echo $item['pname'];?></a> 
                       
                    </td>
                    <td>
                        <a href="/project/delete?id=<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Remove/Uninvite"></i></a>
                    </td>
                </tr>
               <?php endforeach?>


    <?php endif;?>
        </tbody>
    </table>

<?php $this->endWidget();
?>