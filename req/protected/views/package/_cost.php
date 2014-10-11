  
    
    <?php 

$costs = Package::model()->getAllocations($model->id);
//print_r($costs);
     

$box2 = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Allocated Costs',
	'headerIcon' => 'icon-book',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
                'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButton',
                    'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'label'=> 'Add Invoice',
                    'url'=>UrlHelper::getPrefixLink('/cost/create/id/').$model->id,
                    
                      ),
     
                    )
)); 
if (count($costs)):
    ?>

<table class="table">
	<thead>
	<tr>
		<th>Supplier</th>
		<th>Cost</th>
                <th>Notes</th>
		<th>Actions</th>
	
	</tr>
	</thead>
        <tbody>

        <?php foreach($costs as $item) {?>
        <tr class="odd">  
        <td>   
            <?php echo $item['name'];?>
        </td>
         <td>
            <?php echo $item['amount'];?>
         </td>
        
         
         <td>   
            <?php echo $item['notes'];?>
        </td>

            <td>
                   <a href="<?php echo UrlHelper::getPrefixLink('/cost/allocate/id/')?><?php echo $item['costid'];?>"><i class="icon-eye-open" rel="tooltip" title="View Invoice"></i></a> 
                   <a href="<?php echo UrlHelper::getPrefixLink('/costallocation/delete/?id=')?><?php echo $item['allocationid'];?>&packageid=<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Remove/Uninvite"></i></a> 
       
            
            </td>
        </tr>
       <?php }?>
   	</tbody>
</table>

<?php

endif;
$this->endWidget();
?>
