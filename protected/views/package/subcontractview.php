
<?php 
$data = Tenderans::model()->followerBidDetail($bidderid, $packid);
//findAll(array('order'=>'type, number', 'condition'=>'project_id=:x', 'params'=>array(':x'=>$model->id)));

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Tender Requirements',
    'headerIcon' => 'icon-gift',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
      )); 
?>
        <table class="table">
            <thead>
                <tr>
                    <th>Sequence</th>   
                    <th>Name</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Response</th>
           
                </tr>
            </thead>
            <tbody>

  


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
                  <?php echo '$'.number_format($item['content'],2,'.',',');?>
              </td>
              
            </tr>
            <?php endforeach ?>
            
            <?php endif; ?>
            
            
          </tbody>
        </table>

    <?php 
$this->endWidget();