Actors
<pre>
 <?php 
 print_r($actors);
  ?>
</pre>
 
<?php
 $singles=array();
    foreach($actors as $actor):
    $single=$single+$actor['id'];
        
         

    endforeach; 
    
    print_r($singles);
    ?>
 


<h2><?php echo $heading; ?>. Actors</h2>

        <table class="table">
            <thead>
                <tr>
                    
                    <th>Name</th>
                    <th>Description</th>
                    <th>Aliases</th>

                </tr>
            </thead>
            
            <tbody>
            <?php foreach($actors as $actor):?>
                <tr class="odd">  
                    <td>   
                       <?php echo $actor['name'];?>
                    </td>
                    
                    <td>   
                        <?php echo $actor['description'];?>
                    </td>   
                    
                    <td>   
                        <?php echo $actor['alias'];?>
                    </td>                  
                    

                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

  


