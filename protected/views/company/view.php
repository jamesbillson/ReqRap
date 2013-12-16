

<h3><?php echo CHtml::encode($model->name); ?></h3>
<div class="view">

	


	



<b><?php echo CHtml::encode($model->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($model->description); ?>
	<br />
        
	<b><?php echo CHtml::encode($model->getAttributeLabel('foreignid')); ?>:</b>
	<?php echo CHtml::encode($model->foreignid); ?>
	<br />
	
	<b><?php echo CHtml::encode($model->getAttributeLabel('trade_id')); ?>:</b>
	<?php if($model->trade_id!=0) echo CHtml::encode($model->trade->name); ?>
        <?php if($model->trade_id==0) echo 'Not Set'; ?>
	<br />

	<?php //echo CHtml::encode($model->getAttributeLabel('owner_id')); ?>
	<?php //echo CHtml::encode($model->owner->firstname).' '.CHtml::encode($model->owner->lastname); ?>
	<br />

</div>

<?php 

$data = Contact::model()->findAll('company_id='.$model->id.' and companyowner_id='.User::model()->myCompany());
if (count($data)):

    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => 'Employees',
        'headerIcon' => 'icon-user',
        // when displaying a table, if we include bootstra-widget-table class
        // the table will be 0-padding to the box
        'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));

?>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>   
            <th>Title</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
    </thead>
    
    <tbody>

        <?php foreach($data as $item):?>
        <tr class="odd"> 
            <td>
                <?php echo $item['firstname'];?>
            </td>    
            <td>   
                <?php echo $item['lastname'];?>
            </td>
            <td>   
               
            </td>          
            <td>
                <a href="/contact/delete?id=<?php echo $item['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete"></i></a> 
            </td>
        </tr>
       <?php endforeach; ?>
    </tbody>
</table>

<?php
$this->endWidget();
endif;
?>

<h3>Bids</h3>
<?php 

$data = Package::model()->getSubbieBids($model->id);

if (count($data)):


    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => 'Bids',
        'headerIcon' => 'icon-briefcase',
        // when displaying a table, if we include bootstra-widget-table class
        // the table will be 0-padding to the box
        'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));

?>

<table class="table">
    <thead>
        <tr>
            <th>Project</th>   
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    
    <tbody>

        <?php foreach($data as $item):?>
        <tr class="odd"> 
            <td>
               <a href="/package/view/id/<?php echo $item['packid'];?>/tab/subbies"> <?php echo $item['projname']." - ".$item['packname'] ;?></a>
            </td>    
            <td>   
                <?php echo $item['modified_date'];?>
            </td>
            <td>   
               <?php //echo $item[''];?>
            </td>          
            <td>
             </td>
        </tr>
       <?php endforeach; ?>
    </tbody>
</table>

<?php
$this->endWidget();
else:
echo 'No bids';
endif;

?>


<h3>Costs</h3>
<?php 

$data = Cost::model()->findAll('supplier_id='.$model->id.' and company_id='.$model->companyowner_id);
if (count($data)):

    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => 'Employees',
        'headerIcon' => 'icon-briefcase',
        // when displaying a table, if we include bootstra-widget-table class
        // the table will be 0-padding to the box
        'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));

?>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>   
            <th>Description</th>
            <th>Amount</th>
            <th>Actions</th>
        </tr>
    </thead>
    
    <tbody>

        <?php foreach($data as $item):?>
        <tr class="odd"> 
            <td>
                <?php echo $item['identifier'];?>
            </td>    
            <td>   
                <?php echo $item['description'];?>
            </td>
            <td>   
               <?php echo $item['amount'];?>
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
else:
echo 'No costs';
endif;
?>
