<?php 

$data=Boqitem::model()->packageBoQ($model->id);
$last_component = ''; // set up the test for displaying the component header rows
$component_total = 0;
$boq=array();

$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Add an item',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=> $this->createUrl('/boqitem/add', array('id'=>$model->id)),
)); ?>	
        
<br>

<?php 
$item=0;
$component=0;
$boq_total= 0;
foreach($data as $line) {
$item++;   
            if($last_component != $line['component']) {
            $component ++;
            
            $boq[$component]['total']= 0;
            $boq[$component]['name']=$line['component'];
            $item=1;
            } // END show the component as header 
         $boq[$component][$item]['description']= $line['description'];
         $boq[$component][$item]['element']= $line['element'];
         $boq[$component][$item]['amount']= $line['amount'] ;
         $boq[$component][$item]['unit']= $line['unit'];
         $boq[$component][$item]['rate']= $line['rate'];
         $boq[$component][$item]['extension']= $line['extension'];
         $boq[$component][$item]['id']= $line['id'];
         $boq[$component]['total']= $boq[$component]['total'] + $line['extension'];
         $boq_total=$boq_total+$line['extension'];
         $last_component=$line['component']; 
         
  }       
  /*
  echo "<pre>";
  print_r($boq);
 echo "</pre>";
  */
  
  
 ?>
<table>
        <tr>
        <th>Component</th>
        <th>Element</th>
        <th>Amount</th>
        <th>Unit</th>
        <th>Rate</th>
        <th>Ext.</th>
        <!--th>Complete</th>
        <th>Earned</th-->
        <th>Actions</th>
</tr>
<tr>
   <td> <b>Package Total</b></td> 
   <td colspan="4"></td>
<td> <b><?php  echo number_format($boq_total, 0, '.', ',') ;?></b></td>
</tr>
    <?php
$x=1; 
$number_components=count($boq);
while($x <= $number_components)
  {
 ?>
<tr>
   <td> <b><?php  echo $boq[$x]['name']." <br>";?></b></td> 
   <td colspan="4"></td>
<td> <b><?php  echo number_format($boq[$x]['total'], 0, '.', ',') ;?></b></td>
</tr>

    <?php   
 $y=1; 
 $number_items=count($boq[$x])-2;
 // echo "number items is: ".$number_items;
  while($y <= $number_items)
       {
        ?>
         <tr>     <td><?php echo $boq[$x][$y]['description']; ?></td>
         <td> <?php  echo $boq[$x][$y]['element']; ?></td>
          <td> <?php  echo number_format($boq[$x][$y]['amount'], 1, '.', ','); ?></td>
         <td>  <?php  echo $boq[$x][$y]['unit']; ?></td>
           <td>  <?php  echo number_format($boq[$x][$y]['rate'], 2, '.', ','); ?></td>
            <td>  <?php  echo number_format($boq[$x][$y]['extension'], 0, '.', ','); ?></td>
            
              <td>   
           <a href="<?php echo UrlHelper::getPrefixLink('/boqitem/duplicate?id=')?><?php echo $boq[$x][$y]['id'];?>"><i class="icon-plus-sign" rel="tooltip" title="Add Another"></i></a> 
         <a href="<?php echo UrlHelper::getPrefixLink('/boqitem/update/id/')?><?php echo $boq[$x][$y]['id'];?>"><i class="icon-edit" rel="tooltip" title="Edit Details"></i></a> 
          <a href="<?php echo UrlHelper::getPrefixLink('/boqitem/remove?id=')?><?php echo $boq[$x][$y]['id'];?>"><i class="icon-remove-sign" rel="tooltip" title="Remove/Uninvite"></i></a> 
         
              </td>
            
            
        <?php
  $y++;
         } ?>
</tr>
   <?php           
  $x++;
  } 

?>

</table>














               <!--td>
          <form action="/progressassessment/boqcreate" method="post">
                   <input type="text" class="input-micro" name="amount"
                          value="<php echo number_format($line['progress'], 0, '.', ',') ;?>">% 
                   <input type="hidden" name="id" value="<php echo $line['id'];  ?>">
             
                   <input type="hidden" name="project" value="<php echo $line['project_id'];  ?>">
                   <input type="submit" value="Go"></form>
        
             </td>
        <td>
        $<php //echo number_format($line['progress']*$line['extension']/100, 0, '.', ',') ;?>
        </td-->

