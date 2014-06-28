<?php 

$data = Formproperty::model()->getFormProperty($model->form_id);

$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Form:UF'.str_pad($model->number, 4, "0", STR_PAD_LEFT).' '.$model->name,
    'headerIcon' => 'icon-list-alt',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),

));


  if (count($data)):?>

        <table class="table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Validation</th>
                    <th>Required</th>
  
                </tr>
            </thead>
            
            <tbody>
      
            <?php $counter=0; foreach($data as $item):?>
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
                        <?php echo $item['type'];?>
                    </td>                    
                    <td>   
                        <?php echo $item['valid'];?>
                    </td> 
                    <td>   
                        <?php echo ($item['required']==1)?'Yes':'No';?>
                    </td>                   

                </tr>
            <?php $counter++; endforeach ?>
            </tbody>
        </table>

    <?php endif;
$this->endWidget(); ?>


