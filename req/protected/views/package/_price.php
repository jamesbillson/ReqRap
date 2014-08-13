<?php 


$data = Subcontract::model()->getPriceItems($model->id);

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Price items',
	'headerIcon' => 'icon-user',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
           'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButton',
                    'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'label'=> 'Add Item',
                    'url'=>'/subcontractitem/create/id/'.$model->subcontract->id,
                    
                      ),
     
)));  


// IS THIS PACKAGE ALREADY AWARDED

?>


<table class="table">
	<thead>
	<tr>
		<th>Item</th>
		<th>Description</th>
                <th>Amount</th>
		<th>Unit</th>
                <th>Price</th>
                 <th>Total</th>
                 <th>Actions</th>
	
	</tr>
	</thead>
        <tbody>

        <?php if (count($data)):
            foreach($data as $item) {?>
        <tr class="odd">  
        <td>   
        <?php echo $item['name'];?>
        </td>
        <td>
        <?php echo $item['description'];?>
      </td>
              <td>   
        <?php if ($item['type']==2) echo $item['amount'] //number_format($item['amount'], 1, '.', ',');?>
        </td>
                <td>   
        <?php if ($item['type']==2) echo $item['unit'];?>
        </td>
              <td>   
            <?php  if($item['type']==2) echo 'Price';
             //number_format($item['price'], 2, '.', ',');?>
        </td>
              <td>   
        <?php if($item['type']==1 || $item['type']==2) echo number_format($item['price']*$item['amount'], 2, '.', ',');?>
        </td>

        <td> 

            <td>
   
      <a href="/subcontractitem/update?id=<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit this subcontract item"></i></a> 
     <?php  if($item['type']==2) { ?>
      <a href="/subcontractitem/measure?id=<?php echo $item['id'];?>"><i class="icon-lock" rel="tooltip" title="Finalise the measure of item"></i></a> 
            <?php } ?>
            </td>
        </tr>
       <?php }
       endif;?>
        
        
</table>
      

<?php

$this->endWidget();

?>

