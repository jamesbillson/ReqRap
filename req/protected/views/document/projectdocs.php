<?php
/* @var $this DocumentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Documents',
);

$this->menu=array(
    array('label'=>'Create Document', 'url'=>array('document/create/id/'.$id)),

);
?>

<h1>Documents</h1>
<?php 
if (count($data)):

    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => 'Documents',
        'headerIcon' => 'icon-briefcase',
        // when displaying a table, if we include bootstra-widget-table class
        // the table will be 0-padding to the box
        'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));
?>

<table class="table">
    <thead>
        <tr>
            <th>Document</th>   
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    
    <tbody>

        <?php foreach($data as $item):?>
        <tr class="odd"> 
            <td>
                <?php echo $item['name'];?>
            </td>    
            <td>   
                <?php echo $item['description'];?>
            </td>
             
            <td>
                <a href="/document/delete?id=<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete"></i></a> 
            </td>
        </tr>
       <?php endforeach; ?>
    </tbody>
</table>

<?php
$this->endWidget();
endif;
?>
