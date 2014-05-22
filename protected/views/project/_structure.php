

<h3>Document Structure</h3>
<?php


$sections = array(0=>'Title Page and Release History',
                  1=>'Business Objects',
                  2=>'Actors', 
                  3=>'Use Case Analysis',
                  4=>'Business Rule Register',
                  5=>'User Interfaces',
                  6=>'Form Definitions' ); 
 
$head=0;
$cats = Category::model()->getProjectCategory();
?>

<table class="table">
	<thead>
	<tr>
		<th>Number</th>
		<th>Object</th>
                <th>Actions</th>
	</tr>
	</thead>
            <?php if (count($sections)):?>
        <tbody>

        <?php for($i=0;$i<=6 ;$i++){
        $head++;
       
            ?>
        <tr class="odd">  
        <td>   
        <?php echo $head; ?> 
        </td>
   
<td>   
       <?php echo $sections[$i];?>
        </td>
        <td>
              
        </td>
        </tr>
        <?php 
        
        foreach($cats as $cat){
        
         if ($cat['order']>$i && $cat['order']<=$i+1){
                $head++;
                
                ?>
            
        
        
           <tr class="odd">  
        <td>   
        <?php echo $head; ?> 
        </td>
   
<td>   
       <?php echo $cat['name'];?>
        </td>
        <td>
          <?php if($cat['order']>1){ ?>   
         <a href="/category/up/id/<?php echo $cat['id'];?>"><i class="icon-arrow-up " rel="tooltip" title="Move this earlier"></i></a> 
      <?php } ?>
         <?php if($cat['order']<6){?>   
         <a href="/category/down/id/<?php echo $cat['id'];?>"><i class="icon-arrow-down " rel="tooltip" title="Move this later"></i></a> 
           <?php } ?> 
        </td>
        </tr>
        
        
        
            <?php
        }
        }
        ?>
      <?php } ?>
</tbody>

<?php endif; ?>        
 
</table>