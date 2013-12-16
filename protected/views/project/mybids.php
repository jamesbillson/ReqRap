


<?php $model=  Company::model()->findByPK(User::model()->myCompany()) ?>
<h1><?php echo $model->name ?></h1> 
<h2>My Bids</h2>

 <?php 
$data = Project::model()->myProjects(1);

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Bids',
    'headerIcon' => 'icon-briefcase',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Bid',
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
                    <td colspan="2">
                       My Project Bids 
                    </td>
                    </tr>
                    
                <?php    foreach($data as $item): ?>
                <tr class="odd">  
                    <td>
                       <a href="/project/view/id/<?php echo $item['id'];?>/tab/documents"><?php echo $item['name'];?></a> 
                    </td>
                    
                    <td>
                        <a href="/project/delete?id=<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Remove/Uninvite"></i></a> 
                    </td>
                </tr>
               <?php endforeach?>
       
    
                <?php endif;

                $data = Follower::model()->getMyProjectFollows(1);
                if (count($data)):?>
                    <tr class="even">  
                    <td colspan="2">
                     Invited Bids 
                    </td>
                    </tr>
                      
                <?php foreach($data as $item):?>
                <tr class="odd"> 
             
                    <td>
                       <a href="/project/view/id/<?php echo $item['id'];?>/tab/documents"><?php echo $item['name'];?></a> 
                       
                    </td>
                    <td>
                        <a href="/project/delete?id=<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Remove/Uninvite"></i></a>
                    </td>
                </tr>
               <?php endforeach?>


    <?php endif;?>
        </tbody>
    </table>

<?php $this->endWidget();
?>