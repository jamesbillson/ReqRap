<h3>Release History</h3>
<?php
$data = Release::model()->findAll('project_id='.Yii::app()->session['project']);

?>

<table class="table">
	<thead>
	<tr>
		<th>Number</th>
		<th>Status</th>
                <th>Date</th>
                <th>Actions</th>

	</tr>
	</thead>
            <?php if (count($data)):?>
        <tbody>

        <?php foreach($data as $item) {?>
        <tr class="odd">  
        <td>   
        <?php echo $item['number']; ?> 
        </td>
   
<td>   
       <?php echo Release::$status[$item['status']];?>
        </td>
    
    <td>   
        <?php echo $item['create_date'];?>
        </td>
              


      <td>
           <?php if ($item['id']==Yii::App()->session['release']){;?>
          <a href="/release/finalise/id/<?php echo $item['id'];?>"><i class="icon-certificate" rel="tooltip" title="Finalise Release"></i></a> 
           
              <?php } ELSE {?>
          
            <a href="/library/create/id/<?php echo $item['id'];?>"><i class="icon-book text-success" rel="tooltip" title="Add to library"></i></a> 
      <a href="/release/copy/id/<?php echo $item['id'];?>"><i class="icon-copy" rel="tooltip" title="Copy Release to new project"></i></a>
         <a href="/release/delete/id/<?php echo $item['id'];?>"><i class="icon-remove-sign text-error" rel="tooltip" title="Remove"></i></a> 
     <a href="/testcase/create/id/<?php echo $item['id'];?>"><i class="icon-check" rel="tooltip" title="Create Test Cases"></i></a> 
    
             <?php } ?>
          
        
          
          <a href="/release/update/id/<?php echo $item['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit Details"></i></a> 
      
        <a href="/release/set/id/<?php echo $item['id'];?>"><i class="icon-eye-open " rel="tooltip" title="Browse this release"></i></a> 
       <a href="/version/index/id/<?php echo $item['id'];?>"><i class="icon-calendar " rel="tooltip" title="View change log"></i></a> 
              
        </td>
        </tr>
          	</tbody>
<?php
        } ?>
<?php endif; ?>        
 
</table>



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