<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<?php 
$data = Project::model()->myProjects(4);

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
        'label'=> 'Add New Tender',
        'url'=>UrlHelper::getPrefixLink('project/create')
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
                       <a href="<?php echo UrlHelper::getPrefixLink('/project/view/id/')?><?php echo $item['id'];?>/tab/documents"><?php echo $item['name'];?></a> 
                    </td>
                    <td>
                       <?php echo Project::$buildstage[$item['stage']];?> 
                    </td>
                    <td>
                        <a href="<?php echo UrlHelper::getPrefixLink('/project/delete?id=')?><?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Remove/Uninvite"></i></a> 
                    </td>
                </tr>
               <?php endforeach?>
            </tbody>
        </table>
    
    <?php endif;
$this->endWidget();
?>