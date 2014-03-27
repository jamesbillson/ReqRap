


<?php 

$data = User::model()->companyUsers();
$admin = Company::model()->Admins(); 
$me = User::model()->findbyPK(Yii::app()->user->id);

?>

<div class="well">
    <h1><?php echo $model->name; ?></h1><a href="/company/update?id=<?php echo $model->id; ?>">
        <i class="icon-cog"></i></a>
 <?php 
echo $model->description;
?>
    <br />
     <br />
 <?php 
echo Company::$companytypestatus[$model->type];
?>    
</div>

 

<h3>People</h3>

 <?php 

 if (count($data)):?>


<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Company Users',
	'headerIcon' => 'icon-user',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'htmlOptions' => array('class'=>'bootstrap-widget-table'),
     'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Invite User',
        'visible'=>$me->admin==1,
        'url'=>array('/user/invite')
    )),
));?>

<table class="table">
	<thead>
	<tr>
		<th>Type</th>
		<th>Name</th>
		<th>Email</th>
		<th>Actions</th>
	
	</tr>
	</thead>
	
        <tbody>
            
         
        <?php foreach($data as $item) {?>
        <tr class="odd">  
            <td>
                 <?php if($item['admin']==1) { ?> 
                <i class="icon-user" rel="tooltip" title="Administrator"></i>
                 <?php } ?>
            </td>
         <td>   
        <?php echo $item['firstname']." ".$item['lastname'];?>
            </td>
            <td>
            <?php echo $item['email'];?>
      </td>
            <td>
                   <a href="/user/view/id/<?php echo $item['id'];?>"><i class="icon-eye-open" rel="tooltip" title="View"></i></a> 
 
                <?php    if($me->admin==1) {?>
                   
                            <?php if($item['admin']==1 && count($admin)>1) {?>
                             <a href="/user/demote/id/<?php echo $item['id'];?>"><i class="icon-circle-arrow-down" rel="tooltip" title="Remove Administrator Rights"></i> </a>
                            <?php }?>
                             <?php if($item['admin']!=1) {?>
                             <a href="/user/promote/id/<?php echo $item['id'];?>"><i class="icon-circle-arrow-up" rel="tooltip" title="Promote to Administrator"></i> </a>
                           
                             <a href="/user/sack/id/<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Remove user from company"></i></a> 
              <?php }?>
               <?php }?>
 
            </td>
        </tr>
       <?php } ?>
                </tbody>
</table>

 <?php 
 
 $this->endWidget(); 
endif;	


 

