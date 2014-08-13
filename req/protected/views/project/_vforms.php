 
<?php 
$permission=(Yii::App()->session['permission']==1)?true : false; 
$data = Form::model()->getProjectForms(Yii::app()->session['project']);


if (count($data)):?>




        <table class="table">
            <thead>
                <tr>
                    
                    <th>Name</th>
                   
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):
                $fields=  Formproperty::model()->getFormProperty($item['form_id']);
                ?>
                
                <tr class="odd">  
                    <td>   
                       
                         UF-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?> 
                 
                    </td>
                    <td>   
                        <?php echo $item['name']; ?>
                        
                    </td>
                 </tr>
                 <tr>
                 <?php foreach($fields as $field):?>
                   <?php echo $field['name']; ?>  
                 <?php endforeach ?>    
                 </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;?>
