<?php echo $this->renderPartial('/project/head',array('tab'=>'details')); ?>
 


<h3>Change category for all: <?php echo $model->name; ?></h3>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'interfacetype-form',
	
)); 

?>


		
     <div class="row">

             <?php $interfacetypes = Interfacetype::model()->getInterfacetypes();?>   
             <select name="Iface[interfacetype_id]">
             <?php foreach($interfacetypes as $iface){?>
                 
              
                 <?php if($iface['interfacetype_id'] != $model->interfacetype_id) {;?> 
                   <option class="span4" value="<?php echo $iface['interfacetype_id'];?>">
                   <?php echo $iface['name'];?>
             </option>
             <?php 
                 }
                 }
                 ?>
             </select>
            
        </div>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php


$data=Iface::model()->getCategoryIfaces($model->interfacetype_id);
              
    

if (count($data)){
$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Interfaces',
    'headerIcon' => 'icon-picture',
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
)); 
    if (count($data)):?>

        <table class="table">
            <thead>
                <tr>
                    <th>Usecase</th>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):?>
                <tr class="odd">  
                    <td>   
                        <a href="/iface/view/id/<?php echo $item['iface_id'];?>">IF-<?php echo str_pad($model->number, 2, "0", STR_PAD_LEFT); ?>
                            <?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?>
                           </a>
                        <?php echo $item['name'];?>
                    </td>
                  
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget();
  }
  ?>