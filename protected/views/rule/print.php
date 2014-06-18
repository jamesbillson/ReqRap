
<h2><?php echo $heading; ?>. Business Rule Register</h2>



<table class="table">
	<thead>
	<tr>
		<th>Number</th>
		<th>Title</th>
                <th>Rule Detail</th>


	</tr>
	</thead>
        <tbody>

        <?php foreach($rules as $rule) {?>
        <tr class="odd">  
    <td>         BR-<?php echo str_pad($rule['number'], 3, "0", STR_PAD_LEFT); ?> 
  
    </td>
   
    <td>   
       
            <?php echo $rule['name']; ?>
    </td>
    
    <td>   
        <?php echo $rule['text'];?>
        </td>
              


        </tr>
<?php
        }?>
    
        
   	</tbody>
</table>
