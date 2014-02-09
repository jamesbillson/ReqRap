/package/_viewBidRqs.php/<br>
A list of questions/requirements that the bidders have to complete.<br />
   
<?php 
$justq = Tenderqs::model()->myNewBidqs($model->id);
$data = Tenderqs::model()->bidqsAndAs($model->id);
//findAll(array('order'=>'type, number', 'condition'=>'project_id=:x', 'params'=>array(':x'=>$model->id)));

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Tender Requirements',
    'headerIcon' => 'icon-gift',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Requirement',
            'url'=>'/tenderqs/create/id/'.$model->id.'/pt/2',
    ),
    
))); 
?>
        <table class="table">
            <thead>
                <tr>
                    <th>Sequence</th>   
                    <th>Name</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Response</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

  <?php    if (count($justq)):
      foreach($justq as $item):?>
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
                  <?php echo Tenderqs::$shorttype[$item['type']];?>  
              </td>
              <td>
                  No Responses
              </td>
              <td>
                  <a href="/tenderqs/view/id/<?php echo $item['id'];?>"><i class="icon-eye-open" rel="tooltip" title="View"></i></a> 
                  <a href="/tenderqs/update/id/<?php echo $item['id'];?>/project_id/<?php echo $model->id;?>"><i class="icon-edit" rel="tooltip" title="Edit Details"></i></a> 
                  <a href="/tenderqs/remove?id=<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete Requirement"></i></a> 
              </td>
            </tr>
            <?php endforeach;
            endif;?>


  <?php    if (count($data)):
      foreach($data as $item):?>
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
                  <?php echo Tenderqs::$shorttype[$item['type']];?>  
              </td>
              <td>
                  <?php echo 100*$item['status']/$item['answers']/4;?>%
              </td>
              <td>
                  <a href="/tenderqs/view/id/<?php echo $item['id'];?>"><i class="icon-eye-open" rel="tooltip" title="View"></i></a> 
                  <a href="/tenderqs/update/id/<?php echo $item['id'];?>/project_id/<?php echo $model->id;?>"><i class="icon-edit" rel="tooltip" title="Edit Details"></i></a> 
                  <a href="/tenderqs/remove?id=<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete Requirement"></i></a> 
              </td>
            </tr>
            <?php endforeach ?>
            
            <?php endif; ?>
            
            
          </tbody>
        </table>

    <?php 
$this->endWidget();