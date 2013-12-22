

<?php 
$usecases = Usecase::model()->getUsecases($model->id); // get the requirements with answers



$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Use Cases',
	'headerIcon' => 'icon-user',
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
           'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButton',
                    'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'label'=> 'Add Use Case',
                    'url'=>'/usecase/create/id/'.$model->id,
                    
                      ),
     
)));  
  if (count($usecases)):?>

  <table class="table">
  	<thead>
    	<tr>
          <th>Name</th>

          <th>Actions</th>
    	</tr>
  	</thead>
      <tbody>
  
        <?php foreach($usecases as $item) : // Go through each un answered question??>

          <tr class="odd">

              <td>   
                  <b><a href="/usecase/view/id/<?php echo $item['id'];?>"><?php echo $item['name'];?></a></b>
                
              </td> 
              <td>
               <a href="/usecase/delete/id/<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Edit"></i></a> 
              
                  <a href="/usecase/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
              </td>
         
        <?php endforeach ?>       
    </tbody>
  </table>

  <?php endif; // end count of results
  
  $this->endWidget();
  ?>



