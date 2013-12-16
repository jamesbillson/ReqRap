<h3>Claims</h3>   
<?php 
$data = Claim::model()->findAll('project_id='.$model->id);

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Issues',
    'headerIcon' => 'icon-gift',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Claim',
        'url'=>'/claim/create?id='.$model->id,
    ),
    
))); 
    if (count($data)):?>

        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                        <?php echo $item['date'];?>
                    </td>
                    <td class="money">
                        $ sum of assessments 
                    </td>
                    <td>   
                        <?php echo $item['name'];?>
                    </td>
                    <td>
                        <a href="/package/view/id/<?php echo $item['id'];?>"><i class="icon-eye-open" rel="tooltip" title="View"></i></a> 
                        <a href="/package/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit Details"></i></a> 
                        <a href="/package/remove?id=<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Remove/Uninvite"></i></a> 
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget(); ?>

<h3>BoQ</h3>
    Add Item<br />
    <a href="/boqitem/upload?id=<?php echo $model->id; ?>"> Upload</a><br />
    <a href="/boqitem/boq?id=<?php echo $model->id; ?>"> View</a>