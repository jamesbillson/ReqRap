<?php 

$data = Variation::model()->variationContractitems($model->id);

?>
<h1><?php echo $model->project->company->name; ?></h1>
<h2><a href="<?php echo UrlHelper::getPrefixLink('/project/view/id/')?><?php echo $model->project->id; ?>/tab/variations"><?php echo $model->project->name; ?></a></h2>


<h3><?php echo Variation::$type[$model->contract];?>: <?php echo $model->name; ?></h3>
Staged Claims<br />
<div class="view">

Current Status: <?php echo Variation::$status[$model->status]; ?>




<?php       



$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id' => 'variation-form',
        'type'=> 'vertical',
        'action'=>UrlHelper::getPrefixLink('/variation/update/?id='.$model->id),
        'htmlOptions' => array('class' => 'well'), // for inset effect
    )
);
 


    echo $form->dropDownListRow(
            $model,
            'status',
            Variation::$status,array('selected'=>$model->status));

$this->widget(
    'bootstrap.widgets.TbButton',
    array('buttonType' => 'submit', 'type'=>'primary','label' => 'Update Status')
);
 
$this->endWidget();
unset($form);
        
      ?> 
    
</div>
<?php 


$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Contract Items',
    'headerIcon' => 'icon-gift',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
       'headerButtons' => array(
    array(
        'class' => 'bootstrap.widgets.TbButton',
        'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'label'=> 'Add Contract Item',
        'url'=>UrlHelper::getPrefixLink('/contractitem/create?id='.$model->id),
    ),
    
))); 
    if (count($data)):
        $total=0;
        ?>


        <table class="table">
            <thead>
                <tr>
                    <th>Stage</th>
                    <th>Amount</th>
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                        <?php echo $item['stagename'];?>
                    </td>
                     <td class="money">
                       $<?php echo number_format($item['amount'], 2, '.', ','); ?> 
                    </td>
                    <td>   
                        <?php echo $item['note'];?>
                    </td>

             

                    <td>
                      <a href="<?php echo UrlHelper::getPrefixLink('/contractitem/update/id/')?><?php echo $item['itemid'];?>/vid/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
                      <a href="<?php echo UrlHelper::getPrefixLink('/contractitem/delete/id/')?><?php echo $item['itemid'];?>"><i class="icon-remove-sign" rel="tooltip" title="Delete"></i></a> 
                    </td>
                </tr>
               <?php    $total=$total+$item['amount'];
          endforeach ?>
                <tr>
                    <td><b>Total</b></td>
                    <td><b>$<?php echo number_format($total, 2, '.', ','); ?></b></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

    <?php elseif($model->contract==1): // THIS VARIATION IS A CONTRACT
     // IF ITS A PROGRESS CLAIM CONTRACT - MAKE CONTRACT ITEMS FROM PACKAGES    
        if($model->project->claimtype==2){
        
      echo '<br />';     
    $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Create Contract Items from Packages',
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=>UrlHelper::getPrefixLink('project/packagescontract?vid='.$model->id.'&pid='.$model->project->id)
        )); 
        } elseif ($model->project->claimtype==1){
           
            
            // IF ITS A STAGED CLAIM CONTRACT - MAKE CONTRACT ITEMS FROM STAGES
            
     
      ?>
            
            
         <br /><br />
<form action="/project/stagescontract" method="post">
    <div class="row">
        <div class="span2"></div>
            <div class="span6">

            Contract Sum: $<input type='text' class='input-mini' name='contractsum'>
            <input type='hidden' name='pid' value='<?php echo $model->project_id; ?>'>
            <input type='hidden' name='vid' value='<?php echo $model->id; ?>'>
            <div >
        <input type="submit" class="btn-success" value="create contract items from stages">
        </div>
        </form>
        </div>
    </div>
            
            
            
            
    <?php
        }
     endif;
     echo '<br /><br />';
     $this->endWidget(); ?>

