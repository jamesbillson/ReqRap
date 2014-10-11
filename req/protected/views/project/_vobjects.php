
<?php 

$permission=(Yii::App()->session['permission']==1)?true : false; 

$data = Object::model()->getProjectObjects(Yii::app()->session['project']);

    if (count($data)):?>

        <table class="table">
            <thead>
                <tr>
                    <th>Number</th>
 
                    <th>Name</th>
                     <th>Description</th>

                </tr>
            </thead>
            
            <tbody>
            <?php foreach($data as $item):
                
                ?>
                <tr class="odd">  
                   
                    <td>
                        <a href="<?php echo UrlHelper::getPrefixLink('/object/view/id/')?><?php echo $item['object_id'];?>">OB-<?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?></a>
                    </td>
                 
                    <td>    
                        <b><?php echo $item['name'];?></b>
                    </td>
                    <td>
                        <?php echo $item['description'];?>
                    </td>            
                  
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>