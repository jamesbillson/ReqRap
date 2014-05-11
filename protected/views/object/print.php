   

<h2><?php echo $heading; ?>. Objects</h2>

        <?php foreach($objects as $object):?>
        
        <h3>OB-<?php echo str_pad($object['number'], 3, "0", STR_PAD_LEFT); ?> <?php echo $object['name'];?></h3>
        <?php echo $object['description'];?>
             
        <?php endforeach ?>
        

        <?php foreach($objects as $object):
$objectproperties=  Objectproperty::model()->getObjectProperty($object['object_id']);

  if (count($objectproperties)):?>

        <table class="table">
            <thead>
                <tr>
                    
                    <th>Ref</th>
                    <th>Name</th>
                    <th>Description</th>
                    
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($objectproperties as $objectproperty):?>
                <tr class="odd">  
                    <td>   
                        <?php echo $objectproperty['number'];?>
                    </td>
                    <td>   
                        <?php echo $objectproperty['name'];?>
                    </td>
                    <td>   
                        <?php echo $objectproperty['description'];?>
                    </td>                  
                   

                  
                  
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    <?php endif;
 endforeach ?>
        
  