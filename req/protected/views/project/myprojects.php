

<h1>My Projects</h1>
<h2>My company projects</h2> 

<?php 
$data = Project::model()->myProjects(2);

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
        'url'=>array('project/create')
    )),
));
    if (count($data)):?>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Stage</th>
                <th>Actions</th>
            </tr>
            </thead>
                <tbody>
                <?php foreach($data as $item): ?>
                <tr class="odd">  
                    <td>
                       <a href="/project/view/id/<?php echo $item['id'];?>/tab/documents"><?php echo $item['name'];?></a> 
                    </td>
                    <td>
                       <?php echo Project::$buildstage[$item['stage']];?> 
                    </td>
                    <td>
                        <a href="/project/delete?id=<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Remove/Uninvite"></i></a> 
                    </td>
                </tr>
               <?php endforeach?>
            </tbody>
        </table>
    
    <?php endif;
$this->endWidget();
?>
    <br />
    <h2>Other Projects I'm following</h2>  
    Query the follower table to work out if I'm following projects, if so return them here.
 
<?php 
$data = Follower::model()->getMyProjectFollows(1);

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Projects Followed',
    'headerIcon' => 'icon-briefcase',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
));
    if (count($data)):?>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
            <tbody>
            <?php foreach($data as $item):?>
            <tr class="odd">  
                <td>
                   <a href="/project/view/id/<?php echo $item['id'];?>/tab/documents"><?php echo $item['pname'];?></a> 
                   <?php echo Project::$buildstage[$item['stage']];?>
                </td>
                <td>
                    <a href="/project/delete?id=<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Remove/Uninvite"></i></a>
                </td>
            </tr>
           <?php endforeach?>
        </tbody>
    </table>

    <?php endif;
$this->endWidget();
?>