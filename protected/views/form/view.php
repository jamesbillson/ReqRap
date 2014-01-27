
<h3>Project: <a href="/project/view/tab/objects/id/<?php echo $model->project->id; ?>"><?php echo $model->project->name; ?></a></h3>
<a href="/form/history/id/<?php echo $model->form_id; ?>">History</a>
<br>
<?php 
//$data=Formproperty::model()->findAll('form_id='.$model->form_id);
$data = Formproperty::model()->getFormProperty($model->form_id);
//$deleted = Formproperty::model()->getProjectDeletedRules($model->id);
  

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Form:UF'.str_pad($model->number, 4, "0", STR_PAD_LEFT).' '.$model->name,
    'headerIcon' => 'icon-list-alt',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
      'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Form Property',
        'url'=>array('formproperty/create', 'id'=>$model->form_id)
    )),
));


  if (count($data)):?>

        <table class="table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                     <?php echo $item['number'];?>
                    </td>
                    <td>   
                        <?php echo $item['name'];?>
                    </td>
                    <td>   
                        <?php echo $item['description'];?>
                    </td>                  
                   

                  
                    <td>
                        <a href="/formproperty/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                        <a href="/formroperty/delete?id=<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete"></i></a> 
                     <a href="/formroperty/view/id/<?php echo $item['formproperty_id'];?>"><i class="icon-calendar" rel="tooltip" title="History"></i></a> 
                   
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget(); ?>

