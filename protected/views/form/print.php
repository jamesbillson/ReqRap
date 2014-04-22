<?php 
$forms = Form::model()->getProjectForms(Yii::app()->session['project']);

if (count($forms)):?>
<h2><?php echo $heading; ?>. Forms</h2>
<?php $heading++; ?>

<?php foreach($forms as $form): ?>

        <table class="table">
          
            
            <tbody>
           
                
                <tr class="odd">  
                    <td colspan="6">   

                        <h3> UF-<?php echo str_pad($form['number'], 3, "0", STR_PAD_LEFT); ?> 

  
                        <?php echo $form['name']; ?></h3>
                        
                    </td>
                                   </tr>
     <?php $fields = Formproperty::model()->getFormProperty($form['form_id']); ?>
     <?php if (count($fields)):?>
                                   
            
                <tr>
                  <td><strong> Number</strong></td>
                    <td><strong>Name</strong></td>
                    <td><strong>Description</strong></td>
                    <td><strong>Type</strong></td>
                    <td><strong>Validation</strong></td>
                    <td><strong>Required</strong></td>
                    
                </tr>
           
                                   
     <?php foreach($fields as $field): ?>
                    <tr class="odd">  
                    <td>   
                     <?php echo $field['number'];?>
                    
                    <td>   
                        <?php echo $field['name'];?>
                    </td>
                    <td>   
                        <?php echo $field['description'];?>
                    </td>                  
                    <td>   
                        <?php echo $field['type'];?>
                    </td>                    
                    <td>   
                        <?php echo $field['valid'];?>
                    </td> 
                    <td>   
                        <?php echo ($field['required']==1)?'Yes':'No';?>
                    </td>        
                      
                  </tr>
        <?php endforeach ?>          
 <?php endif; ?>                  
 
           
            </tbody>
        </table>
 <?php endforeach ?>
    <?php endif; ?>