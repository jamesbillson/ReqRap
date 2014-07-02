 
<?php 
$permission=(Yii::App()->session['permission']==1)?true : false; 

        

?>


  <table class="table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                 
                   <th>Actions</th>
                </tr>
            </thead>

            <tbody>
<?php
$types = Interfacetype::model()->getInterfacetypes();
 

foreach($types as $type){
$data = Iface::model()->getCategoryIfaces($type['interfacetype_id']);
       

if (count($data)):?>

                <tr class="odd">  
                    <td colspan="4">   
                    <?php echo $type['name'];?>
                    </td>
                </tr>
      
  

            <?php foreach($data as $item){?>
                <tr class="odd">  
                    <td>   
                       
                        
                     <a href="/iface/view/id/<?php echo $item['iface_id'];?>">
                          
                        IF-<?php echo str_pad($item['typenumber'], 2, "0", STR_PAD_LEFT); ?><?php echo str_pad($item['number'], 3, "0", STR_PAD_LEFT); ?>
                   </a>
                    </td>
                    <td>   
                          
                    <?php echo $item['name'];?>
                        

                   

                  
                 
                </tr>
                    <?php if(!empty($item['text'])){ ?>
                <tr>
                    <td><strong>Notes</strong></td>
                        <td colspan="3">
                        <?php echo $item['text'];?>
                        
                    </td> 
                    
                </tr>
                <?php  } ?>
            <?php }
            endif;
                    }?>
            </tbody>
        </table>

 